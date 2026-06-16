import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';
import { API_URL } from '../config';

const Socios = ({ currentUser, onAddMascota }) => {
    const [socios, setSocios] = useState([]);
    const [total, setTotal] = useState(0);
    const [page, setPage] = useState(1);
    const [search, setSearch] = useState('');
    const [loading, setLoading] = useState(false);

    // Panel de detalle
    const [selectedSocio, setSelectedSocio] = useState(null);
    const [detalle, setDetalle] = useState(null);
    const [loadingDetalle, setLoadingDetalle] = useState(false);

    // Formulario crear/editar
    const [showForm, setShowForm] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [form, setForm] = useState({
        apellido: '', nombre: '', tipo_doc: 'D.N.I', documento: '',
        telefono: '', celular: '', domicilio: '', localidad: '',
        departamento: '', cod_postal: '', mail: '', sexo: '',
        fecha_ingreso: '', importe_cuota: '', observaciones: ''
    });
    const [message, setMessage] = useState({ type: '', text: '' });

    const LIMIT = 50;

    const fetchSocios = useCallback(async (p = 1, q = search) => {
        setLoading(true);
        try {
            const res = await axios.get(`${API_URL}/socios`, {
                params: { search: q, page: p, limit: LIMIT }
            });
            setSocios(res.data.data);
            setTotal(res.data.total);
            setPage(p);
        } catch (err) {
            console.error(err);
        } finally {
            setLoading(false);
        }
    }, []);

    useEffect(() => { fetchSocios(1, ''); }, []);

    const handleSearch = (e) => {
        e.preventDefault();
        fetchSocios(1, search);
    };

    const fetchDetalle = async (socio) => {
        setSelectedSocio(socio);
        setDetalle(null);
        setLoadingDetalle(true);
        try {
            const res = await axios.get(`${API_URL}/socios/${socio.id}`);
            setDetalle(res.data);
        } catch (err) {
            console.error(err);
        } finally {
            setLoadingDetalle(false);
        }
    };

    const openCreate = () => {
        setEditingId(null);
        setForm({ apellido: '', nombre: '', tipo_doc: 'D.N.I', documento: '',
                  telefono: '', celular: '', domicilio: '', localidad: '',
                  departamento: '', cod_postal: '', mail: '', sexo: '',
                  fecha_ingreso: '', importe_cuota: '', observaciones: '' });
        setMessage({ type: '', text: '' });
        setShowForm(true);
    };

    const openEdit = (s) => {
        setEditingId(s.id);
        setForm({
            apellido: s.apellido || '', nombre: s.nombre || '',
            tipo_doc: s.tipo_doc || 'D.N.I', documento: s.documento || '',
            telefono: s.telefono || '', celular: s.celular || '',
            domicilio: s.domicilio || '', localidad: s.localidad || '',
            departamento: s.departamento || '', cod_postal: s.cod_postal || '',
            mail: s.mail || '', sexo: s.sexo || '',
            fecha_ingreso: s.fecha_ingreso ? s.fecha_ingreso.split('T')[0] : '',
            importe_cuota: s.importe_cuota || '', observaciones: s.observaciones || ''
        });
        setMessage({ type: '', text: '' });
        setShowForm(true);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setMessage({ type: '', text: '' });
        try {
            if (editingId) {
                await axios.put(`${API_URL}/socios/${editingId}`, form);
                setMessage({ type: 'success', text: 'Socio actualizado correctamente' });
            } else {
                await axios.post(`${API_URL}/socios`, form);
                setMessage({ type: 'success', text: 'Socio creado correctamente' });
            }
            fetchSocios(page, search);
            setTimeout(() => { setShowForm(false); setMessage({ type: '', text: '' }); }, 1500);
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al guardar' });
        }
    };

    const handleDelete = async (id) => {
        if (!confirm('¿Dar de baja este socio?')) return;
        try {
            await axios.delete(`${API_URL}/socios/${id}`);
            if (selectedSocio?.id === id) setSelectedSocio(null);
            fetchSocios(page, search);
        } catch (err) {
            alert(err.response?.data?.error || 'Error al eliminar');
        }
    };

    const totalPages = Math.ceil(total / LIMIT);
    const isAdmin = ['admin', 'superadmin', 'recepcion'].includes(currentUser?.rol);

    return (
        <div className="view-container">
            {/* Header */}
            <div className="view-header">
                <div>
                    <h1 className="view-title">🐾 Socios</h1>
                    <p className="view-subtitle">{total.toLocaleString()} socios registrados</p>
                </div>
                {isAdmin && (
                    <button className="btn-primary" onClick={openCreate}>+ Nuevo Socio</button>
                )}
            </div>

            {/* Buscador */}
            <form onSubmit={handleSearch} style={{ display: 'flex', gap: '0.75rem', marginBottom: '1.5rem' }}>
                <input
                    className="form-input"
                    style={{ flex: 1 }}
                    placeholder="Buscar por apellido, nombre, DNI, teléfono..."
                    value={search}
                    onChange={e => setSearch(e.target.value)}
                />
                <button type="submit" className="btn-primary">Buscar</button>
                {search && (
                    <button type="button" className="btn-secondary" onClick={() => { setSearch(''); fetchSocios(1, ''); }}>
                        Limpiar
                    </button>
                )}
            </form>

            <div style={{ display: 'grid', gridTemplateColumns: selectedSocio ? '1fr 380px' : '1fr', gap: '1.5rem' }}>
                {/* Tabla */}
                <div className="card" style={{ padding: 0, overflow: 'hidden' }}>
                    {loading ? (
                        <div style={{ padding: '3rem', textAlign: 'center', color: 'var(--text-dim)' }}>Cargando...</div>
                    ) : (
                        <>
                            <table className="data-table">
                                <thead>
                                    <tr>
                                        <th>Apellido y Nombre</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Localidad</th>
                                        <th style={{ textAlign: 'center' }}>Mascotas</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {socios.length === 0 ? (
                                        <tr><td colSpan={6} style={{ textAlign: 'center', padding: '2rem', color: 'var(--text-dim)' }}>
                                            No hay socios para mostrar
                                        </td></tr>
                                    ) : socios.map(s => (
                                        <tr
                                            key={s.id}
                                            className={selectedSocio?.id === s.id ? 'selected-row' : ''}
                                            style={{ cursor: 'pointer' }}
                                            onClick={() => fetchDetalle(s)}
                                        >
                                            <td><strong>{s.apellido}, {s.nombre}</strong></td>
                                            <td>{s.documento || '—'}</td>
                                            <td>{s.celular || s.telefono || '—'}</td>
                                            <td>{s.departamento || s.localidad || '—'}</td>
                                            <td style={{ textAlign: 'center' }}>
                                                <span className="badge">{s.cant_mascotas}</span>
                                            </td>
                                            <td onClick={e => e.stopPropagation()}>
                                                {isAdmin && (
                                                    <div style={{ display: 'flex', gap: '0.4rem' }}>
                                                        <button className="btn-icon" title="Editar" onClick={() => openEdit(s)}>✏️</button>
                                                        <button className="btn-icon btn-danger" title="Dar de baja" onClick={() => handleDelete(s.id)}>🗑️</button>
                                                    </div>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>

                            {/* Paginación */}
                            {totalPages > 1 && (
                                <div style={{ display: 'flex', justifyContent: 'center', gap: '0.5rem', padding: '1rem', borderTop: '1px solid var(--border)' }}>
                                    <button className="btn-secondary" disabled={page <= 1} onClick={() => fetchSocios(page - 1, search)}>← Anterior</button>
                                    <span style={{ padding: '0.5rem 1rem', color: 'var(--text-dim)' }}>
                                        Pág. {page} de {totalPages}
                                    </span>
                                    <button className="btn-secondary" disabled={page >= totalPages} onClick={() => fetchSocios(page + 1, search)}>Siguiente →</button>
                                </div>
                            )}
                        </>
                    )}
                </div>

                {/* Panel de detalle */}
                {selectedSocio && (
                    <div className="card" style={{ position: 'sticky', top: '1rem', alignSelf: 'flex-start' }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
                            <h3 style={{ margin: 0 }}>{selectedSocio.apellido}, {selectedSocio.nombre}</h3>
                            <button className="btn-icon" onClick={() => setSelectedSocio(null)}>✕</button>
                        </div>

                        {loadingDetalle ? (
                            <div style={{ color: 'var(--text-dim)', textAlign: 'center', padding: '2rem' }}>Cargando...</div>
                        ) : detalle && (
                            <>
                                <div style={{ display: 'grid', gap: '0.5rem', fontSize: '0.875rem', marginBottom: '1.5rem' }}>
                                    {detalle.documento && <div><span style={{ color: 'var(--text-dim)' }}>DNI:</span> {detalle.tipo_doc} {detalle.documento}</div>}
                                    {(detalle.celular || detalle.telefono) && <div><span style={{ color: 'var(--text-dim)' }}>Tel:</span> {detalle.celular || detalle.telefono}</div>}
                                    {detalle.mail && <div><span style={{ color: 'var(--text-dim)' }}>Mail:</span> {detalle.mail}</div>}
                                    {detalle.domicilio && <div><span style={{ color: 'var(--text-dim)' }}>Domicilio:</span> {detalle.domicilio}</div>}
                                    {detalle.departamento && <div><span style={{ color: 'var(--text-dim)' }}>Localidad:</span> {detalle.departamento}</div>}
                                    {detalle.importe_cuota > 0 && <div><span style={{ color: 'var(--text-dim)' }}>Cuota:</span> ${parseFloat(detalle.importe_cuota).toLocaleString()}</div>}
                                    {detalle.fecha_ingreso && <div><span style={{ color: 'var(--text-dim)' }}>Ingreso:</span> {new Date(detalle.fecha_ingreso).toLocaleDateString('es-AR')}</div>}
                                </div>

                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.75rem' }}>
                                    <h4 style={{ margin: 0, color: 'var(--accent)' }}>
                                        🐶 Mascotas ({detalle.mascotas?.length || 0})
                                    </h4>
                                    <button className="btn-secondary" style={{ fontSize: '0.75rem', padding: '0.3rem 0.7rem' }}
                                        onClick={() => {
                                            if (onAddMascota) onAddMascota('socio', selectedSocio.id, `${selectedSocio.apellido}, ${selectedSocio.nombre}`);
                                        }}>
                                        + Agregar
                                    </button>
                                </div>
                                {detalle.mascotas?.length === 0 ? (
                                    <p style={{ color: 'var(--text-dim)', fontSize: '0.875rem' }}>Sin mascotas registradas</p>
                                ) : (
                                    <div style={{ display: 'flex', flexDirection: 'column', gap: '0.5rem' }}>
                                        {detalle.mascotas.map(m => (
                                            <div key={m.id} className="card" style={{ padding: '0.75rem', background: 'var(--surface-alt)' }}>
                                                <div style={{ fontWeight: 600 }}>{m.nombre}</div>
                                                <div style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>
                                                    {[m.especie, m.raza, m.sexo].filter(Boolean).join(' · ')}
                                                </div>
                                                {m.fecha_nac && (
                                                    <div style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>
                                                        Nac: {new Date(m.fecha_nac).toLocaleDateString('es-AR')}
                                                    </div>
                                                )}
                                            </div>
                                        ))}
                                    </div>
                                )}
                            </>
                        )}
                    </div>
                )}
            </div>

            {/* Modal Formulario */}
            {showForm && (
                <div className="modal-overlay" onClick={() => setShowForm(false)}>
                    <div className="modal-content" style={{ maxWidth: '700px' }} onClick={e => e.stopPropagation()}>
                        <div className="modal-header">
                            <h2>{editingId ? 'Editar Socio' : 'Nuevo Socio'}</h2>
                            <button className="btn-icon" onClick={() => setShowForm(false)}>✕</button>
                        </div>

                        <form onSubmit={handleSubmit} className="login-form" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                            <div className="form-group">
                                <label>Apellido *</label>
                                <input className="form-input" required value={form.apellido}
                                    onChange={e => setForm(f => ({ ...f, apellido: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Nombre *</label>
                                <input className="form-input" required value={form.nombre}
                                    onChange={e => setForm(f => ({ ...f, nombre: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Tipo Doc.</label>
                                <select className="form-input" value={form.tipo_doc}
                                    onChange={e => setForm(f => ({ ...f, tipo_doc: e.target.value }))}>
                                    <option value="D.N.I">D.N.I</option>
                                    <option value="PASAPORTE">Pasaporte</option>
                                    <option value="OTRO">Otro</option>
                                </select>
                            </div>
                            <div className="form-group">
                                <label>Documento</label>
                                <input className="form-input" value={form.documento}
                                    onChange={e => setForm(f => ({ ...f, documento: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Teléfono</label>
                                <input className="form-input" value={form.telefono}
                                    onChange={e => setForm(f => ({ ...f, telefono: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Celular</label>
                                <input className="form-input" value={form.celular}
                                    onChange={e => setForm(f => ({ ...f, celular: e.target.value }))} />
                            </div>
                            <div className="form-group" style={{ gridColumn: 'span 2' }}>
                                <label>Domicilio</label>
                                <input className="form-input" value={form.domicilio}
                                    onChange={e => setForm(f => ({ ...f, domicilio: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Localidad</label>
                                <input className="form-input" value={form.localidad}
                                    onChange={e => setForm(f => ({ ...f, localidad: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Departamento</label>
                                <input className="form-input" value={form.departamento}
                                    onChange={e => setForm(f => ({ ...f, departamento: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Mail</label>
                                <input className="form-input" type="email" value={form.mail}
                                    onChange={e => setForm(f => ({ ...f, mail: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Sexo</label>
                                <select className="form-input" value={form.sexo}
                                    onChange={e => setForm(f => ({ ...f, sexo: e.target.value }))}>
                                    <option value="">Sin especificar</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div className="form-group">
                                <label>Fecha Ingreso</label>
                                <input className="form-input" type="date" value={form.fecha_ingreso}
                                    onChange={e => setForm(f => ({ ...f, fecha_ingreso: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Cuota mensual ($)</label>
                                <input className="form-input" type="number" step="0.01" value={form.importe_cuota}
                                    onChange={e => setForm(f => ({ ...f, importe_cuota: e.target.value }))} />
                            </div>
                            <div className="form-group" style={{ gridColumn: 'span 2' }}>
                                <label>Observaciones</label>
                                <textarea className="form-input" rows={2} value={form.observaciones}
                                    onChange={e => setForm(f => ({ ...f, observaciones: e.target.value }))} />
                            </div>

                            {message.text && (
                                <div className={message.type === 'success' ? 'success-msg' : 'login-error'}
                                    style={{ gridColumn: 'span 2' }}>
                                    {message.text}
                                </div>
                            )}

                            <div style={{ gridColumn: 'span 2', display: 'flex', gap: '1rem', justifyContent: 'flex-end' }}>
                                <button type="button" className="btn-secondary" onClick={() => setShowForm(false)}>Cancelar</button>
                                <button type="submit" className="btn-primary">{editingId ? 'Guardar cambios' : 'Crear socio'}</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Socios;
