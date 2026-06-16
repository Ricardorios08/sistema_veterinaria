import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import {
    Calendar as CalendarIcon,
    Clock,
    User,
    UserCheck,
    Plus,
    ChevronLeft,
    ChevronRight,
    Check,
    X,
    Clipboard,
    Trash2,
    CalendarDays,
    Smile,
    Sparkles,
    Info
} from 'lucide-react';

const Appointments = ({ user }) => {
    // Current selected date & doctor
    const [selectedDate, setSelectedDate] = useState(new Date().toISOString().slice(0, 10)); // YYYY-MM-DD
    const [selectedDoctorId, setSelectedDoctorId] = useState('');
    const [doctors, setDoctors] = useState([]);
    const [patients, setPatients] = useState([]);

    // Calendar months state
    const [currentYear, setCurrentYear] = useState(new Date().getFullYear());
    const [currentMonth, setCurrentMonth] = useState(new Date().getMonth()); // 0-indexed

    // Doctor details & availability
    const [doctorConfig, setDoctorConfig] = useState(null);
    const [availability, setAvailability] = useState({ disponible: false, slots: [], observaciones: '' });
    const [loadingSlots, setLoadingSlots] = useState(false);

    // Modals & form state
    const [showCreateModal, setShowCreateModal] = useState(false);
    const [targetSlotTime, setTargetSlotTime] = useState('');
    const [pacienteId, setPacienteId] = useState('');
    const [motivo, setMotivo] = useState('');
    const [notas, setNotas] = useState('');
    const [errorMsg, setErrorMsg] = useState('');
    const [savingAppointment, setSavingAppointment] = useState(false);

    const [showSlotsModal, setShowSlotsModal] = useState(false);
    const [isMobile, setIsMobile] = useState(window.innerWidth <= 1024);

    useEffect(() => {
        const handleResize = () => setIsMobile(window.innerWidth <= 1024);
        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, []);
    const [patientSearch, setPatientSearch] = useState('');
    const [filteredSuggestions, setFilteredSuggestions] = useState([]);
    const [selectedPatientObj, setSelectedPatientObj] = useState(null);
    const [isRegisteringPatient, setIsRegisteringPatient] = useState(false);
    const [newPatient, setNewPatient] = useState({
        nombre: '',
        apellido: '',
        dni: '',
        telefono: '',
        email: ''
    });
    const [obrasSociales, setObrasSociales] = useState([]);

    const handleSearchChange = (val) => {
        setPatientSearch(val);
        if (val.trim() === '') {
            setFilteredSuggestions([]);
            return;
        }
        const lower = val.toLowerCase();
        const filtered = patients.filter(p =>
            p.nombre.toLowerCase().includes(lower) ||
            p.apellido.toLowerCase().includes(lower) ||
            p.dni.toLowerCase().includes(lower)
        );
        setFilteredSuggestions(filtered.slice(0, 10)); // Limit to 10 results
    };

    const monthNames = [
        'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];

    useEffect(() => {
        fetchInitialData();
    }, []);

    useEffect(() => {
        if (selectedDoctorId) {
            fetchDoctorConfig(selectedDoctorId);
        }
    }, [selectedDoctorId]);

    useEffect(() => {
        if (selectedDoctorId && selectedDate) {
            fetchAvailability(selectedDoctorId, selectedDate);
        }
    }, [selectedDoctorId, selectedDate]);

    const fetchInitialData = async () => {
        try {
            const [patRes, docRes] = await Promise.all([
                axios.get(`${API_URL}/pacientes`),
                axios.get(`${API_URL}/auth/users`)
            ]);
            setPatients(patRes.data);

            // Filter users to only professional roles
            const profs = docRes.data.filter(u => {
                const userRoles = u.roles ? u.roles.split(',') : [u.rol];
                return userRoles.some(r => ['profesional', 'veterinario', 'peluquero', 'traslado'].includes(r));
            });
            setDoctors(profs);

            // Automatically select professional based on role
            if (['profesional', 'veterinario', 'peluquero', 'traslado'].includes(user?.rol)) {
                setSelectedDoctorId(String(user.id));
            } else if (profs.length > 0) {
                setSelectedDoctorId(String(profs[0].id));
            }
        } catch (e) {
            console.error('Error fetching initial data:', e);
        }
    };

    const fetchDoctorConfig = async (docId) => {
        try {
            const res = await axios.get(`${API_URL}/turnos/config-horarios/${docId}`);
            setDoctorConfig(res.data);
        } catch (e) {
            console.error('Error fetching doctor config:', e);
            setDoctorConfig(null);
        }
    };

    const fetchAvailability = async (docId, date) => {
        setLoadingSlots(true);
        try {
            const res = await axios.get(`${API_URL}/turnos/disponibilidad`, {
                params: { odontologo_id: docId, fecha: date }
            });
            setAvailability(res.data);
        } catch (e) {
            console.error('Error fetching availability:', e);
            setAvailability({ disponible: false, slots: [], observaciones: '' });
        } finally {
            setLoadingSlots(false);
        }
    };

    // Calendar Calculations
    const getDaysInMonth = (year, month) => new Date(year, month + 1, 0).getDate();

    const getFirstDayOffset = (year, month) => {
        const day = new Date(year, month, 1).getDay(); // 0 = Sun, 1 = Mon...
        return day === 0 ? 6 : day - 1; // Mon = 0, ..., Sun = 6
    };

    const handleNavigateMonth = (direction) => {
        let newMonth = currentMonth + direction;
        let newYear = currentYear;

        if (newMonth < 0) {
            newMonth = 11;
            newYear -= 1;
        } else if (newMonth > 11) {
            newMonth = 0;
            newYear += 1;
        }

        setCurrentMonth(newMonth);
        setCurrentYear(newYear);
    };

    const handleSelectDay = (day) => {
        const formattedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        setSelectedDate(formattedDate);
        if (isMobile) {
            setShowSlotsModal(true);
        }
    };

    // Check if the doctor works on a given weekday (js index 0=Sun, 1=Mon... 6=Sat)
    const checkDoctorWorksOnDay = (dayNum) => {
        if (!doctorConfig) return false;
        const dObj = new Date(currentYear, currentMonth, dayNum);
        const dayOfWeek = dObj.getDay();

        const dayMap = {
            1: 'lunes',
            2: 'martes',
            3: 'miercoles',
            4: 'jueves',
            5: 'viernes',
            6: 'sabado'
        };

        const colName = dayMap[dayOfWeek];
        return colName ? doctorConfig[colName] === 1 : false;
    };

    // Check scheduling status for a day
    const getCalendarDayClass = (dayNum) => {
        const formattedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(dayNum).padStart(2, '0')}`;
        const isSelected = selectedDate === formattedDate;
        const works = checkDoctorWorksOnDay(dayNum);
        const isToday = new Date().toISOString().slice(0, 10) === formattedDate;

        let className = 'calendar-day';
        if (isSelected) className += ' active-day';
        else if (isToday) className += ' today-day';

        if (works) className += ' works-day';
        else className += ' off-day';

        return className;
    };

    const handleOpenBooking = (slot) => {
        setTargetSlotTime(slot.hora);
        setPacienteId('');
        setSelectedPatientObj(null);
        setPatientSearch('');
        setFilteredSuggestions([]);
        setIsRegisteringPatient(false);
        setNewPatient({
            nombre: '',
            apellido: '',
            dni: '',
            telefono: '',
            email: '',
            cobertura_medica: '',
            obra_social_id: ''
        });
        setMotivo('');
        setNotas('');
        setErrorMsg('');
        setShowCreateModal(true);
    };

    const handleCreateAppointment = async (e) => {
        e.preventDefault();
        setErrorMsg('');

        let activePacienteId = pacienteId;

        if (isRegisteringPatient) {
            if (!newPatient.nombre || !newPatient.apellido || !newPatient.dni) {
                setErrorMsg('Nombre, apellido y DNI del paciente son obligatorios.');
                return;
            }

            if (!newPatient.email && !newPatient.telefono) {
                setErrorMsg('Debe ingresar al menos un medio de contacto (Email o Teléfono/WhatsApp).');
                return;
            }

            setSavingAppointment(true);
            try {
                // 1. Create patient in Odomed database
                await axios.post(`${API_URL}/pacientes`, {
                    nombre: newPatient.nombre,
                    apellido: newPatient.apellido,
                    dni: newPatient.dni,
                    telefono: newPatient.telefono || null,
                    email: newPatient.email || null,
                    cobertura_medica: newPatient.cobertura_medica || null,
                    obra_social_id: newPatient.obra_social_id ? parseInt(newPatient.obra_social_id) : null
                });

                // 2. Fetch updated patients list
                const patRes = await axios.get(`${API_URL}/pacientes`);
                setPatients(patRes.data);

                // 3. Find by unique DNI to grab the generated ID
                const created = patRes.data.find(p => p.dni === newPatient.dni);
                if (!created) {
                    throw new Error('Error al recuperar el paciente recién registrado.');
                }

                activePacienteId = String(created.id);
            } catch (err) {
                setErrorMsg(err.response?.data?.error || 'Error al registrar al paciente.');
                setSavingAppointment(false);
                return;
            }
        }

        if (!activePacienteId) {
            setErrorMsg('Por favor selecciona un paciente o regístralo.');
            setSavingAppointment(false);
            return;
        }

        setSavingAppointment(true);
        try {
            const startDateTimeStr = `${selectedDate}T${targetSlotTime}:00`;

            await axios.post(`${API_URL}/turnos`, {
                paciente_id: parseInt(activePacienteId),
                odontologo_id: parseInt(selectedDoctorId),
                fecha_hora: startDateTimeStr,
                duracion_minutos: doctorConfig ? doctorConfig.duracion_consulta : 30,
                motivo,
                notes: notas
            });

            setShowCreateModal(false);
            fetchAvailability(selectedDoctorId, selectedDate);
        } catch (err) {
            setErrorMsg(err.response?.data?.error || 'Error al guardar el turno.');
        } finally {
            setSavingAppointment(false);
        }
    };

    const handleUpdateStatus = async (turnId, newStatus) => {
        try {
            await axios.put(`${API_URL}/turnos/${turnId}`, { estado: newStatus });
            fetchAvailability(selectedDoctorId, selectedDate);
        } catch (err) {
            alert(err.response?.data?.error || 'Error al cambiar estado');
        }
    };

    const handleCancelAppointment = async (turnId) => {
        if (!window.confirm('¿Está seguro de cancelar este turno?')) return;
        try {
            await axios.delete(`${API_URL}/turnos/${turnId}`);
            fetchAvailability(selectedDoctorId, selectedDate);
        } catch (err) {
            alert('Error al cancelar el turno');
        }
    };

    // Render calendar grid cells
    const renderCalendarCells = () => {
        const offset = getFirstDayOffset(currentYear, currentMonth);
        const daysInMonth = getDaysInMonth(currentYear, currentMonth);
        const cells = [];

        // Fill empty spaces before first day
        for (let i = 0; i < offset; i++) {
            cells.push(<div key={`empty-${i}`} className="calendar-day empty"></div>);
        }

        // Fill days of the month
        for (let d = 1; d <= daysInMonth; d++) {
            const hasShift = checkDoctorWorksOnDay(d);
            cells.push(
                <button
                    key={`day-${d}`}
                    onClick={() => handleSelectDay(d)}
                    className={getCalendarDayClass(d)}
                >
                    <span className="day-number">{d}</span>
                    {hasShift && <span className="shift-dot" title="Día de Atención"></span>}
                </button>
            );
        }

        return cells;
    };

    // Quick active days description
    const getDoctorConfigText = () => {
        if (!doctorConfig) return 'Cargando horarios...';

        const days = [];
        if (doctorConfig.lunes) days.push('Lunes');
        if (doctorConfig.martes) days.push('Martes');
        if (doctorConfig.miercoles) days.push('Miércoles');
        if (doctorConfig.jueves) days.push('Jueves');
        if (doctorConfig.viernes) days.push('Viernes');
        if (doctorConfig.sabado) days.push('Sábado');

        if (days.length === 0) return 'Sin días de atención configurados';
        return `Atiende: ${days.join(', ')} | Turno: ${doctorConfig.horario_inicio} (${doctorConfig.cantidad_turnos_diarios} turnos de ${doctorConfig.duracion_consulta} min, gap ${doctorConfig.espacio_entre_turnos} min)`;
    };
    const pad = n => String(n).padStart(2, '0');
    const now = new Date();
    const todayStr = `${now.getFullYear()}-${pad(now.getMonth() + 1)}-${pad(now.getDate())}`;
    const isTodayView = selectedDate === todayStr;

    return (
        <div className="body-content" style={{ overflowY: 'auto', maxHeight: 'calc(100vh - 100px)', paddingRight: '0.5rem' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.5rem' }}>
                <div>
                    <h1 style={{ margin: 0 }}>Agenda y Disponibilidad</h1>
                    <p style={{ color: 'var(--text-dim)', margin: '4px 0 0 0' }}>Carga y gestión de turnos optimizada para Recepción</p>
                </div>
                {!['profesional', 'veterinario', 'peluquero', 'traslado'].includes(user?.rol) && (
                    <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
                        <label style={{ fontSize: '0.9rem', color: 'var(--text-dim)', fontWeight: 'bold' }}>Profesional:</label>
                        <select
                            className="input-field"
                            value={selectedDoctorId}
                            onChange={(e) => setSelectedDoctorId(e.target.value)}
                            style={{ marginBottom: 0, padding: '0.4rem 1.5rem', minHeight: 'auto', width: 'auto', fontSize: '0.9rem' }}
                        >
                            <option value="">Selecciona profesional...</option>
                            {doctors.map(d => (
                                <option key={d.id} value={d.id}>{d.nombre_usuario.toUpperCase()}</option>
                            ))}
                        </select>
                    </div>
                )}
            </div>

            {/* DYNAMIC SHIFT OVERVIEW CARD */}
            <div className="user-form-card" style={{ padding: '0.8rem 1.2rem', marginBottom: '1.5rem', display: 'flex', gap: '0.5rem', alignItems: 'center', background: 'rgba(59, 130, 246, 0.05)', border: '1px solid rgba(59,130,246,0.15)' }}>
                <Info size={16} color="var(--primary)" />
                <span style={{ fontSize: '0.85rem', color: '#93c5fd' }}>
                    {getDoctorConfigText()}
                </span>
            </div>

            {/* MAIN INTERACTIVE GRID SPLIT */}
            <div className="appointments-grid">

                {/* CALENDAR COLUMN */}
                <div>
                    <div className="users-list-card" style={{ padding: '1rem' }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
                            <h3 style={{ margin: 0, color: '#fff', fontSize: '1rem', display: 'flex', alignItems: 'center', gap: '6px' }}>
                                <CalendarDays size={18} color="var(--primary)" />
                                {monthNames[currentMonth]} {currentYear}
                            </h3>
                            <div style={{ display: 'flex', gap: '0.3rem' }}>
                                <button onClick={() => handleNavigateMonth(-1)} className="btn btn-secondary" style={{ padding: '0.3rem', width: 'auto', minHeight: 'auto' }}>
                                    <ChevronLeft size={16} />
                                </button>
                                <button onClick={() => {
                                    setCurrentMonth(new Date().getMonth());
                                    setCurrentYear(new Date().getFullYear());
                                    setSelectedDate(new Date().toISOString().slice(0, 10));
                                }} className="btn" style={{ padding: '0.3rem 0.6rem', fontSize: '0.75rem', width: 'auto', minHeight: 'auto' }}>
                                    Hoy
                                </button>
                                <button onClick={() => handleNavigateMonth(1)} className="btn btn-secondary" style={{ padding: '0.3rem', width: 'auto', minHeight: 'auto' }}>
                                    <ChevronRight size={16} />
                                </button>
                            </div>
                        </div>

                        {/* CALENDAR HEADER ROWS */}
                        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(7, 1fr)', gap: '4px', textAlign: 'center', marginBottom: '4px' }}>
                            {['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'].map(wd => (
                                <div key={wd} style={{ fontSize: '0.75rem', color: 'var(--text-dim)', padding: '2px', fontWeight: 'bold' }}>{wd}</div>
                            ))}
                        </div>

                        {/* CALENDAR DAY GRID CELLS */}
                        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(7, 1fr)', gap: '4px' }}>
                            {renderCalendarCells()}
                        </div>
                    </div>
                </div>

                {/* TIMELINE SLOTS COLUMN */}
                {(!isMobile || showSlotsModal) && (
                    <div 
                        className={isMobile ? "modal-overlay" : ""} 
                        onClick={() => isMobile && setShowSlotsModal(false)} 
                        style={isMobile ? { position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, zIndex: 1000, background: 'rgba(0,0,0,0.6)', display: 'flex', alignItems: 'center', justifyContent: 'center', padding: '1rem', backdropFilter: 'blur(4px)' } : {}}
                    >
                        <div 
                            className={isMobile ? "modal-content" : "users-list-card"} 
                            onClick={e => isMobile && e.stopPropagation()} 
                            style={isMobile ? { width: '100%', maxWidth: '600px', maxHeight: '90vh', overflowY: 'auto', background: 'var(--bg)', padding: '1.5rem', borderRadius: '12px' } : {}}
                        >
                            {isMobile && (
                                <div style={{ display: 'flex', justifyContent: 'flex-end', marginBottom: '0.5rem' }}>
                                    <button className="close-btn" onClick={() => setShowSlotsModal(false)}>×</button>
                                </div>
                            )}
                            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', borderBottom: '1px solid var(--border)', paddingBottom: '0.8rem', marginBottom: '1.2rem' }}>
                            <h2 style={{ margin: 0, fontSize: '1.1rem' }}>
                                Disponibilidad del Día:{' '}
                                <span style={{ color: 'var(--primary)' }}>
                                    {new Date(selectedDate + 'T00:00:00').toLocaleDateString('es-AR', { weekday: 'long', day: 'numeric', month: 'long' })}
                                </span>
                            </h2>
                        </div>

                        {loadingSlots ? (
                            <div style={{ textAlign: 'center', padding: '3rem', color: 'var(--text-dim)' }}>
                                <Clock className="spinner" size={24} style={{ margin: '0 auto 0.5rem auto', animation: 'spin 1.5s linear infinite' }} />
                                <span>Calculando agenda y disponibilidad...</span>
                            </div>
                        ) : !availability.disponible ? (
                            <div style={{ textAlign: 'center', padding: '4rem 2rem', background: 'rgba(0,0,0,0.15)', borderRadius: '10px', border: '1px dashed var(--border)' }}>
                                <CalendarIcon size={32} style={{ margin: '0 auto 1rem auto', color: 'var(--text-dim)', opacity: 0.5 }} />
                                <h3 style={{ margin: 0, color: 'var(--text-dim)', fontSize: '1rem' }}>El profesional no atiende este día</h3>
                                <p style={{ fontSize: '0.8rem', color: 'rgba(255,255,255,0.3)', marginTop: '4px' }}>
                                    {availability.observaciones || 'No hay configuraciones semanales de agenda registradas para el día seleccionado.'}
                                </p>
                            </div>
                        ) : availability.slots.length === 0 ? (
                            <p style={{ textAlign: 'center', padding: '2rem', color: 'var(--text-dim)' }}>Sin turnos configurados para generar.</p>
                        ) : (
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '0.8rem' }}>
                                {availability.esDiaNoLaboralConTurnos && (
                                    <div style={{ 
                                        padding: '0.8rem 1rem', 
                                        background: 'rgba(239, 68, 68, 0.05)', 
                                        border: '1px solid rgba(239, 68, 68, 0.25)', 
                                        borderRadius: '8px', 
                                        color: '#fca5a5', 
                                        fontSize: '0.85rem', 
                                        display: 'flex', 
                                        alignItems: 'center', 
                                        gap: '0.5rem',
                                        marginBottom: '0.5rem'
                                    }}>
                                        <Info size={16} />
                                        <span><strong>Aviso de Agenda:</strong> El profesional cambió sus días de atención y no atiende habitualmente este día, pero existen turnos históricos activos agendados.</span>
                                    </div>
                                )}
                                {availability.slots.map((slot, index) => (
                                    <div
                                        key={index}
                                        style={{
                                            display: 'flex',
                                            alignItems: 'center',
                                            justifyContent: 'space-between',
                                            padding: '0.8rem 1.2rem',
                                            background: slot.estado === 'libre' ? 'rgba(16, 185, 129, 0.02)' : slot.esSobreTurno ? 'rgba(249, 115, 22, 0.05)' : 'rgba(255, 255, 255, 0.01)',
                                            border: `1px solid ${slot.estado === 'libre' ? 'rgba(16, 185, 129, 0.15)' : slot.esSobreTurno ? 'rgba(249, 115, 22, 0.3)' : 'var(--border)'}`,
                                            borderRadius: '10px',
                                            transition: 'all 0.2s ease',
                                            gap: '1rem',
                                            flexWrap: 'wrap'
                                        }}
                                    >
                                        {/* LEFT INFO: TIME & STATUS */}
                                        <div style={{ display: 'flex', alignItems: 'center', gap: '1.5rem' }}>
                                            {/* TIME BLOCK */}
                                            <div style={{ display: 'flex', flexDirection: 'column', minWidth: '60px', borderRight: `2px solid ${slot.estado === 'libre' ? '#10b981' : slot.esSobreTurno ? '#f97316' : 'var(--primary)'}`, paddingRight: '1rem' }}>
                                                <span style={{ fontSize: '1.1rem', fontWeight: 'bold', color: '#fff', display: 'flex', alignItems: 'center', gap: '4px' }}>
                                                    <Clock size={14} color={slot.estado === 'libre' ? '#10b981' : slot.esSobreTurno ? '#f97316' : 'var(--primary)'} />
                                                    {slot.hora}
                                                </span>
                                                <span style={{ fontSize: '0.7rem', color: 'var(--text-dim)', textAlign: 'right' }}>{slot.duracion || 30} m</span>
                                            </div>

                                            {/* CENTER INFO: FREE OR APPOINTMENT INFO */}
                                            {slot.estado === 'libre' ? (
                                                <div style={{ display: 'flex', alignItems: 'center', gap: '6px' }}>
                                                    <span style={{ color: '#10b981', background: 'rgba(16, 185, 129, 0.1)', padding: '0.2rem 0.5rem', borderRadius: '6px', fontSize: '0.75rem', fontWeight: 'bold' }}>
                                                        LIBRE
                                                    </span>
                                                    <span style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>Disponible para reservar</span>
                                                </div>
                                            ) : (
                                                <div>
                                                    <h4 style={{ margin: 0, fontSize: '0.95rem', color: 'var(--primary)' }}>
                                                        {slot.paciente.apellido}, {slot.paciente.nombre}
                                                    </h4>
                                                    <p style={{ margin: '2px 0 0 0', fontSize: '0.8rem', color: 'var(--text-dim)' }}>
                                                        DNI: {slot.paciente.dni} | Tel: {slot.paciente.telefono || 'Sin teléfono'}
                                                    </p>
                                                    {slot.motivo && (
                                                        <p style={{ margin: '2px 0 0 0', fontSize: '0.75rem', color: '#94a3b8', display: 'flex', alignItems: 'center', gap: '3px' }}>
                                                            <Clipboard size={10} /> Motivo: {slot.motivo}
                                                        </p>
                                                    )}
                                                </div>
                                            )}
                                        </div>

                                        {/* RIGHT ACTIONS */}
                                        <div>
                                            {slot.estado === 'libre' ? (
                                                <button
                                                    onClick={() => handleOpenBooking(slot)}
                                                    className="btn btn-primary"
                                                    style={{
                                                        width: 'auto',
                                                        padding: '0.4rem 1.2rem',
                                                        background: '#10b981',
                                                        borderColor: '#10b981',
                                                        fontSize: '0.85rem',
                                                        display: 'flex',
                                                        alignItems: 'center',
                                                        gap: '4px'
                                                    }}
                                                >
                                                    <Plus size={14} />
                                                    Agendar Turno
                                                </button>
                                            ) : (
                                                <div style={{ display: 'flex', alignItems: 'center', gap: '0.8rem' }}>
                                                    {/* SOBRETURNO BUTTON */}
                                                    {availability.slots.filter(s => s.hora === slot.hora).length < 2 && (
                                                        <button
                                                            onClick={() => handleOpenBooking(slot)}
                                                            className="btn"
                                                            style={{
                                                                width: 'auto',
                                                                padding: '0.3rem 0.6rem',
                                                                background: 'rgba(249, 115, 22, 0.1)',
                                                                color: '#f97316',
                                                                border: '1px solid rgba(249, 115, 22, 0.3)',
                                                                fontSize: '0.75rem',
                                                                display: 'flex',
                                                                alignItems: 'center',
                                                                gap: '4px',
                                                                minHeight: 'auto'
                                                            }}
                                                            title="Agendar un Sobre Turno en este mismo horario"
                                                        >
                                                            <Plus size={12} />
                                                            Sobre Turno
                                                        </button>
                                                    )}

                                                    {/* BADGE */}
                                                    <span className={`role-badge ${slot.estado_turno}`} style={{ textTransform: 'uppercase', padding: '0.2rem 0.6rem', fontSize: '0.65rem', background: slot.esSobreTurno ? '#f97316' : undefined, color: slot.esSobreTurno ? '#fff' : undefined }}>
                                                        {slot.esSobreTurno ? `SOBRETURNO • ${slot.estado_turno}` : slot.estado_turno}
                                                    </span>

                                                    {/* QUICK ACTIONS */}
                                                    {slot.estado_turno === 'pendiente' && (
                                                        <div style={{ display: 'flex', gap: '0.3rem' }}>
                                                            {isTodayView && (
                                                                <button
                                                                    onClick={() => handleUpdateStatus(slot.turno_id, 'confirmado')}
                                                                    className="btn"
                                                                    style={{ padding: '0.3rem 0.6rem', fontSize: '0.75rem', width: 'auto', minHeight: 'auto', background: 'rgba(59, 130, 246, 0.1)', color: '#93c5fd', border: '1px solid rgba(59, 130, 246, 0.2)' }}
                                                                    title="Confirmar Cita (Solo habilitado el día del turno)"
                                                                >
                                                                    Confirmar
                                                                </button>
                                                            )}
                                                            <button
                                                                onClick={() => handleCancelAppointment(slot.turno_id)}
                                                                className="delete-btn"
                                                                style={{ padding: '0.3rem', width: 'auto', minHeight: 'auto' }}
                                                                title="Cancelar Turno"
                                                            >
                                                                <X size={14} />
                                                            </button>
                                                        </div>
                                                    )}
                                                </div>
                                            )}
                                        </div>
                                    </div>
                                ))}
                            </div>
                        )}
                    </div>
                </div>
            )}
            </div>

            {/* DYNAMIC BOOKING SHIFT FORM MODAL */}
            {showCreateModal && (
                <div style={{
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
                    background: 'rgba(0,0,0,0.6)', display: 'flex', justifyContent: 'center', alignItems: 'center',
                    zIndex: 1000, backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '95%', maxWidth: '650px', maxHeight: '90vh', overflowY: 'auto' }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.5rem' }}>
                            <h2 style={{ margin: 0 }}>Agendar Cita de Turno</h2>
                            <span style={{ color: '#10b981', fontWeight: 'bold', fontSize: '0.9rem', background: 'rgba(16, 185, 129, 0.1)', padding: '0.2rem 0.6rem', borderRadius: '6px' }}>
                                Slot {targetSlotTime}
                            </span>
                        </div>

                        <form onSubmit={handleCreateAppointment} className="login-form">
                            {/* SEARCHABLE PATIENT AUTOCOMPLETE OR ON-THE-FLY CREATION */}
                            {selectedPatientObj ? (
                                /* Patient Card Selected */
                                <div style={{
                                    background: 'rgba(16, 185, 129, 0.05)',
                                    border: '1px solid rgba(16, 185, 129, 0.25)',
                                    borderRadius: '10px',
                                    padding: '0.8rem 1.2rem',
                                    marginBottom: '1.5rem',
                                    display: 'flex',
                                    justifyContent: 'space-between',
                                    alignItems: 'center'
                                }}>
                                    <div>
                                        <h4 style={{ margin: 0, color: '#10b981', fontSize: '1rem' }}>
                                            {selectedPatientObj.apellido.toUpperCase()}, {selectedPatientObj.nombre}
                                        </h4>
                                        <div style={{ display: 'flex', gap: '1rem', marginTop: '4px', fontSize: '0.8rem', color: 'var(--text-dim)' }}>
                                            <span>DNI: <strong>{selectedPatientObj.dni}</strong></span>
                                        </div>
                                        <div style={{ marginTop: '2px', fontSize: '0.8rem', color: 'var(--text-dim)' }}>
                                            Teléfono: <strong>{selectedPatientObj.telefono || 'Sin registrar'}</strong>
                                        </div>
                                    </div>
                                    <button
                                        type="button"
                                        onClick={() => {
                                            setSelectedPatientObj(null);
                                            setPacienteId('');
                                        }}
                                        className="delete-btn"
                                        style={{ padding: '0.3rem 0.8rem', fontSize: '0.8rem' }}
                                    >
                                        Cambiar
                                    </button>
                                </div>
                            ) : isRegisteringPatient ? (
                                /* Inline New Patient Sub-form */
                                <div style={{
                                    background: 'rgba(234, 179, 8, 0.03)',
                                    border: '1px solid rgba(234, 179, 8, 0.15)',
                                    borderRadius: '10px',
                                    padding: '1.2rem',
                                    marginBottom: '1.5rem'
                                }}>
                                    <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
                                        <h3 style={{ margin: 0, fontSize: '0.95rem', color: '#fef08a' }}>Registrar Nuevo Paciente</h3>
                                        <button
                                            type="button"
                                            onClick={() => setIsRegisteringPatient(false)}
                                            className="btn btn-secondary"
                                            style={{ padding: '0.2rem 0.6rem', fontSize: '0.75rem', minHeight: 'auto', width: 'auto' }}
                                        >
                                            Volver al Buscador
                                        </button>
                                    </div>

                                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.8rem' }}>
                                        <div className="form-group" style={{ marginBottom: '0.8rem' }}>
                                            <label>Nombre *</label>
                                            <input
                                                type="text"
                                                className="input-field"
                                                value={newPatient.nombre}
                                                onChange={e => setNewPatient({ ...newPatient, nombre: e.target.value })}
                                                placeholder="Ej: Juan"
                                                required={isRegisteringPatient}
                                            />
                                        </div>
                                        <div className="form-group" style={{ marginBottom: '0.8rem' }}>
                                            <label>Apellido *</label>
                                            <input
                                                type="text"
                                                className="input-field"
                                                value={newPatient.apellido}
                                                onChange={e => setNewPatient({ ...newPatient, apellido: e.target.value })}
                                                placeholder="Ej: Pérez"
                                                required={isRegisteringPatient}
                                            />
                                        </div>
                                    </div>

                                    <div className="form-group" style={{ marginBottom: '0.8rem' }}>
                                        <label>DNI / Documento * (Obligatorio e Único)</label>
                                        <input
                                            type="text"
                                            className="input-field"
                                            value={newPatient.dni}
                                            onChange={e => setNewPatient({ ...newPatient, dni: e.target.value.trim() })}
                                            placeholder="Ej: 32354807"
                                            required={isRegisteringPatient}
                                        />
                                    </div>

                                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.8rem' }}>
                                        <div className="form-group" style={{ marginBottom: '0.8rem' }}>
                                            <label>Teléfono / WhatsApp</label>
                                            <input
                                                type="text"
                                                className="input-field"
                                                value={newPatient.telefono}
                                                onChange={e => setNewPatient({ ...newPatient, telefono: e.target.value })}
                                                placeholder="Ej: 261555555"
                                            />
                                        </div>
                                        <div className="form-group" style={{ marginBottom: '0.8rem' }}>
                                            <label>Email</label>
                                            <input
                                                type="email"
                                                className="input-field"
                                                value={newPatient.email}
                                                onChange={e => setNewPatient({ ...newPatient, email: e.target.value })}
                                                placeholder="Ej: paciente@gmail.com"
                                            />
                                        </div>
                                    </div>


                                </div>
                            ) : (
                                /* Searchable autocomplete input */
                                <div className="form-group" style={{ position: 'relative', marginBottom: '1.5rem' }}>
                                    <label>Buscar Paciente *</label>
                                    <div style={{ display: 'flex', gap: '0.5rem' }}>
                                        <input
                                            type="text"
                                            className="input-field"
                                            placeholder="Escribe Nombre, Apellido o DNI..."
                                            value={patientSearch}
                                            onChange={(e) => handleSearchChange(e.target.value)}
                                            required={!selectedPatientObj && !isRegisteringPatient}
                                        />
                                        <button
                                            type="button"
                                            onClick={() => setIsRegisteringPatient(true)}
                                            className="btn btn-secondary"
                                            style={{ fontSize: '0.8rem', width: 'auto', whiteSpace: 'nowrap', padding: '0.5rem 1rem' }}
                                        >
                                            + Nuevo Paciente
                                        </button>
                                    </div>

                                    {/* Autocomplete Suggestion Popup */}
                                    {filteredSuggestions.length > 0 && (
                                        <div style={{
                                            position: 'absolute', top: '100%', left: 0, right: 0,
                                            background: '#1e293b', border: '1px solid var(--border)',
                                            borderRadius: '8px', zIndex: 1010, maxHeight: '200px',
                                            overflowY: 'auto', boxShadow: '0 10px 15px -3px rgba(0,0,0,0.5)',
                                            marginTop: '4px'
                                        }}>
                                            {filteredSuggestions.map(p => (
                                                <div
                                                    key={p.id}
                                                    onClick={() => {
                                                        setSelectedPatientObj(p);
                                                        setPacienteId(String(p.id));
                                                        setFilteredSuggestions([]);
                                                        setPatientSearch('');
                                                    }}
                                                    style={{
                                                        padding: '0.6rem 1rem',
                                                        borderBottom: '1px solid rgba(255,255,255,0.03)',
                                                        cursor: 'pointer'
                                                    }}
                                                    className="suggestion-item"
                                                >
                                                    <div style={{ fontWeight: 'bold', fontSize: '0.85rem', color: '#fff' }}>
                                                        {p.apellido.toUpperCase()}, {p.nombre}
                                                    </div>
                                                    <div style={{ fontSize: '0.75rem', color: 'var(--text-dim)', display: 'flex', gap: '12px', marginTop: '2px' }}>
                                                        <span>DNI: <strong>{p.dni}</strong></span>
                                                        <span>Tel: <strong>{p.telefono || 'Sin tel.'}</strong></span>
                                                    </div>
                                                </div>
                                            ))}
                                        </div>
                                    )}
                                </div>
                            )}

                            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                                <div className="form-group">
                                    <label>Fecha Seleccionada</label>
                                    <input
                                        type="text"
                                        className="input-field"
                                        value={selectedDate}
                                        disabled
                                        style={{ opacity: 0.6, cursor: 'not-allowed' }}
                                    />
                                </div>
                                <div className="form-group">
                                    <label>Hora Agendada</label>
                                    <input
                                        type="text"
                                        className="input-field"
                                        value={targetSlotTime}
                                        disabled
                                        style={{ opacity: 0.6, cursor: 'not-allowed' }}
                                    />
                                </div>
                            </div>

                            <div className="form-group">
                                <label>Motivo de Consulta</label>
                                <input
                                    type="text"
                                    className="input-field"
                                    value={motivo}
                                    onChange={e => setMotivo(e.target.value)}
                                    placeholder="Ej: Limpieza, Consulta General, Ortodoncia"
                                />
                            </div>

                            <div className="form-group">
                                <label>Notas Clínicas / Indicaciones</label>
                                <textarea
                                    className="input-field"
                                    rows="2"
                                    value={notas}
                                    onChange={e => setNotas(e.target.value)}
                                    placeholder="Observaciones adicionales para el turno..."
                                    style={{ resize: 'none', padding: '0.5rem' }}
                                />
                            </div>

                            {errorMsg && (
                                <div className="login-error" style={{ marginBottom: '1rem' }}>
                                    {errorMsg}
                                </div>
                            )}

                            <div style={{ display: 'flex', gap: '1rem', justifyContent: 'flex-end', marginTop: '1rem' }}>
                                <button type="button" onClick={() => setShowCreateModal(false)} className="btn">Cancelar</button>
                                <button
                                    type="submit"
                                    className="btn btn-primary"
                                    disabled={savingAppointment}
                                    style={{ width: 'auto', padding: '0.5rem 2.5rem', background: '#10b981', borderColor: '#10b981' }}
                                >
                                    {savingAppointment ? 'Guardando...' : 'Confirmar Reserva'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Appointments;
