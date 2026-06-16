import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { Shield, UserPlus, Trash2, Edit2, Check, X, ShieldAlert } from 'lucide-react';

const UserManagement = () => {
    const [users, setUsers] = useState([]);
    const [nombre, setNombre] = useState('');
    const [apellido, setApellido] = useState('');
    const [password, setPassword] = useState('');
    const [rol, setRol] = useState('profesional');
    const [selectedRoles, setSelectedRoles] = useState(['profesional']);
    const [tipoProfesionalId, setTipoProfesionalId] = useState('');
    const [matricula, setMatricula] = useState('');
    const [mail, setMail] = useState('');
    const [celular, setCelular] = useState('');
    const [direccion, setDireccion] = useState('');
    
    // Prestadores states
    const [prestadores, setPrestadores] = useState([]);
    const [prestadorId, setPrestadorId] = useState('');
    const [editPrestadorId, setEditPrestadorId] = useState('');
    
    // Professional Types lists
    const [professionalTypes, setProfessionalTypes] = useState([]);

    // List filtering states
    const [filterSearch, setFilterSearch] = useState('');
    const [filterRole, setFilterRole] = useState('');
    const [filterPrestador, setFilterPrestador] = useState('');
    
    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState({ type: '', text: '' });

    // Edit state
    const [editingUserId, setEditingUserId] = useState(null);
    const [editPassword, setEditPassword] = useState('');
    const [editRol, setEditRol] = useState('');
    const [editRoles, setEditRoles] = useState([]);
    const [editTipoProfesionalId, setEditTipoProfesionalId] = useState('');
    const [editMatricula, setEditMatricula] = useState('');
    const [editNombre, setEditNombre] = useState('');
    const [editApellido, setEditApellido] = useState('');
    const [editMail, setEditMail] = useState('');
    const [editCelular, setEditCelular] = useState('');
    const [editDireccion, setEditDireccion] = useState('');

    const [currentUser, setCurrentUser] = useState(null);

    const [showCreateModal, setShowCreateModal] = useState(false);

    const handleOpenCreateModal = () => {
        setMessage({ type: '', text: '' });
        setNombre('');
        setApellido('');
        setPassword('');
        setRol('profesional');
        setSelectedRoles(['profesional']);
        setTipoProfesionalId('');
        setMatricula('');
        setPrestadorId('');
        setMail('');
        setCelular('');
        setDireccion('');
        setShowCreateModal(true);
    };

    // Schedule config states
    const [showScheduleModal, setShowScheduleModal] = useState(false);
    const [selectedProf, setSelectedProf] = useState(null);
    const [scheduleConfig, setScheduleConfig] = useState({
        lunes: 0, martes: 0, miercoles: 0, jueves: 0, viernes: 0, sabado: 0,
        duracion_consulta: 30, espacio_entre_turnos: 0,
        lunes_inicio: '08:00', lunes_turnos: 10, lunes_inicio_tarde: '', lunes_turnos_tarde: 0,
        martes_inicio: '08:00', martes_turnos: 10, martes_inicio_tarde: '', martes_turnos_tarde: 0,
        miercoles_inicio: '08:00', miercoles_turnos: 10, miercoles_inicio_tarde: '', miercoles_turnos_tarde: 0,
        jueves_inicio: '08:00', jueves_turnos: 10, jueves_inicio_tarde: '', jueves_turnos_tarde: 0,
        viernes_inicio: '08:00', viernes_turnos: 10, viernes_inicio_tarde: '', viernes_turnos_tarde: 0,
        sabado_inicio: '08:00', sabado_turnos: 10, sabado_inicio_tarde: '', sabado_turnos_tarde: 0,
        observaciones_agenda: ''
    });
    const [savingSchedule, setSavingSchedule] = useState(false);

    const handleOpenScheduleModal = async (u) => {
        setSelectedProf(u);
        try {
            const response = await axios.get(`${API_URL}/turnos/config-horarios/${u.id}`);
            const data = response.data;
            // Clean up nulls to empty strings for inputs
            const cleanData = { ...data };
            ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'].forEach(d => {
                if (!cleanData[`${d}_inicio_tarde`]) cleanData[`${d}_inicio_tarde`] = '';
            });
            setScheduleConfig(cleanData);
            setShowScheduleModal(true);
        } catch (err) {
            console.error('Error fetching schedule config:', err);
            setScheduleConfig({
                lunes: u.lunes || 0, martes: u.martes || 0, miercoles: u.miercoles || 0,
                jueves: u.jueves || 0, viernes: u.viernes || 0, sabado: u.sabado || 0,
                duracion_consulta: u.duracion_consulta || 30, espacio_entre_turnos: u.espacio_entre_turnos || 0,
                lunes_inicio: '08:00', lunes_turnos: 10, lunes_inicio_tarde: '', lunes_turnos_tarde: 0,
                martes_inicio: '08:00', martes_turnos: 10, martes_inicio_tarde: '', martes_turnos_tarde: 0,
                miercoles_inicio: '08:00', miercoles_turnos: 10, miercoles_inicio_tarde: '', miercoles_turnos_tarde: 0,
                jueves_inicio: '08:00', jueves_turnos: 10, jueves_inicio_tarde: '', jueves_turnos_tarde: 0,
                viernes_inicio: '08:00', viernes_turnos: 10, viernes_inicio_tarde: '', viernes_turnos_tarde: 0,
                sabado_inicio: '08:00', sabado_turnos: 10, sabado_inicio_tarde: '', sabado_turnos_tarde: 0,
                observaciones_agenda: u.observaciones_agenda || ''
            });
            setShowScheduleModal(true);
        }
    };

    const handleSaveScheduleConfig = async (e) => {
        e.preventDefault();
        setSavingSchedule(true);
        try {
            await axios.post(`${API_URL}/turnos/config-horarios`, {
                profesional_id: selectedProf.id,
                ...scheduleConfig
            });
            alert('Horarios de atención actualizados con éxito');
            setShowScheduleModal(false);
            fetchUsers();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al guardar horarios');
        } finally {
            setSavingSchedule(false);
        }
    };

    const fetchPrestadores = async () => {
        try {
            const token = localStorage.getItem('sulb_token');
            const response = await axios.get(`${API_URL}/prestadores`, {
                headers: { Authorization: `Bearer ${token}` }
            });
            setPrestadores(response.data);
        } catch (e) {
            console.error('Error fetching prestadores:', e);
        }
    };

    useEffect(() => {
        const userStr = localStorage.getItem('sulb_user');
        if (userStr) {
            try { 
                const parsed = JSON.parse(userStr);
                setCurrentUser(parsed); 
                if (parsed.rol === 'superadmin') {
                    fetchPrestadores();
                }
            } catch(e){}
        }
        fetchUsers();
        fetchProfessionalTypes();
    }, []);

    const fetchUsers = async () => {
        try {
            const response = await axios.get(`${API_URL}/auth/users`);
            setUsers(response.data);
        } catch (err) {
            console.error('Error fetching users:', err);
        }
    };

    const fetchProfessionalTypes = async () => {
        try {
            const response = await axios.get(`${API_URL}/auth/tipos-profesional`);
            setProfessionalTypes(response.data);
        } catch (e) {
            console.error('Error professional types:', e);
        }
    };

    const handleCreateUser = async (e) => {
        e.preventDefault();
        setLoading(true);
        setMessage({ type: '', text: '' });

        try {
            const response = await axios.post(`${API_URL}/auth/users`, { 
                nombre, 
                apellido,
                password, 
                rol: selectedRoles[0],
                roles: selectedRoles,
                tipo_profesional_id: selectedRoles.some(r => ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(r)) && tipoProfesionalId ? parseInt(tipoProfesionalId) : null,
                matricula: selectedRoles.some(r => ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(r)) ? matricula : null,
                prestador_id: currentUser?.rol === 'superadmin' && prestadorId ? parseInt(prestadorId) : null,
                mail,
                celular,
                direccion
            });
            setMessage({ type: 'success', text: `Usuario creado con éxito. Nombre de usuario generado: ${response.data.nombre_usuario}` });
            setNombre('');
            setApellido('');
            setPassword('');
            setRol('profesional');
            setSelectedRoles(['profesional']);
            setTipoProfesionalId('');
            setMatricula('');
            setPrestadorId('');
            setMail('');
            setCelular('');
            setDireccion('');
            fetchUsers();
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al crear usuario' });
        } finally {
            setLoading(false);
        }
    };

    const handleDeleteUser = async (id) => {
        if (!window.confirm('¿Está seguro de eliminar este usuario?')) return;

        try {
            await axios.delete(`${API_URL}/auth/users/${id}`);
            fetchUsers();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al eliminar usuario');
        }
    };

    const handleStartEdit = (u) => {
        setEditingUserId(u.id);
        setEditRol(u.rol);
        setEditRoles(u.roles ? u.roles.split(',') : [u.rol]);
        setEditPassword('');
        setEditTipoProfesionalId(u.tipo_profesional_id || '');
        setEditMatricula(u.matricula || '');
        setEditPrestadorId(u.prestador_id || '');
        setEditNombre(u.nombre || '');
        setEditApellido(u.apellido || '');
        setEditMail(u.mail || '');
        setEditCelular(u.celular || '');
        setEditDireccion(u.direccion || '');
    };

    const handleSaveEdit = async (id) => {
        setLoading(true);
        try {
            await axios.put(`${API_URL}/auth/users/${id}`, {
                password: editPassword || undefined,
                rol: editRoles[0] || editRol,
                roles: editRoles,
                tipo_profesional_id: editRoles.some(r => ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(r)) && editTipoProfesionalId ? parseInt(editTipoProfesionalId) : null,
                matricula: editRoles.some(r => ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(r)) ? editMatricula : null,
                prestador_id: currentUser?.rol === 'superadmin' && editPrestadorId ? parseInt(editPrestadorId) : null,
                nombre: editNombre,
                apellido: editApellido,
                mail: editMail,
                celular: editCelular,
                direccion: editDireccion
            });
            setEditingUserId(null);
            fetchUsers();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al actualizar usuario');
        } finally {
            setLoading(false);
        }
    };

    const handleImpersonate = async (u) => {
        try {
            const token = localStorage.getItem('sulb_token');
            const response = await axios.post(`${API_URL}/auth/impersonate`, 
                { userId: u.id },
                { headers: { Authorization: `Bearer ${token}` } }
            );
            
            const newTabUrl = `${window.location.origin}${window.location.pathname}?impersonate_token=${response.data.token}`;
            window.open(newTabUrl, '_blank');
        } catch (err) {
            alert(err.response?.data?.error || 'Error al suplantar identidad');
        }
    };

    const isAdmin = currentUser?.rol === 'admin' || currentUser?.rol === 'recepcion' || currentUser?.rol === 'superadmin';

    if (!isAdmin) {
        return <div className="body-content"><h1>Acceso denegado</h1></div>;
    }

    const filteredUsers = users.filter(u => {
        if (filterSearch) {
            const term = filterSearch.toLowerCase();
            const usernameMatch = u.nombre_usuario?.toLowerCase().includes(term);
            const nameMatch = u.nombre?.toLowerCase().includes(term);
            const lastNameMatch = u.apellido?.toLowerCase().includes(term);
            const mailMatch = u.mail?.toLowerCase().includes(term);
            const matriculaMatch = u.matricula?.toLowerCase().includes(term);
            if (!usernameMatch && !nameMatch && !lastNameMatch && !mailMatch && !matriculaMatch) {
                return false;
            }
        }
        if (filterRole) {
            const userRoles = u.roles ? u.roles.split(',') : [u.rol];
            if (!userRoles.includes(filterRole)) {
                return false;
            }
        }
        if (filterPrestador) {
            if (String(u.prestador_id) !== String(filterPrestador)) {
                return false;
            }
        }
        return true;
    });

    return (
        <div className="body-content" style={{ overflowY: 'auto', maxHeight: 'calc(100vh - 100px)' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem' }}>
                <div>
                    <h1 style={{ margin: 0 }}>Gestión de Usuarios</h1>
                    <p style={{ color: 'var(--text-dim)', margin: 0 }}>Administración de cuentas, roles y matrículas profesionales</p>
                </div>
                <button 
                    onClick={handleOpenCreateModal} 
                    className="btn btn-primary"
                    style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', height: 'fit-content' }}
                >
                    <UserPlus size={18} />
                    Nuevo Usuario
                </button>
            </div>
            
            {/* CREATE USER MODAL */}
            {showCreateModal && (
                <div style={{ 
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, 
                    background: 'rgba(0,0,0,0.6)', display: 'flex', justifyContent: 'center', alignItems: 'center', 
                    zIndex: 1000, backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '95%', maxWidth: '800px', maxHeight: '90vh', overflowY: 'auto', marginBottom: 0 }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.5rem' }}>
                            <h2 style={{ margin: 0 }}>Agregar Nuevo Usuario</h2>
                            <button 
                                onClick={() => setShowCreateModal(false)}
                                style={{ background: 'none', border: 'none', color: 'var(--text-dim)', cursor: 'pointer', display: 'flex', alignItems: 'center', justifyContent: 'center' }}
                            >
                                <X size={24} />
                            </button>
                        </div>
                        
                        <form onSubmit={handleCreateUser} className="login-form" style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))', gap: '1rem' }}>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Nombre</label>
                                <input 
                                    type="text" 
                                    className="input-field"
                                    value={nombre} 
                                    onChange={(e) => setNombre(e.target.value)} 
                                    placeholder="Nombre"
                                    required 
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Apellido</label>
                                <input 
                                    type="text" 
                                    className="input-field"
                                    value={apellido} 
                                    onChange={(e) => setApellido(e.target.value)} 
                                    placeholder="Apellido"
                                    required 
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Contraseña</label>
                                <input 
                                    type="password" 
                                    className="input-field"
                                    value={password} 
                                    onChange={(e) => setPassword(e.target.value)} 
                                    placeholder="Contraseña"
                                    required 
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                            <label>Email (Mail)</label>
                                <input 
                                    type="email" 
                                    className="input-field"
                                    value={mail} 
                                    onChange={(e) => setMail(e.target.value)} 
                                    placeholder="mail@ejemplo.com"
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Celular</label>
                                <input 
                                    type="text" 
                                    className="input-field"
                                    value={celular} 
                                    onChange={(e) => setCelular(e.target.value)} 
                                    placeholder="Celular"
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Dirección</label>
                                <input 
                                    type="text" 
                                    className="input-field"
                                    value={direccion} 
                                    onChange={(e) => setDireccion(e.target.value)} 
                                    placeholder="Dirección"
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0, gridColumn: '1 / -1' }}>
                                <label style={{ display: 'block', marginBottom: '0.5rem' }}>Roles Asignados</label>
                                <div style={{ display: 'flex', flexWrap: 'wrap', gap: '1rem', background: 'rgba(255,255,255,0.03)', padding: '0.75rem', borderRadius: '6px', border: '1px solid var(--border)' }}>
                                    {[
                                        { id: 'veterinario', name: 'Veterinario' },
                                        { id: 'peluquero', name: 'Peluquero' },
                                        { id: 'traslado', name: 'Traslado' },
                                        { id: 'cobrador', name: 'Cobrador' },
                                        { id: 'recepcion', name: 'Recepción' },
                                        { id: 'admin', name: 'Administrador' },
                                        { id: 'profesional', name: 'Profesional (Legacy)' },
                                        ...(currentUser?.rol === 'superadmin' ? [{ id: 'superadmin', name: 'Super Administrador' }] : [])
                                    ].map(r => (
                                        <label key={r.id} style={{ display: 'flex', alignItems: 'center', gap: '0.4rem', cursor: 'pointer', fontSize: '0.9rem', color: '#fff', userSelect: 'none' }}>
                                            <input 
                                                type="checkbox" 
                                                checked={selectedRoles.includes(r.id)}
                                                onChange={() => {
                                                    if (selectedRoles.includes(r.id)) {
                                                        if (selectedRoles.length > 1) {
                                                            setSelectedRoles(selectedRoles.filter(x => x !== r.id));
                                                        }
                                                    } else {
                                                        setSelectedRoles([...selectedRoles, r.id]);
                                                    }
                                                }}
                                                style={{ width: 'auto', margin: 0, cursor: 'pointer' }}
                                            />
                                            {r.name}
                                        </label>
                                    ))}
                                </div>
                            </div>
        
                            {currentUser?.rol === 'superadmin' && (
                                <div className="form-group" style={{ marginBottom: 0 }}>
                                    <label>Consultorio / Institución</label>
                                    <select 
                                        className="input-field"
                                        value={prestadorId}
                                        onChange={(e) => setPrestadorId(e.target.value)}
                                        required
                                    >
                                        <option value="">Seleccionar consultorio...</option>
                                        {prestadores.map(p => (
                                            <option key={p.id} value={p.id}>{p.nombre}</option>
                                        ))}
                                    </select>
                                </div>
                            )}
        
                            {/* DYNAMIC PROFESSIONAL FIELDS */}
                            {selectedRoles.some(r => ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(r)) && (
                                <>
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label>Especialidad / Tipo de Profesional</label>
                                        <select 
                                            className="input-field"
                                            value={tipoProfesionalId}
                                            onChange={(e) => setTipoProfesionalId(e.target.value)}
                                            required
                                        >
                                            <option value="">Selecciona especialidad...</option>
                                            {professionalTypes.map(t => (
                                                <option key={t.id} value={t.id}>{t.nombre}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label>Matrícula Profesional</label>
                                        <input 
                                            type="text" 
                                            className="input-field"
                                            value={matricula} 
                                            onChange={(e) => setMatricula(e.target.value)} 
                                            placeholder="Ej: MN-54215"
                                            required
                                        />
                                    </div>
                                </>
                            )}
        
                            <div style={{ gridColumn: '1 / -1', display: 'flex', flexDirection: 'column', gap: '1rem', marginTop: '0.5rem' }}>
                                {message.text && (
                                    <div className={message.type === 'success' ? 'success-msg' : 'login-error'} style={{ marginBottom: 0 }}>
                                        {message.text}
                                    </div>
                                )}
        
                                <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '1rem' }}>
                                    <button 
                                        type="button" 
                                        onClick={() => setShowCreateModal(false)} 
                                        className="btn"
                                    >
                                        {message.type === 'success' ? 'Cerrar' : 'Cancelar'}
                                    </button>
                                    {message.type !== 'success' && (
                                        <button type="submit" className="btn btn-primary" disabled={loading} style={{ width: 'auto', padding: '0.6rem 2rem' }}>
                                            <UserPlus size={18} style={{ marginRight: '0.5rem' }} />
                                            Crear Usuario
                                        </button>
                                    )}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            <div className="users-list-card">
                <h2>Usuarios Registrados</h2>
                
                {/* FILTROS DE BÚSQUEDA */}
                <div style={{
                    display: 'grid',
                    gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))',
                    gap: '1rem',
                    marginBottom: '1.5rem',
                    background: 'rgba(255, 255, 255, 0.03)',
                    padding: '1rem',
                    borderRadius: '8px',
                    border: '1px solid var(--border)'
                }}>
                    <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                        <label style={{ fontSize: '0.8rem', color: 'var(--text-dim)', fontWeight: '500' }}>Buscar por nombre / usuario</label>
                        <input
                            type="text"
                            className="input-field"
                            placeholder="Ej: fernando, MP-12345..."
                            value={filterSearch}
                            onChange={(e) => setFilterSearch(e.target.value)}
                            style={{ margin: 0, padding: '0.4rem 0.8rem', minHeight: 'auto' }}
                        />
                    </div>
                    
                    <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                        <label style={{ fontSize: '0.8rem', color: 'var(--text-dim)', fontWeight: '500' }}>Filtrar por Rol</label>
                        <select
                            className="input-field"
                            value={filterRole}
                            onChange={(e) => setFilterRole(e.target.value)}
                            style={{ margin: 0, padding: '0.4rem', minHeight: 'auto' }}
                        >
                            <option value="">Todos los roles</option>
                            <option value="usuario">Usuario</option>
                            <option value="veterinario">Veterinario</option>
                            <option value="peluquero">Peluquero</option>
                            <option value="traslado">Traslado</option>
                            <option value="cobrador">Cobrador</option>
                            <option value="recepcion">Recepcion</option>
                            <option value="admin">Admin</option>
                            <option value="profesional">Profesional (Legacy)</option>
                            {currentUser?.rol === 'superadmin' && <option value="superadmin">SuperAdmin</option>}
                        </select>
                    </div>

                    {currentUser?.rol === 'superadmin' && (
                        <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                            <label style={{ fontSize: '0.8rem', color: 'var(--text-dim)', fontWeight: '500' }}>Filtrar por Institución</label>
                            <select
                                className="input-field"
                                value={filterPrestador}
                                onChange={(e) => setFilterPrestador(e.target.value)}
                                style={{ margin: 0, padding: '0.4rem', minHeight: 'auto' }}
                            >
                                <option value="">Todas las instituciones</option>
                                {prestadores.map(p => (
                                    <option key={p.id} value={p.id}>{p.nombre}</option>
                                ))}
                            </select>
                        </div>
                    )}
                </div>

                <div style={{ overflowX: 'auto' }}>
                    <table className="user-table">
                        <thead>
                            <tr>
                                <th>Usuario / Nombre Completo</th>
                                <th>Rol</th>
                                <th>Contacto</th>
                                {currentUser?.rol === 'superadmin' && <th>Consultorio / Institución</th>}
                                <th>Especialidad / Matrícula</th>
                                <th style={{ textAlign: 'center' }}>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {filteredUsers.length === 0 ? (
                                <tr>
                                    <td colSpan={currentUser?.rol === 'superadmin' ? 6 : 5} style={{ textAlign: 'center', padding: '2rem', color: 'var(--text-dim)' }}>
                                        No se encontraron usuarios con los filtros aplicados.
                                    </td>
                                </tr>
                            ) : (
                                filteredUsers.map(u => (
                                <tr key={u.id}>
                                    <td>
                                        {editingUserId === u.id ? (
                                            <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                                                <input 
                                                    type="text" 
                                                    placeholder="Nombre" 
                                                    className="input-field" 
                                                    value={editNombre} 
                                                    onChange={(e) => setEditNombre(e.target.value)} 
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                    required
                                                />
                                                <input 
                                                    type="text" 
                                                    placeholder="Apellido" 
                                                    className="input-field" 
                                                    value={editApellido} 
                                                    onChange={(e) => setEditApellido(e.target.value)} 
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                    required
                                                />
                                            </div>
                                        ) : (
                                            <div style={{ display: 'flex', flexDirection: 'column' }}>
                                                <span style={{ fontWeight: 600, color: '#fff' }}>
                                                    {u.apellido && u.nombre ? `${u.apellido}, ${u.nombre}` : u.nombre_usuario}
                                                </span>
                                                {u.nombre_usuario && (
                                                    <span style={{ fontSize: '0.75rem', color: 'var(--text-dim)' }}>
                                                        @{u.nombre_usuario}
                                                    </span>
                                                )}
                                            </div>
                                        )}
                                    </td>
                                    <td>
                                        {editingUserId === u.id ? (
                                            <div style={{ display: 'flex', flexDirection: 'column', gap: '0.3rem', background: 'rgba(0,0,0,0.15)', padding: '0.4rem', borderRadius: '4px', border: '1px solid var(--border)' }}>
                                                {[
                                                    { id: 'veterinario', name: 'Veterinario' },
                                                    { id: 'peluquero', name: 'Peluquero' },
                                                    { id: 'traslado', name: 'Traslado' },
                                                    { id: 'cobrador', name: 'Cobrador' },
                                                    { id: 'recepcion', name: 'Recepc' },
                                                    { id: 'admin', name: 'Admin' },
                                                    { id: 'profesional', name: 'Profesional (Legacy)' },
                                                    ...(currentUser?.rol === 'superadmin' ? [{ id: 'superadmin', name: 'SuperAdmin' }] : [])
                                                ].map(r => (
                                                    <label key={r.id} style={{ display: 'flex', alignItems: 'center', gap: '0.2rem', fontSize: '0.75rem', cursor: 'pointer', color: '#fff', margin: 0 }}>
                                                        <input 
                                                            type="checkbox" 
                                                            checked={editRoles.includes(r.id)} 
                                                            onChange={() => {
                                                                if (editRoles.includes(r.id)) {
                                                                    if (editRoles.length > 1) {
                                                                        setEditRoles(editRoles.filter(x => x !== r.id));
                                                                    }
                                                                } else {
                                                                    setEditRoles([...editRoles, r.id]);
                                                                }
                                                            }}
                                                            style={{ width: 'auto', margin: 0, cursor: 'pointer' }}
                                                        />
                                                        {r.name}
                                                    </label>
                                                ))}
                                            </div>
                                        ) : (
                                            <div style={{ display: 'flex', flexWrap: 'wrap', gap: '0.2rem', maxWidth: '140px' }}>
                                                {u.roles ? [...new Set(u.roles.split(','))].map(r => (
                                                    <span key={r} className={`role-badge ${r}`} style={{ display: 'inline-block' }}>
                                                        {r}
                                                    </span>
                                                )) : (
                                                    <span className={`role-badge ${u.rol}`} style={{ display: 'inline-block' }}>
                                                        {u.rol}
                                                    </span>
                                                )}
                                            </div>
                                        )}
                                        {editingUserId === u.id && (
                                            <div style={{ marginTop: '0.5rem' }}>
                                                <input 
                                                    type="password" 
                                                    placeholder="Nueva contraseña (opcional)" 
                                                    className="input-field"
                                                    value={editPassword}
                                                    onChange={(e) => setEditPassword(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                />
                                            </div>
                                        )}
                                    </td>
                                    
                                    <td>
                                        {editingUserId === u.id ? (
                                            <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                                                <input 
                                                    type="email" 
                                                    placeholder="Email" 
                                                    className="input-field" 
                                                    value={editMail} 
                                                    onChange={(e) => setEditMail(e.target.value)} 
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                />
                                                <input 
                                                    type="text" 
                                                    placeholder="Celular" 
                                                    className="input-field" 
                                                    value={editCelular} 
                                                    onChange={(e) => setEditCelular(e.target.value)} 
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                />
                                                <input 
                                                    type="text" 
                                                    placeholder="Dirección" 
                                                    className="input-field" 
                                                    value={editDireccion} 
                                                    onChange={(e) => setEditDireccion(e.target.value)} 
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                />
                                            </div>
                                        ) : (
                                            <div style={{ fontSize: '0.8rem', display: 'flex', flexDirection: 'column', gap: '0.2rem' }}>
                                                {u.mail && (
                                                    <span style={{ color: 'var(--text)' }} title={u.mail}>
                                                        ✉ {u.mail}
                                                    </span>
                                                )}
                                                {u.celular && (
                                                    <span style={{ color: 'var(--text-dim)' }}>
                                                        📞 {u.celular}
                                                    </span>
                                                )}
                                                {u.direccion && (
                                                    <span style={{ color: 'var(--text-dim)', fontStyle: 'italic' }}>
                                                        📍 {u.direccion}
                                                    </span>
                                                )}
                                                {!u.mail && !u.celular && !u.direccion && (
                                                    <span style={{ color: 'var(--text-dim)' }}>-</span>
                                                )}
                                            </div>
                                        )}
                                    </td>
                                    
                                    {currentUser?.rol === 'superadmin' && (
                                        <td>
                                            {editingUserId === u.id ? (
                                                <select 
                                                    className="input-field"
                                                    value={editPrestadorId}
                                                    onChange={(e) => setEditPrestadorId(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto' }}
                                                >
                                                    <option value="">Seleccionar consultorio...</option>
                                                    {prestadores.map(p => (
                                                        <option key={p.id} value={p.id}>{p.nombre}</option>
                                                    ))}
                                                </select>
                                            ) : (
                                                <span style={{ fontSize: '0.85rem', color: 'var(--text-dim)' }}>
                                                    {u.prestador_nombre || 'Sin vincular'}
                                                </span>
                                            )}
                                        </td>
                                    )}
                                    <td>
                                        {editingUserId === u.id ? (
                                            editRoles.some(r => ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(r)) ? (
                                                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                                                    <select 
                                                        className="input-field"
                                                        value={editTipoProfesionalId}
                                                        onChange={(e) => setEditTipoProfesionalId(e.target.value)}
                                                        style={{ padding: '0.2rem', minHeight: 'auto' }}
                                                    >
                                                        <option value="">Selecciona especialidad...</option>
                                                        {professionalTypes.map(t => (
                                                            <option key={t.id} value={t.id}>{t.nombre}</option>
                                                        ))}
                                                    </select>
                                                    <input 
                                                        type="text"
                                                        placeholder="Matrícula"
                                                        className="input-field"
                                                        value={editMatricula}
                                                        onChange={(e) => setEditMatricula(e.target.value)}
                                                        style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                    />
                                                </div>
                                            ) : (
                                                <span style={{ color: 'var(--text-dim)' }}>No aplica</span>
                                            )
                                        ) : (
                                            (u.roles ? u.roles.split(',').some(r => ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(r)) : ['profesional', 'veterinario', 'peluquero', 'traslado', 'cobrador'].includes(u.rol)) ? (
                                                <div>
                                                    <span className="role-badge municipalidad" style={{ textTransform: 'none', marginRight: '0.5rem' }}>
                                                        {u.tipo_profesional_nombre || 'Sin especialidad'}
                                                    </span>
                                                    <span style={{ fontSize: '0.85rem', color: 'var(--text-dim)' }}>
                                                        M.P.: <strong>{u.matricula || 'N/A'}</strong>
                                                    </span>
                                                </div>
                                            ) : (
                                                <span style={{ color: 'var(--text-dim)', fontSize: '0.85rem' }}>-</span>
                                            )
                                        )}
                                    </td>
                                    <td>
                                        {editingUserId === u.id ? (
                                            <div style={{ display: 'flex', gap: '0.5rem', justifyContent: 'center' }}>
                                                <button onClick={() => handleSaveEdit(u.id)} className="btn btn-primary" style={{ padding: '0.3rem 0.6rem', fontSize: '0.8rem', background: '#10b981', borderColor: '#10b981' }} disabled={loading}>Guardar</button>
                                                <button onClick={() => setEditingUserId(null)} className="btn" style={{ padding: '0.3rem 0.6rem', fontSize: '0.8rem' }}>Cancelar</button>
                                            </div>
                                        ) : (
                                            <div style={{ display: 'flex', gap: '0.5rem', justifyContent: 'center', alignItems: 'center' }}>
                                                {(u.roles ? u.roles.split(',').some(r => ['profesional', 'veterinario', 'peluquero', 'traslado'].includes(r)) : ['profesional', 'veterinario', 'peluquero', 'traslado'].includes(u.rol)) && (
                                                    <button 
                                                        onClick={() => handleOpenScheduleModal(u)}
                                                        className="btn"
                                                        style={{ padding: '0.3rem 0.6rem', fontSize: '0.8rem', background: 'rgba(234, 179, 8, 0.1)', color: '#fef08a', border: '1px solid rgba(234, 179, 8, 0.2)' }}
                                                        title="Configurar Agenda de Turnos"
                                                    >
                                                        Horarios
                                                    </button>
                                                )}
                                                {u.nombre_usuario !== 'Ricardo' && (
                                                    <>
                                                        <button 
                                                            onClick={() => handleStartEdit(u)}
                                                            className="btn btn-primary"
                                                            style={{ padding: '0.3rem 0.6rem', fontSize: '0.8rem', background: '#3b82f6', borderColor: '#3b82f6' }}
                                                        >
                                                            Editar
                                                        </button>
                                                        <button 
                                                            onClick={() => handleDeleteUser(u.id)}
                                                            className="delete-btn"
                                                            style={{ padding: '0.3rem 0.6rem', fontSize: '0.8rem' }}
                                                        >
                                                            Eliminar
                                                        </button>
                                                    </>
                                                )}
                                                {currentUser?.rol === 'superadmin' && u.id !== currentUser.id && (
                                                    <button 
                                                        onClick={() => handleImpersonate(u)}
                                                        className="btn"
                                                        style={{ padding: '0.3rem 0.6rem', fontSize: '0.8rem', background: 'rgba(16, 185, 129, 0.15)', color: '#10b981', border: '1px solid rgba(16, 185, 129, 0.3)' }}
                                                        title="Acceder como este usuario en una nueva pestaña (Impersonate)"
                                                    >
                                                        Impersonate 👤
                                                    </button>
                                                )}
                                            </div>
                                        )}
                                    </td>
                                </tr>
                            )))}
                        </tbody>
                    </table>
                </div>
            </div>

            {/* SCHEDULE CONFIGURATION MODAL */}
            {showScheduleModal && selectedProf && (
                <div style={{ 
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, 
                    background: 'rgba(0,0,0,0.6)', display: 'flex', justifyContent: 'center', alignItems: 'center', 
                    zIndex: 1000, backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '95%', maxWidth: '600px', maxHeight: '90vh', overflowY: 'auto' }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.5rem' }}>
                            <h2 style={{ margin: 0 }}>Configuración de Turnos</h2>
                            <span style={{ fontSize: '0.9rem', color: 'var(--primary)', fontWeight: 'bold' }}>
                                Prof: {selectedProf.nombre_usuario}
                            </span>
                        </div>
                        
                        <p style={{ fontSize: '0.85rem', color: 'var(--text-dim)', marginBottom: '1.5rem' }}>
                            Marque los días que atiende el profesional y complete los horarios, duración y espaciado de turnos correspondientes.
                        </p>

                        <form onSubmit={handleSaveScheduleConfig} className="login-form">
                            {/* DAY-SPECIFIC SCHEDULING LIST */}
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem', marginBottom: '1.5rem' }}>
                                {[
                                    { key: 'lunes', label: 'Lunes' },
                                    { key: 'martes', label: 'Martes' },
                                    { key: 'miercoles', label: 'Miércoles' },
                                    { key: 'jueves', label: 'Jueves' },
                                    { key: 'viernes', label: 'Viernes' },
                                    { key: 'sabado', label: 'Sábado' }
                                ].map(day => (
                                    <div key={day.key} style={{ 
                                        background: 'rgba(255,255,255,0.02)', 
                                        border: `1px solid ${scheduleConfig[day.key] ? 'rgba(234, 179, 8, 0.4)' : 'var(--border)'}`, 
                                        borderRadius: '10px', 
                                        padding: '1rem',
                                        transition: 'all 0.2s ease'
                                    }}>
                                        <label style={{ 
                                            display: 'flex', 
                                            alignItems: 'center', 
                                            gap: '10px', 
                                            cursor: 'pointer',
                                            fontSize: '1.05rem',
                                            fontWeight: scheduleConfig[day.key] ? 'bold' : 'normal',
                                            color: scheduleConfig[day.key] ? '#fef08a' : 'var(--text-dim)'
                                        }}>
                                            <input 
                                                type="checkbox"
                                                checked={scheduleConfig[day.key] === 1}
                                                onChange={(e) => setScheduleConfig({
                                                    ...scheduleConfig,
                                                    [day.key]: e.target.checked ? 1 : 0
                                                })}
                                                style={{ cursor: 'pointer', transform: 'scale(1.2)' }}
                                            />
                                            {day.label}
                                        </label>

                                        {scheduleConfig[day.key] === 1 && (
                                            <div style={{ marginTop: '1rem', paddingLeft: '2rem', display: 'flex', flexDirection: 'column', gap: '1rem' }}>
                                                
                                                {/* Morning Block */}
                                                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                                        <label style={{ fontSize: '0.8rem', color: '#9ca3af' }}>Inicio (Mañana)</label>
                                                        <input 
                                                            type="time"
                                                            className="input-field"
                                                            value={scheduleConfig[`${day.key}_inicio`]}
                                                            onChange={(e) => setScheduleConfig({
                                                                ...scheduleConfig,
                                                                [`${day.key}_inicio`]: e.target.value
                                                            })}
                                                            style={{ padding: '0.4rem', minHeight: 'auto' }}
                                                            required
                                                        />
                                                    </div>
                                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                                        <label style={{ fontSize: '0.8rem', color: '#9ca3af' }}>Cant. Turnos (Mañana)</label>
                                                        <input 
                                                            type="number" min="1" max="50"
                                                            className="input-field"
                                                            value={scheduleConfig[`${day.key}_turnos`]}
                                                            onChange={(e) => setScheduleConfig({
                                                                ...scheduleConfig,
                                                                [`${day.key}_turnos`]: parseInt(e.target.value) || 1
                                                            })}
                                                            style={{ padding: '0.4rem', minHeight: 'auto' }}
                                                            required
                                                        />
                                                    </div>
                                                </div>

                                                {/* Afternoon Block */}
                                                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                                        <label style={{ fontSize: '0.8rem', color: '#9ca3af' }}>Inicio (Tarde - Opcional)</label>
                                                        <input 
                                                            type="time"
                                                            className="input-field"
                                                            value={scheduleConfig[`${day.key}_inicio_tarde`] || ''}
                                                            onChange={(e) => setScheduleConfig({
                                                                ...scheduleConfig,
                                                                [`${day.key}_inicio_tarde`]: e.target.value || ''
                                                            })}
                                                            style={{ padding: '0.4rem', minHeight: 'auto' }}
                                                        />
                                                    </div>
                                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                                        <label style={{ fontSize: '0.8rem', color: '#9ca3af' }}>Cant. Turnos (Tarde)</label>
                                                        <input 
                                                            type="number" min="0" max="50"
                                                            className="input-field"
                                                            value={scheduleConfig[`${day.key}_turnos_tarde`] || 0}
                                                            onChange={(e) => setScheduleConfig({
                                                                ...scheduleConfig,
                                                                [`${day.key}_turnos_tarde`]: parseInt(e.target.value) || 0
                                                            })}
                                                            style={{ padding: '0.4rem', minHeight: 'auto' }}
                                                        />
                                                    </div>
                                                </div>

                                            </div>
                                        )}
                                    </div>
                                ))}
                            </div>

                            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                                <div className="form-group">
                                    <label>Duración de la Consulta (minutos)</label>
                                    <select 
                                        className="input-field"
                                        value={scheduleConfig.duracion_consulta}
                                        onChange={(e) => setScheduleConfig({
                                            ...scheduleConfig,
                                            duracion_consulta: parseInt(e.target.value)
                                        })}
                                    >
                                        <option value="15">15 min</option>
                                        <option value="20">20 min</option>
                                        <option value="30">30 min</option>
                                        <option value="40">40 min</option>
                                        <option value="45">45 min</option>
                                        <option value="60">60 min</option>
                                    </select>
                                </div>
                                <div className="form-group">
                                    <label>Espacio entre Turnos (minutos)</label>
                                    <input 
                                        type="number"
                                        min="0"
                                        max="120"
                                        className="input-field"
                                        value={scheduleConfig.espacio_entre_turnos}
                                        onChange={(e) => setScheduleConfig({
                                            ...scheduleConfig,
                                            espacio_entre_turnos: parseInt(e.target.value) || 0
                                        })}
                                        required
                                    />
                                </div>
                            </div>

                            <div className="form-group">
                                <label>Observaciones Generales</label>
                                <textarea 
                                    className="input-field"
                                    rows="2"
                                    value={scheduleConfig.observaciones_agenda || ''}
                                    onChange={(e) => setScheduleConfig({
                                        ...scheduleConfig,
                                        observaciones_agenda: e.target.value
                                    })}
                                    placeholder="Comentarios adicionales sobre el esquema de turnos..."
                                    style={{ resize: 'none', padding: '0.5rem' }}
                                />
                            </div>

                            <div style={{ display: 'flex', gap: '1rem', justifyContent: 'flex-end', marginTop: '1.5rem' }}>
                                <button type="button" onClick={() => setShowScheduleModal(false)} className="btn">
                                    Cancelar
                                </button>
                                <button 
                                    type="submit" 
                                    className="btn btn-primary" 
                                    disabled={savingSchedule}
                                    style={{ width: 'auto', padding: '0.6rem 2.5rem', background: '#eab308', borderColor: '#eab308', color: '#000', fontWeight: 'bold' }}
                                >
                                    {savingSchedule ? 'Guardando...' : 'Guardar Horarios'}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
};

export default UserManagement;
