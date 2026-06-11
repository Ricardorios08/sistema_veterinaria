import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { 
  Clock, 
  User, 
  Clipboard, 
  Activity, 
  CheckCircle, 
  ExternalLink, 
  Trash2, 
  UserCheck, 
  Sparkles, 
  Smile,
  ShieldAlert,
  Search
} from 'lucide-react';

const WaitingList = ({ user, onSelectPatient, refreshTrigger }) => {
  // Waiting List view logic
  const [appointments, setAppointments] = useState([]);
  const [doctors, setDoctors] = useState([]);
  const [selectedDoctorId, setSelectedDoctorId] = useState('');
  const [loading, setLoading] = useState(false);
  const [todayDate, setTodayDate] = useState('');
  const [activeSubTab, setActiveSubTab] = useState('waiting'); // 'waiting', 'attended'
  const [selectedCardModal, setSelectedCardModal] = useState(null);
  const [isMobile, setIsMobile] = useState(window.innerWidth <= 768);

  const isAdmin = user?.rol === 'admin' || user?.rol === 'superadmin' || user?.rol === 'recepcion';

  useEffect(() => {
    const handleResize = () => setIsMobile(window.innerWidth <= 768);
    window.addEventListener('resize', handleResize);
    return () => window.removeEventListener('resize', handleResize);
  }, []);
  const isProfesional = user?.rol === 'profesional';

  useEffect(() => {
    // Get local date YYYY-MM-DD
    const now = new Date();
    const tzoffset = now.getTimezoneOffset() * 60000; //offset in milliseconds
    const localISOTime = (new Date(now - tzoffset)).toISOString().slice(0, 10);
    setTodayDate(localISOTime);

    fetchInitialData();
  }, []);

  useEffect(() => {
    if (todayDate) {
      fetchTodayAppointments();
    }
  }, [todayDate, selectedDoctorId, refreshTrigger]);

  const fetchInitialData = async () => {
    try {
      // If admin, fetch doctors list
      if (isAdmin) {
        const docRes = await axios.get(`${API_URL}/auth/users`);
        const profs = docRes.data.filter(u => u.rol === 'profesional');
        setDoctors(profs);
      } else if (isProfesional) {
        // If professional, lock to their ID
        setSelectedDoctorId(String(user.id));
      }
    } catch (e) {
      console.error('Error fetching doctors:', e);
    }
  };

  const fetchTodayAppointments = async () => {
    setLoading(true);
    try {
      const params = { fecha_inicio: todayDate };
      if (selectedDoctorId) {
        params.odontologo_id = selectedDoctorId;
      }
      const res = await axios.get(`${API_URL}/turnos`, { params });
      setAppointments(res.data);
    } catch (err) {
      console.error('Error loading today appointments:', err);
    } finally {
      setLoading(false);
    }
  };

  // Mark patient as treating and open clinical history directly
  const handleAttendPatient = async (appointment) => {
    try {
      // We don't update state to 'atendido' here anymore. It stays 'confirmado'
      // until the doctor actually writes in the clinical history.
      
      // 2. Redirect to history clinical records tab and automatically open modal, passing the turno id
      if (onSelectPatient) {
        onSelectPatient(appointment.paciente_id, 'historia', true, appointment.id);
      }
    } catch (err) {
      alert('Error al iniciar atención del paciente');
    }
  };

  // Remove patient from waiting list (mark back to pendiente or cancel)
  const handleRemoveFromWaiting = async (appointmentId) => {
    if (!window.confirm('¿Desea quitar a este paciente de la lista de espera y devolverlo a estado pendiente?')) return;
    try {
      await axios.put(`${API_URL}/turnos/${appointmentId}`, { 
        estado: 'pendiente',
        hora_llegada: null
      });
      fetchTodayAppointments();
    } catch (err) {
      alert(err.response?.data?.error || 'Error al quitar paciente de la lista de espera');
    }
  };

  // Undo attend patient
  const handleUndoAttend = async (appointmentId) => {
    if (!window.confirm('¿Desea anular la asistencia y devolver al paciente a la lista de espera?')) return;
    try {
      await axios.put(`${API_URL}/turnos/${appointmentId}`, { estado: 'confirmado' });
      fetchTodayAppointments();
    } catch (err) {
      alert(err.response?.data?.error || 'Error al anular asistencia');
    }
  };

  // Filter lists based on status
  const waitingPatients = appointments.filter(app => app.estado === 'confirmado');
  const attendedPatients = appointments.filter(app => app.estado === 'atendido');

  return (
    <div className="body-content" style={{ overflowY: 'auto', maxHeight: 'calc(100vh - 100px)' }}>
      {/* HEADER SECTION */}
      <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem', flexWrap: 'wrap', gap: '1rem' }}>
        <div>
          <h1 style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
            <Clock size={28} color="var(--primary)" />
            Lista de Espera Activa
          </h1>
          <div style={{ color: 'var(--text-dim)', display: 'flex', alignItems: 'center', gap: '0.8rem', flexWrap: 'wrap' }}>
            <span>Pacientes confirmados en recepción para el día:</span>
            <input 
              type="date" 
              className="input-field" 
              style={{ width: 'auto', padding: '0.3rem 0.8rem', minHeight: 'auto', margin: 0, background: 'var(--card-bg)' }}
              value={todayDate} 
              max={new Date().toISOString().slice(0, 10)}
              onChange={(e) => setTodayDate(e.target.value)} 
            />
          </div>
        </div>

        {/* DOCTOR FILTER (Admins only) */}
        {isAdmin && (
          <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
            <label style={{ fontSize: '0.9rem', color: 'var(--text-dim)', fontWeight: 'bold' }}>Profesional:</label>
            <select 
              className="input-field" 
              value={selectedDoctorId} 
              onChange={(e) => setSelectedDoctorId(e.target.value)}
              style={{ marginBottom: 0, padding: '0.4rem 1.5rem', minHeight: 'auto', width: 'auto', fontSize: '0.9rem' }}
            >
              <option value="">Todos los profesionales</option>
              {doctors.map(d => (
                <option key={d.id} value={d.id}>{d.nombre_usuario.toUpperCase()}</option>
              ))}
            </select>
          </div>
        )}
      </div>

      {/* STATS OVERVIEW CARDS */}
      <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: '1rem', marginBottom: '2rem' }}>
        <div className="user-form-card" style={{ padding: '1rem 1.5rem', margin: 0, borderLeft: '4px solid var(--primary)', background: 'rgba(59, 130, 246, 0.03)' }}>
          <span style={{ fontSize: '0.75rem', color: 'var(--text-dim)', textTransform: 'uppercase', fontWeight: 'bold' }}>En Sala de Espera</span>
          <h2 style={{ fontSize: '2rem', margin: '5px 0 0 0', color: '#fff', display: 'flex', alignItems: 'center', gap: '10px' }}>
            {waitingPatients.length}
            <span style={{ fontSize: '0.85rem', fontWeight: 'normal', color: 'var(--text-dim)' }}>paciente(s)</span>
          </h2>
        </div>
        <div className="user-form-card" style={{ padding: '1rem 1.5rem', margin: 0, borderLeft: '4px solid #10b981', background: 'rgba(16, 185, 129, 0.03)' }}>
          <span style={{ fontSize: '0.75rem', color: 'var(--text-dim)', textTransform: 'uppercase', fontWeight: 'bold' }}>Atendidos Hoy</span>
          <h2 style={{ fontSize: '2rem', margin: '5px 0 0 0', color: '#10b981', display: 'flex', alignItems: 'center', gap: '10px' }}>
            {attendedPatients.length}
            <span style={{ fontSize: '0.85rem', fontWeight: 'normal', color: 'var(--text-dim)' }}>paciente(s)</span>
          </h2>
        </div>
      </div>

      {/* SUB-TABS SELECTOR */}
      <div style={{ display: 'flex', gap: '1rem', borderBottom: '1px solid var(--border)', marginBottom: '1.5rem' }}>
        <button 
          className={`tab-btn ${activeSubTab === 'waiting' ? 'active' : ''}`}
          onClick={() => setActiveSubTab('waiting')}
          style={{
            padding: '0.75rem 1.5rem',
            background: 'transparent',
            border: 'none',
            borderBottom: activeSubTab === 'waiting' ? '2px solid var(--primary)' : '2px solid transparent',
            color: activeSubTab === 'waiting' ? '#fff' : 'var(--text-dim)',
            cursor: 'pointer',
            fontWeight: activeSubTab === 'waiting' ? 600 : 400,
            display: 'flex',
            alignItems: 'center',
            gap: '6px'
          }}
        >
          <Clock size={16} />
          En Espera ({waitingPatients.length})
        </button>
        <button 
          className={`tab-btn ${activeSubTab === 'attended' ? 'active' : ''}`}
          onClick={() => setActiveSubTab('attended')}
          style={{
            padding: '0.75rem 1.5rem',
            background: 'transparent',
            border: 'none',
            borderBottom: activeSubTab === 'attended' ? '2px solid var(--primary)' : '2px solid transparent',
            color: activeSubTab === 'attended' ? '#fff' : 'var(--text-dim)',
            cursor: 'pointer',
            fontWeight: activeSubTab === 'attended' ? 600 : 400,
            display: 'flex',
            alignItems: 'center',
            gap: '6px'
          }}
        >
          <CheckCircle size={16} />
          Atendidos Hoy ({attendedPatients.length})
        </button>
      </div>

      {/* TIMELINE TABLE / GRID */}
      <div className="users-list-card">
        {loading ? (
          <div style={{ textAlign: 'center', padding: '4rem', color: 'var(--text-dim)' }}>
            <Clock className="spinner" size={32} style={{ margin: '0 auto 0.5rem auto', animation: 'spin 1.5s linear infinite' }} />
            <span>Cargando lista de espera...</span>
          </div>
        ) : activeSubTab === 'waiting' ? (
          // WAITING TABLE
          waitingPatients.length === 0 ? (
            <div style={{ textAlign: 'center', padding: '5rem 2rem', background: 'rgba(0,0,0,0.1)', borderRadius: '8px' }}>
              <Smile size={42} style={{ margin: '0 auto 1rem auto', color: 'var(--text-dim)', opacity: 0.5 }} />
              <h3 style={{ margin: 0, color: 'var(--text-dim)', fontSize: '1.1rem' }}>No hay pacientes esperando</h3>
              <p style={{ fontSize: '0.85rem', color: 'rgba(255,255,255,0.3)', marginTop: '4px' }}>
                Cuando la recepcionista confirme la llegada de un paciente desde el panel de Turnos, aparecerá aquí inmediatamente.
              </p>
            </div>
          ) : isMobile ? (
            <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
              {waitingPatients.map(app => {
                const time = new Date(app.fecha_hora).toLocaleTimeString('es-AR', { hour: '2-digit', minute: '2-digit' });
                return (
                  <div key={app.id} className="user-form-card" style={{ padding: '1rem', display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                    <div>
                      <span style={{ fontWeight: 'bold', color: '#fff', fontSize: '1.1rem', display: 'flex', alignItems: 'center', gap: '6px' }}><Clock size={16} color="var(--primary)"/> {time} hs</span>
                      <div style={{ fontWeight: 600, color: 'var(--primary)', fontSize: '0.95rem', marginTop: '4px' }}>
                        {app.paciente_apellido.toUpperCase()}, {app.paciente_nombre}
                      </div>
                    </div>
                    <button 
                      onClick={() => setSelectedCardModal({ ...app, isWaiting: true, time })}
                      className="btn btn-secondary"
                      style={{ padding: '0.6rem', width: 'auto', minHeight: 'auto', borderRadius: '50%' }}
                    >
                      <Search size={18} />
                    </button>
                  </div>
                );
              })}
            </div>
          ) : (
            <div style={{ overflowX: 'auto' }}>
              <table className="user-table">
                <thead>
                  <tr>
                    <th>Horario Turno</th>
                    <th>Llegada (Check-in)</th>
                    <th>Paciente</th>
                    {isAdmin && <th>Profesional Asignado</th>}
                    <th>Motivo de Consulta</th>
                    <th style={{ textAlign: 'center' }}>Acciones Clínicas</th>
                  </tr>
                </thead>
                <tbody>
                  {waitingPatients.map(app => {
                    // Extract HH:MM from fecha_hora
                    const time = new Date(app.fecha_hora).toLocaleTimeString('es-AR', { hour: '2-digit', minute: '2-digit' });
                    return (
                      <tr key={app.id} style={{ background: 'rgba(59, 130, 246, 0.01)' }}>
                        <td>
                          <span style={{ fontWeight: 'bold', color: '#fff', fontSize: '0.95rem' }}>{time} hs</span>
                        </td>
                        <td>
                          <span className="role-badge admin" style={{ display: 'inline-flex', alignItems: 'center', gap: '4px', textTransform: 'none', background: 'rgba(59,130,246,0.1)', color: '#93c5fd', border: '1px solid rgba(59,130,246,0.2)' }}>
                            <Clock size={12} />
                            {app.hora_llegada || 'Registrado'}
                          </span>
                        </td>
                        <td>
                          <div>
                            <span style={{ fontWeight: 600, color: 'var(--primary)', fontSize: '0.95rem' }}>
                              {app.paciente_apellido.toUpperCase()}, {app.paciente_nombre}
                            </span>
                            <div style={{ fontSize: '0.75rem', color: 'var(--text-dim)', marginTop: '2px' }}>
                              DNI: {app.paciente_dni}
                            </div>
                          </div>
                        </td>
                        {isAdmin && (
                          <td>
                            <span style={{ fontWeight: 500, fontSize: '0.85rem' }}>
                              {app.odontologo_nombre.toUpperCase()}
                            </span>
                          </td>
                        )}
                        <td>
                          <span style={{ fontSize: '0.85rem', color: '#cbd5e1' }}>
                            {app.motivo || 'Consulta General'}
                          </span>
                        </td>
                        <td>
                          <div style={{ display: 'flex', gap: '0.4rem', justifyContent: 'center', flexWrap: 'wrap' }}>
                            {isProfesional && (
                              <>
                                <button 
                                  onClick={() => handleAttendPatient(app)}
                                  className="btn btn-primary"
                                  style={{ 
                                    padding: '0.4rem 0.8rem', 
                                    fontSize: '0.8rem', 
                                    display: 'inline-flex', 
                                    alignItems: 'center', 
                                    gap: '4px',
                                    background: '#10b981',
                                    borderColor: '#10b981',
                                    width: 'auto'
                                  }}
                                  title="Atender al paciente"
                                >
                                  <UserCheck size={14} />
                                  Atender
                                </button>
                                <button 
                                  onClick={() => onSelectPatient(app.paciente_id, 'info')}
                                  className="btn btn-secondary"
                                  style={{ 
                                    padding: '0.4rem 0.8rem', 
                                    fontSize: '0.8rem', 
                                    display: 'inline-flex', 
                                    alignItems: 'center', 
                                    gap: '4px',
                                    width: 'auto'
                                  }}
                                >
                                  <ExternalLink size={14} />
                                  Ficha
                                </button>
                                <button 
                                  onClick={() => onSelectPatient(app.paciente_id, 'odontograma')}
                                  className="btn btn-secondary"
                                  style={{ 
                                    padding: '0.4rem 0.8rem', 
                                    fontSize: '0.8rem', 
                                    display: 'inline-flex', 
                                    alignItems: 'center', 
                                    gap: '4px',
                                    width: 'auto'
                                  }}
                                >
                                  <Activity size={14} />
                                  Odontograma
                                </button>
                              </>
                            )}
                            {isAdmin && (
                              <button 
                                onClick={() => handleRemoveFromWaiting(app.id)}
                                className="delete-btn"
                                style={{ padding: '0.4rem', width: 'auto', minHeight: 'auto' }}
                                title="Quitar de lista de espera (Desconfirmar)"
                              >
                                <Trash2 size={14} />
                              </button>
                            )}
                          </div>
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>
          )
        ) : (
          // ATTENDED TODAY TABLE
          attendedPatients.length === 0 ? (
            <div style={{ textAlign: 'center', padding: '4rem 2rem', color: 'var(--text-dim)' }}>
              <Smile size={32} style={{ margin: '0 auto 0.8rem auto', opacity: 0.3 }} />
              <p style={{ margin: 0, fontSize: '0.9rem' }}>Aún no se registran pacientes atendidos hoy.</p>
            </div>
          ) : isMobile ? (
            <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
              {attendedPatients.map(app => {
                const time = new Date(app.fecha_hora).toLocaleTimeString('es-AR', { hour: '2-digit', minute: '2-digit' });
                return (
                  <div key={app.id} className="user-form-card" style={{ padding: '1rem', display: 'flex', justifyContent: 'space-between', alignItems: 'center', opacity: 0.75 }}>
                    <div>
                      <span style={{ fontWeight: 'bold', color: '#fff', fontSize: '1.1rem', display: 'flex', alignItems: 'center', gap: '6px' }}><Clock size={16}/> {time} hs</span>
                      <div style={{ fontWeight: 600, color: 'var(--text-dim)', fontSize: '0.95rem', marginTop: '4px' }}>
                        {app.paciente_apellido.toUpperCase()}, {app.paciente_nombre}
                      </div>
                    </div>
                    <button 
                      onClick={() => setSelectedCardModal({ ...app, isWaiting: false, time })}
                      className="btn btn-secondary"
                      style={{ padding: '0.6rem', width: 'auto', minHeight: 'auto', borderRadius: '50%' }}
                    >
                      <Search size={18} />
                    </button>
                  </div>
                );
              })}
            </div>
          ) : (
            <div style={{ overflowX: 'auto' }}>
              <table className="user-table">
                <thead>
                  <tr>
                    <th>Horario Turno</th>
                    <th>Llegada</th>
                    <th>Paciente</th>
                    {isAdmin && <th>Profesional</th>}
                    <th>Motivo de Consulta</th>
                    <th style={{ textAlign: 'center' }}>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  {attendedPatients.map(app => {
                    const time = new Date(app.fecha_hora).toLocaleTimeString('es-AR', { hour: '2-digit', minute: '2-digit' });
                    return (
                      <tr key={app.id} style={{ opacity: 0.75 }}>
                        <td>{time} hs</td>
                        <td>{app.hora_llegada || '-'}</td>
                        <td>
                          <span style={{ fontWeight: 600, color: 'var(--text-dim)' }}>
                            {app.paciente_apellido.toUpperCase()}, {app.paciente_nombre}
                          </span>
                        </td>
                        {isAdmin && <td>{app.odontologo_nombre.toUpperCase()}</td>}
                        <td>{app.motivo || 'Consulta General'}</td>
                        <td style={{ textAlign: 'center' }}>
                          <div style={{ display: 'flex', gap: '0.4rem', justifyContent: 'center' }}>
                            {isProfesional && (
                              <button 
                                onClick={() => onSelectPatient(app.paciente_id, 'historia')}
                                className="btn btn-secondary"
                                style={{ 
                                  padding: '0.3rem 0.8rem', 
                                  fontSize: '0.75rem', 
                                  display: 'inline-flex', 
                                  alignItems: 'center', 
                                  gap: '4px',
                                  width: 'auto'
                                }}
                              >
                                <Clipboard size={12} />
                                Ver Historia Clinica
                              </button>
                            )}
                            {isAdmin && (
                              <button 
                                onClick={() => handleUndoAttend(app.id)}
                                className="btn"
                                style={{ 
                                  padding: '0.3rem 0.8rem', 
                                  fontSize: '0.75rem', 
                                  display: 'inline-flex', 
                                  alignItems: 'center', 
                                  gap: '4px',
                                  width: 'auto',
                                  background: 'rgba(239, 68, 68, 0.1)',
                                  color: '#ef4444',
                                  border: '1px solid rgba(239, 68, 68, 0.3)'
                                }}
                                title="Anular atención y volver a lista de espera"
                              >
                                <Trash2 size={12} />
                                Anular Asistencia
                              </button>
                            )}
                          </div>
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>
          )
        )}
      </div>

      {/* MOBILE CARD DETAILS MODAL */}
      {selectedCardModal && (
        <div style={{ position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, background: 'rgba(0,0,0,0.6)', display: 'flex', justifyContent: 'center', alignItems: 'center', zIndex: 1000, backdropFilter: 'blur(4px)', padding: '1rem' }} onClick={() => setSelectedCardModal(null)}>
          <div className="user-form-card" style={{ width: '100%', maxWidth: '400px', margin: 0, padding: '1.5rem', background: 'var(--bg)', borderRadius: '12px' }} onClick={e => e.stopPropagation()}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem', borderBottom: '1px solid var(--border)', paddingBottom: '0.8rem' }}>
              <h3 style={{ margin: 0, color: 'var(--primary)', display: 'flex', alignItems: 'center', gap: '6px' }}>
                <User size={18} /> Detalles del Turno
              </h3>
              <button className="close-btn" onClick={() => setSelectedCardModal(null)}>×</button>
            </div>
            
            <div style={{ display: 'flex', flexDirection: 'column', gap: '1rem', marginBottom: '1.5rem' }}>
              <div>
                <span style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>Paciente</span>
                <div style={{ fontWeight: 600, fontSize: '1.1rem' }}>{selectedCardModal.paciente_apellido.toUpperCase()}, {selectedCardModal.paciente_nombre}</div>
                <div style={{ fontSize: '0.85rem', color: 'var(--text-dim)' }}>DNI: {selectedCardModal.paciente_dni}</div>
              </div>
              
              <div style={{ display: 'flex', gap: '2rem' }}>
                <div>
                  <span style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>Horario</span>
                  <div style={{ fontWeight: 600 }}>{selectedCardModal.time} hs</div>
                </div>
                <div>
                  <span style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>Llegada</span>
                  <div style={{ fontWeight: 600, color: '#93c5fd' }}>{selectedCardModal.hora_llegada || (selectedCardModal.isWaiting ? 'Registrado' : '-')}</div>
                </div>
              </div>

              {isAdmin && (
                <div>
                  <span style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>Profesional Asignado</span>
                  <div style={{ fontWeight: 600 }}>{selectedCardModal.odontologo_nombre.toUpperCase()}</div>
                </div>
              )}

              <div>
                <span style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>Motivo de Consulta</span>
                <div style={{ fontWeight: 600, color: '#cbd5e1' }}>{selectedCardModal.motivo || 'Consulta General'}</div>
              </div>
            </div>

            <div style={{ borderTop: '1px solid var(--border)', paddingTop: '1rem', display: 'flex', flexWrap: 'wrap', gap: '0.5rem', justifyContent: 'center' }}>
              {selectedCardModal.isWaiting ? (
                <>
                  {isProfesional && (
                    <>
                      <button onClick={() => { setSelectedCardModal(null); handleAttendPatient(selectedCardModal); }} className="btn btn-primary" style={{ padding: '0.5rem', fontSize: '0.85rem', flex: '1 1 auto', background: '#10b981', borderColor: '#10b981' }}>
                        <UserCheck size={16} style={{ marginRight: '4px' }}/> Atender
                      </button>
                      <button onClick={() => { setSelectedCardModal(null); onSelectPatient(selectedCardModal.paciente_id, 'info'); }} className="btn btn-secondary" style={{ padding: '0.5rem', fontSize: '0.85rem', flex: '1 1 auto' }}>
                        <ExternalLink size={16} style={{ marginRight: '4px' }}/> Ficha
                      </button>
                      <button onClick={() => { setSelectedCardModal(null); onSelectPatient(selectedCardModal.paciente_id, 'odontograma'); }} className="btn btn-secondary" style={{ padding: '0.5rem', fontSize: '0.85rem', flex: '1 1 auto' }}>
                        <Activity size={16} style={{ marginRight: '4px' }}/> Odonto.
                      </button>
                    </>
                  )}
                  {isAdmin && (
                    <button onClick={() => { setSelectedCardModal(null); handleRemoveFromWaiting(selectedCardModal.id); }} className="delete-btn" style={{ padding: '0.5rem', fontSize: '0.85rem', flex: '1 1 auto' }}>
                      <Trash2 size={16} style={{ marginRight: '4px' }}/> Quitar
                    </button>
                  )}
                </>
              ) : (
                <>
                  {isProfesional && (
                    <button onClick={() => { setSelectedCardModal(null); onSelectPatient(selectedCardModal.paciente_id, 'historia'); }} className="btn btn-secondary" style={{ padding: '0.5rem', fontSize: '0.85rem', flex: '1 1 auto' }}>
                      <Clipboard size={16} style={{ marginRight: '4px' }}/> Historia Clínica
                    </button>
                  )}
                  {isAdmin && (
                    <button onClick={() => { setSelectedCardModal(null); handleUndoAttend(selectedCardModal.id); }} className="btn" style={{ padding: '0.5rem', fontSize: '0.85rem', flex: '1 1 auto', background: 'rgba(239, 68, 68, 0.1)', color: '#ef4444', border: '1px solid rgba(239, 68, 68, 0.3)' }}>
                      <Trash2 size={16} style={{ marginRight: '4px' }}/> Anular Asistencia
                    </button>
                  )}
                </>
              )}
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default WaitingList;
