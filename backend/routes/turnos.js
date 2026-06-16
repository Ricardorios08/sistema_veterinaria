const express = require('express');
const router = express.Router();
const userDb = require('../db/userDb');
const { logAction } = require('../utils/logger');

// Middleware to verify JWT token and user context
const authenticateToken = (req, res, next) => {
    const authHeader = req.headers['authorization'];
    const token = authHeader && authHeader.split(' ')[1];

    if (!token) return res.status(401).json({ error: 'Token no proporcionado' });

    const jwt = require('jsonwebtoken');
    const JWT_SECRET = process.env.JWT_SECRET || 'fallback_secret';
    jwt.verify(token, JWT_SECRET, (err, user) => {
        if (err) return res.status(403).json({ error: 'Token inválido o expirado' });
        req.user = user;
        next();
    });
};

// GET /api/turnos (list turns with patient and professional details)
router.get('/', authenticateToken, async (req, res) => {
    const { fecha_inicio, fecha_fin, odontologo_id } = req.query;
    try {
        let sql = `
            SELECT t.*, 
                   p.nombre as paciente_nombre, p.apellido as paciente_apellido, p.dni as paciente_dni, p.telefono as paciente_telefono,
                   u.nombre_usuario as odontologo_nombre
            FROM turno t
            INNER JOIN paciente p ON t.paciente_id = p.id
            INNER JOIN user u ON t.odontologo_id = u.id
            WHERE t.FechaBaja IS NULL
        `;
        let params = [];

        if (req.user.rol !== 'superadmin') {
            sql += ' AND t.prestador_id = ?';
            params.push(req.user.prestador_id);
        }

        if (['profesional', 'veterinario', 'peluquero', 'traslado'].includes(req.user.rol)) {
            sql += ' AND t.odontologo_id = ?';
            params.push(req.user.id);
        }

        if (fecha_inicio && fecha_fin) {
            sql += ' AND t.fecha_hora BETWEEN ? AND ?';
            params.push(fecha_inicio, fecha_fin);
        } else if (fecha_inicio) {
            sql += ' AND DATE(t.fecha_hora) = DATE(?)';
            params.push(fecha_inicio);
        }

        if (odontologo_id) {
            sql += ' AND t.odontologo_id = ?';
            params.push(odontologo_id);
        }

        sql += ' ORDER BY t.fecha_hora ASC';
        const turns = await userDb.query(sql, params, req.user.rol);
        res.json(turns);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/turnos (reserve a turn)
router.post('/', authenticateToken, async (req, res) => {
    const { paciente_id, odontologo_id, fecha_hora, duracion_minutos, motivo, notas } = req.body;
    if (!paciente_id || !odontologo_id || !fecha_hora) {
        return res.status(400).json({ error: 'Paciente, odontólogo y fecha/hora son obligatorios' });
    }

    try {
        // Validate if there is a conflict for this odontologo on the same date/time
        // Check if there are overlapping appointments
        const startStr = fecha_hora.replace('T', ' ').slice(0, 19);
        const requestedStart = new Date(fecha_hora + 'Z');
        const duration = parseInt(duracion_minutos || "30");
        const requestedEnd = new Date(requestedStart.getTime() + duration * 60000);

        const formatMySqlDate = (date) => date.toISOString().slice(0, 19).replace('T', ' ');

        // Check for conflicts
        // We disabled strict conflict checking to allow 'Sobre Turnos' (overbooking)
        // because the frontend UI handles the intentionality explicitly via the '+ Sobre Turno' button.
        /*
        const conflicts = await userDb.query(
            `SELECT id FROM turno 
             WHERE odontologo_id = ? 
               AND estado != 'cancelado'
               AND FechaBaja IS NULL
               AND (fecha_hora < ? AND DATE_ADD(fecha_hora, INTERVAL duracion_minutos MINUTE) > ?)`,
            [odontologo_id, formatMySqlDate(requestedEnd), startStr],
            req.user.rol
        );

        if (conflicts.length > 0) {
            return res.status(400).json({ error: 'El odontólogo ya tiene un turno agendado en ese horario.' });
        }
        */

        const finalPrestadorId = req.user.prestador_id || 1;
        await userDb.query(
            'INSERT INTO turno (paciente_id, odontologo_id, fecha_hora, duracion_minutos, estado, motivo, notas, prestador_id, CreacionUsuario, FechaCreacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())',
            [paciente_id, odontologo_id, startStr, duration, 'pendiente', motivo || null, notas || null, finalPrestadorId, req.user.nombre_usuario],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'TURNO_CREATE', `Turno agendado para Paciente ID: ${paciente_id} con Odontólogo ID: ${odontologo_id} (Prestador ID: ${finalPrestadorId})`, req);
        res.json({ message: 'Turno reservado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// PUT /api/turnos/:id (update turn state or scheduling)
router.put('/:id', authenticateToken, async (req, res) => {
    const { id } = req.params;
    const { fecha_hora, duracion_minutos, estado, motivo, notas, hora_llegada } = req.body;

    try {
        const turnObj = await userDb.query('SELECT * FROM turno WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (turnObj.length === 0) return res.status(404).json({ error: 'Turno no encontrado' });

        // Security check
        if (req.user.rol !== 'superadmin' && turnObj[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para modificar este turno de otra institución' });
        }

        let sql = 'UPDATE turno SET ';
        let fields = [];
        let params = [];

        if (fecha_hora) {
            const startStr = fecha_hora.replace('T', ' ').slice(0, 19);
            const requestedStart = new Date(fecha_hora + 'Z');
            const duration = parseInt(duracion_minutos || turnObj[0].duracion_minutos);
            const requestedEnd = new Date(requestedStart.getTime() + duration * 60000);
            
            const formatMySqlDate = (date) => date.toISOString().slice(0, 19).replace('T', ' ');
            const endStr = formatMySqlDate(requestedEnd);

            // Double booking check for other turns
            // Disabled to allow 'Sobre Turnos' (overbooking)
            /*
            const conflicts = await userDb.query(
                `SELECT id FROM turno 
                 WHERE odontologo_id = ? 
                   AND id != ?
                   AND estado != 'cancelado'
                   AND FechaBaja IS NULL
                   AND (fecha_hora < ? AND DATE_ADD(fecha_hora, INTERVAL duracion_minutos MINUTE) > ?)`,
                [turnObj[0].odontologo_id, id, endStr, startStr],
                req.user.rol
            );

            if (conflicts.length > 0) {
                return res.status(400).json({ error: 'El odontólogo ya tiene otro turno agendado en ese horario.' });
            }
            */

            fields.push('fecha_hora = ?', 'duracion_minutos = ?');
            params.push(startStr, duration);
        }

        if (estado) {
            fields.push('estado = ?');
            params.push(estado);

            // Automatically set arrival time if status transitions to 'confirmado'
            if (estado === 'confirmado') {
                const now = new Date();
                const hh = String(now.getHours()).padStart(2, '0');
                const mm = String(now.getMinutes()).padStart(2, '0');
                const arrivalTime = `${hh}:${mm}`;
                
                fields.push('hora_llegada = COALESCE(hora_llegada, ?)');
                params.push(arrivalTime);
            }
        }

        if (hora_llegada !== undefined) {
            fields.push('hora_llegada = ?');
            params.push(hora_llegada || null);
        }

        if (motivo !== undefined) {
            fields.push('motivo = ?');
            params.push(motivo || null);
        }

        if (notas !== undefined) {
            fields.push('notas = ?');
            params.push(notas || null);
        }

        // Add audit columns
        fields.push('ModificacionUsuario = ?', 'FechaModificacion = NOW()');
        params.push(req.user.nombre_usuario);

        if (fields.length === 0) {
            return res.status(400).json({ error: 'Nada para actualizar' });
        }

        sql += fields.join(', ') + ' WHERE id = ?';
        params.push(id);

        await userDb.query(sql, params, req.user.rol);

        logAction(req.user.nombre_usuario, 'TURNO_UPDATE', `Turno ID actualizado: ${id} (Estado: ${estado || turnObj[0].estado})`, req);
        res.json({ message: 'Turno actualizado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// DELETE /api/turnos/:id (cancel appointment)
router.delete('/:id', authenticateToken, async (req, res) => {
    const { id } = req.params;
    try {
        const turnObj = await userDb.query('SELECT * FROM turno WHERE id = ? AND FechaBaja IS NULL', [id], req.user.rol);
        if (turnObj.length === 0) return res.status(404).json({ error: 'Turno no encontrado o ya cancelado/eliminado' });

        // Security check
        if (req.user.rol !== 'superadmin' && turnObj[0].prestador_id !== req.user.prestador_id) {
            return res.status(403).json({ error: 'No tienes permisos para cancelar este turno de otra institución' });
        }

        await userDb.query(
            'UPDATE turno SET estado = "cancelado", FechaBaja = NOW(), BajaUsuario = ? WHERE id = ?', 
            [req.user.nombre_usuario, id], 
            req.user.rol
        );
        logAction(req.user.nombre_usuario, 'TURNO_CANCEL', `Turno ID cancelado y eliminado lógicamente: ${id}`, req);
        res.json({ message: 'Turno cancelado con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// GET /api/turnos/config-horarios/:profesional_id (fetch professional scheduling config)
router.get('/config-horarios/:profesional_id', authenticateToken, async (req, res) => {
    const { profesional_id } = req.params;
    try {
        const rows = await userDb.query(
            `SELECT lunes, martes, miercoles, jueves, viernes, sabado, 
                    duracion_consulta, espacio_entre_turnos, cantidad_turnos_diarios, 
                    horario_inicio, observaciones_agenda, horario_inicio_tarde, cantidad_turnos_tarde,
                    lunes_inicio, lunes_turnos, lunes_inicio_tarde, lunes_turnos_tarde,
                    martes_inicio, martes_turnos, martes_inicio_tarde, martes_turnos_tarde,
                    miercoles_inicio, miercoles_turnos, miercoles_inicio_tarde, miercoles_turnos_tarde,
                    jueves_inicio, jueves_turnos, jueves_inicio_tarde, jueves_turnos_tarde,
                    viernes_inicio, viernes_turnos, viernes_inicio_tarde, viernes_turnos_tarde,
                    sabado_inicio, sabado_turnos, sabado_inicio_tarde, sabado_turnos_tarde
             FROM \`user\` WHERE id = ?`, 
            [profesional_id], 
            req.user.rol
        );
        if (rows.length === 0) {
            return res.status(404).json({ error: 'Profesional no encontrado' });
        }
        res.json(rows[0]);
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// POST /api/turnos/config-horarios (save professional scheduling config)
router.post('/config-horarios', authenticateToken, async (req, res) => {
    const { 
        profesional_id, 
        lunes, martes, miercoles, jueves, viernes, sabado, 
        duracion_consulta, espacio_entre_turnos, cantidad_turnos_diarios, 
        horario_inicio, observaciones_agenda,
        horario_inicio_tarde, cantidad_turnos_tarde,
        lunes_inicio, lunes_turnos, lunes_inicio_tarde, lunes_turnos_tarde,
        martes_inicio, martes_turnos, martes_inicio_tarde, martes_turnos_tarde,
        miercoles_inicio, miercoles_turnos, miercoles_inicio_tarde, miercoles_turnos_tarde,
        jueves_inicio, jueves_turnos, jueves_inicio_tarde, jueves_turnos_tarde,
        viernes_inicio, viernes_turnos, viernes_inicio_tarde, viernes_turnos_tarde,
        sabado_inicio, sabado_turnos, sabado_inicio_tarde, sabado_turnos_tarde
    } = req.body;

    if (!profesional_id) {
        return res.status(400).json({ error: 'profesional_id es obligatorio' });
    }

    try {
        await userDb.query(
            `UPDATE \`user\` 
             SET lunes = ?, martes = ?, miercoles = ?, jueves = ?, viernes = ?, sabado = ?, 
                 duracion_consulta = ?, espacio_entre_turnos = ?, cantidad_turnos_diarios = ?, 
                 horario_inicio = ?, observaciones_agenda = ?,
                 horario_inicio_tarde = ?, cantidad_turnos_tarde = ?,
                 lunes_inicio = ?, lunes_turnos = ?, lunes_inicio_tarde = ?, lunes_turnos_tarde = ?,
                 martes_inicio = ?, martes_turnos = ?, martes_inicio_tarde = ?, martes_turnos_tarde = ?,
                 miercoles_inicio = ?, miercoles_turnos = ?, miercoles_inicio_tarde = ?, miercoles_turnos_tarde = ?,
                 jueves_inicio = ?, jueves_turnos = ?, jueves_inicio_tarde = ?, jueves_turnos_tarde = ?,
                 viernes_inicio = ?, viernes_turnos = ?, viernes_inicio_tarde = ?, viernes_turnos_tarde = ?,
                 sabado_inicio = ?, sabado_turnos = ?, sabado_inicio_tarde = ?, sabado_turnos_tarde = ?
             WHERE id = ?`,
            [
                lunes ? 1 : 0, martes ? 1 : 0, miercoles ? 1 : 0, jueves ? 1 : 0, viernes ? 1 : 0, sabado ? 1 : 0,
                parseInt(duracion_consulta || "30"), parseInt(espacio_entre_turnos || "0"),
                parseInt(cantidad_turnos_diarios || "10"), horario_inicio || '08:00',
                observaciones_agenda || null, horario_inicio_tarde || null, parseInt(cantidad_turnos_tarde || "0"),
                
                lunes_inicio || '08:00', parseInt(lunes_turnos || "10"), lunes_inicio_tarde || null, parseInt(lunes_turnos_tarde || "0"),
                martes_inicio || '08:00', parseInt(martes_turnos || "10"), martes_inicio_tarde || null, parseInt(martes_turnos_tarde || "0"),
                miercoles_inicio || '08:00', parseInt(miercoles_turnos || "10"), miercoles_inicio_tarde || null, parseInt(miercoles_turnos_tarde || "0"),
                jueves_inicio || '08:00', parseInt(jueves_turnos || "10"), jueves_inicio_tarde || null, parseInt(jueves_turnos_tarde || "0"),
                viernes_inicio || '08:00', parseInt(viernes_turnos || "10"), viernes_inicio_tarde || null, parseInt(viernes_turnos_tarde || "0"),
                sabado_inicio || '08:00', parseInt(sabado_turnos || "10"), sabado_inicio_tarde || null, parseInt(sabado_turnos_tarde || "0"),
                
                profesional_id
            ],
            req.user.rol
        );

        logAction(req.user.nombre_usuario, 'HORARIO_UPDATE', `Horario de atención actualizado para Profesional ID: ${profesional_id}`, req);
        res.json({ message: 'Horarios de atención guardados con éxito' });
    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

// GET /api/turnos/disponibilidad (calculate doctor slot availability for a date)
router.get('/disponibilidad', authenticateToken, async (req, res) => {
    const { odontologo_id, fecha } = req.query; // fecha format YYYY-MM-DD
    if (!odontologo_id || !fecha) {
        return res.status(400).json({ error: 'odontologo_id y fecha son obligatorios' });
    }

    try {
        // 1. Fetch professional's schedule configurations
        const profs = await userDb.query(
            `SELECT lunes, martes, miercoles, jueves, viernes, sabado, 
                    duracion_consulta, espacio_entre_turnos, cantidad_turnos_diarios, 
                    horario_inicio, observaciones_agenda, horario_inicio_tarde, cantidad_turnos_tarde,
                    lunes_inicio, lunes_turnos, lunes_inicio_tarde, lunes_turnos_tarde,
                    martes_inicio, martes_turnos, martes_inicio_tarde, martes_turnos_tarde,
                    miercoles_inicio, miercoles_turnos, miercoles_inicio_tarde, miercoles_turnos_tarde,
                    jueves_inicio, jueves_turnos, jueves_inicio_tarde, jueves_turnos_tarde,
                    viernes_inicio, viernes_turnos, viernes_inicio_tarde, viernes_turnos_tarde,
                    sabado_inicio, sabado_turnos, sabado_inicio_tarde, sabado_turnos_tarde 
             FROM \`user\` WHERE id = ?`,  
            [odontologo_id], 
            req.user.rol
        );

        if (profs.length === 0) {
            return res.status(404).json({ error: 'Profesional no encontrado' });
        }

        const config = profs[0];
        
        // 2. Identify day of week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
        const dateObj = new Date(fecha + 'T00:00:00');
        const dayOfWeek = dateObj.getDay();

        // 3. Map day of week to column
        const dayColumns = {
            1: 'lunes',
            2: 'martes',
            3: 'miercoles',
            4: 'jueves',
            5: 'viernes',
            6: 'sabado'
        };

        const dayCol = dayColumns[dayOfWeek];
        const worksThatDay = dayCol ? config[dayCol] === 1 : false;

        // 4. Query active appointments for this doctor on this day
        const startOfDay = `${fecha} 00:00:00`;
        const endOfDay = `${fecha} 23:59:59`;

        const activeAppointments = await userDb.query(
            `SELECT t.*, 
                    p.nombre as paciente_nombre, p.apellido as paciente_apellido, p.dni as paciente_dni, p.telefono as paciente_telefono
             FROM turno t
             INNER JOIN paciente p ON t.paciente_id = p.id
             WHERE t.odontologo_id = ? 
               AND t.fecha_hora BETWEEN ? AND ?
               AND t.estado != 'cancelado'
               AND t.FechaBaja IS NULL`,
            [odontologo_id, startOfDay, endOfDay],
            req.user.rol
        );

        if (!worksThatDay) {
            if (activeAppointments.length > 0) {
                // Generate slots ONLY for the active appointments
                const slots = activeAppointments.map(app => {
                    let appTime = '';
                    if (app.fecha_hora instanceof Date) {
                        const pad = (n) => String(n).padStart(2, '0');
                        appTime = `${pad(app.fecha_hora.getHours())}:${pad(app.fecha_hora.getMinutes())}`;
                    } else {
                        appTime = String(app.fecha_hora).split(' ')[1]?.slice(0, 5) || '00:00';
                    }
                    const slotDateTimeStr = `${fecha} ${appTime}:00`;
                    return {
                        hora: appTime,
                        dateTime: slotDateTimeStr,
                        estado: 'ocupado',
                        turno_id: app.id,
                        paciente: {
                            id: app.paciente_id,
                            nombre: app.paciente_nombre,
                            apellido: app.paciente_apellido,
                            dni: app.paciente_dni,
                            telefono: app.paciente_telefono
                        },
                        estado_turno: app.estado,
                        motivo: app.motivo,
                        notas: app.notas
                    };
                });

                // Sort slots by hour
                slots.sort((a, b) => a.hora.localeCompare(b.hora));

                return res.json({
                    disponible: true,
                    esDiaNoLaboralConTurnos: true,
                    observaciones: "Día no laborable configurado, pero existen turnos agendados históricamente.",
                    slots
                });
            } else {
                return res.json({ 
                    disponible: false, 
                    observaciones: config.observaciones_agenda,
                    slots: [] 
                });
            }
        }

        // 5. Generate slots
        const slots = [];
        const duration = parseInt(config.duracion_consulta || "30");
        const gap = parseInt(config.espacio_entre_turnos || "0");

        const generateShiftSlots = (startStr, count) => {
            if (!startStr || !count || count <= 0) return;
            const [hours, mins] = startStr.split(':').map(Number);
            let currentMins = hours * 60 + mins;

            for (let i = 0; i < count; i++) {
                const slotHour = Math.floor(currentMins / 60);
                const slotMin = currentMins % 60;
                const timeStr = `${String(slotHour).padStart(2, '0')}:${String(slotMin).padStart(2, '0')}`;

                const slotDateTimeStr = `${fecha} ${timeStr}:00`;
                const slotStart = new Date(fecha + 'T' + timeStr + ':00Z');
                const slotEnd = new Date(slotStart.getTime() + duration * 60000);

                // Check if there is an overlapping appointment
                const matchingApp = activeAppointments.find(app => {
                    let appDateStr = '';
                    if (app.fecha_hora instanceof Date) {
                        const pad = (n) => String(n).padStart(2, '0');
                        appDateStr = `${app.fecha_hora.getFullYear()}-${pad(app.fecha_hora.getMonth()+1)}-${pad(app.fecha_hora.getDate())}T${pad(app.fecha_hora.getHours())}:${pad(app.fecha_hora.getMinutes())}:${pad(app.fecha_hora.getSeconds())}`;
                    } else {
                        appDateStr = String(app.fecha_hora).slice(0, 19).replace(' ', 'T');
                    }
                    const appStart = new Date(appDateStr + 'Z');
                    const appDuration = parseInt(app.duracion_minutos || "30");
                    const appEnd = new Date(appStart.getTime() + appDuration * 60000);
                    
                    return appStart < slotEnd && appEnd > slotStart;
                });

                if (matchingApp) {
                    slots.push({
                        hora: timeStr,
                        dateTime: slotDateTimeStr,
                        estado: 'ocupado',
                        turno_id: matchingApp.id,
                        paciente: {
                            id: matchingApp.paciente_id,
                            nombre: matchingApp.paciente_nombre,
                            apellido: matchingApp.paciente_apellido,
                            dni: matchingApp.paciente_dni,
                            telefono: matchingApp.paciente_telefono
                        },
                        estado_turno: matchingApp.estado,
                        motivo: matchingApp.motivo,
                        notas: matchingApp.notas
                    });
                } else {
                    slots.push({
                        hora: timeStr,
                        dateTime: slotDateTimeStr,
                        estado: 'libre',
                        duracion: duration
                    });
                }

                currentMins += (duration + gap);
            }
        };

        // Morning Shift
        generateShiftSlots(config[`${dayCol}_inicio`], config[`${dayCol}_turnos`]);

        // Afternoon Shift
        generateShiftSlots(config[`${dayCol}_inicio_tarde`], config[`${dayCol}_turnos_tarde`]);

        // Append any orphaned appointments
        activeAppointments.forEach(app => {
            let appTime = '';
            if (app.fecha_hora instanceof Date) {
                const pad = (n) => String(n).padStart(2, '0');
                appTime = `${pad(app.fecha_hora.getHours())}:${pad(app.fecha_hora.getMinutes())}`;
            } else {
                appTime = String(app.fecha_hora).split(' ')[1]?.slice(0, 5) || '00:00';
            }
            
            const exists = slots.some(s => s.estado === 'ocupado' && s.turno_id === app.id);
            if (!exists) {
                const isOverbooking = slots.some(s => s.hora === appTime);
                const slotDateTimeStr = `${fecha} ${appTime}:00`;
                slots.push({
                    hora: appTime,
                    dateTime: slotDateTimeStr,
                    estado: 'ocupado',
                    esSobreTurno: isOverbooking,
                    turno_id: app.id,
                    paciente: {
                        id: app.paciente_id,
                        nombre: app.paciente_nombre,
                        apellido: app.paciente_apellido,
                        dni: app.paciente_dni,
                        telefono: app.paciente_telefono
                    },
                    estado_turno: app.estado,
                    motivo: app.motivo,
                    notas: app.notas
                });
            }
        });

        // Chronological Sort
        slots.sort((a, b) => a.hora.localeCompare(b.hora));

        res.json({
            disponible: true,
            observaciones: config.observaciones_agenda,
            slots
        });

    } catch (err) {
        res.status(500).json({ error: err.message });
    }
});

module.exports = router;
