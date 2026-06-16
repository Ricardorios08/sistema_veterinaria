import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';
import { API_URL } from '../config';

const ESPECIES_EMOJI = {
    'CANINO': '🐕', 'FELINO': '🐈', 'BOVINO': '🐄', 'EQUINO': '🐴',
    'OVINO': '🐑', 'PORCINO': '🐖', 'AVE': '🐦', 'CONEJO': '🐇',
    'REPTIL': '🦎', 'PEZ': '🐠',
};
const especieEmoji = (e) => ESPECIES_EMOJI[(e || '').toUpperCase()] || '🐾';

const Mascotas = ({ currentUser, initialOwner, clearInitialOwner }) => {
    const [mascotas, setMascotas] = useState([]);
    const [total, setTotal] = useState(0);
    const [page, setPage] = useState(1);
    const [search, setSearch] = useState('');
    const [filtroEspecie, setFiltroEspecie] = useState('');
    const [especies, setEspecies] = useState([]);
    const [loading, setLoading] = useState(false);

    // Panel de detalle
    const [selectedMascota, setSelectedMascota] = useState(null);
    const [detalle, setDetalle] = useState(null);
    const [loadingDetalle, setLoadingDetalle] = useState(false);

    // Historial clínico
    const [showHC, setShowHC] = useState(false);
    const [hcForm, setHcForm] = useState({ descripcion: '', diagnostico: '', tratamiento: '' });
    const [hcMessage, setHcMessage] = useState({ type: '', text: '' });

    // Formulario mascota
    const [showForm, setShowForm] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [ownerType, setOwnerType] = useState('socio'); // 'socio' or 'particular'
    const [owners, setOwners] = useState([]);
    const [ownerSearch, setOwnerSearch] = useState('');
    const [form, setForm] = useState({
        socio_id: '', particular_id: '', origen: 'socio', nombre: '', especie: '', raza: '', pelaje: '',
        tamanio: '', color: '', sexo: '', fecha_nac: '', observaciones: ''
    });
    const [message, setMessage] = useState({ type: '', text: '' });

    const LIMIT = 50;

    useEffect(() => {
        fetchMascotas(1, '', '');
        fetchEspecies();
    }, []);

    useEffect(() => {
        if (initialOwner) {
            setEditingId(null);
            setOwnerType(initialOwner.type);
            setForm(f => ({
                ...f,
                socio_id: initialOwner.type === 'socio' ? initialOwner.id : '',
                particular_id: initialOwner.type === 'particular' ? initialOwner.id : '',
                origen: initialOwner.type,
                nombre: '', especie: '', raza: '', pelaje: '',
                tamanio: '', color: '', sexo: '', fecha_nac: '', observaciones: ''
            }));
            setOwnerSearch(initialOwner.label);
            setOwners([]);
            setMessage({ type: '', text: '' });
            setShowForm(true);
            clearInitialOwner();
        }
    }, [initialOwner]);

    const fetchEspecies = async () => {
        try {
            const res = await axios.get(`${API_URL}/mascotas/especies`);
            setEspecies(res.data);
        } catch (err) { /* ignore */ }
    };

    const fetchMascotas = useCallback(async (p = 1, q = search, esp = filtroEspecie) => {
        setLoading(true);
        try {
            const res = await axios.get(`${API_URL}/mascotas`, {
                params: { search: q, especie: esp, page: p, limit: LIMIT }
            });
            setMascotas(res.data.data);
            setTotal(res.data.total);
            setPage(p);
        } catch (err) {
            console.error(err);
        } finally {
            setLoading(false);
        }
    }, []);

    const fetchDetalle = async (m) => {
        setSelectedMascota(m);
        setDetalle(null);
        setShowHC(false);
        setLoadingDetalle(true);
        try {
            const res = await axios.get(`${API_URL}/mascotas/${m.id}`);
            setDetalle(res.data);
        } catch (err) {
            console.error(err);
        } finally {
            setLoadingDetalle(false);
        }
    };

    const handleSearch = (e) => {
        e.preventDefault();
        fetchMascotas(1, search, filtroEspecie);
    };

    const handleFiltroEspecie = (esp) => {
        setFiltroEspecie(esp);
        fetchMascotas(1, search, esp);
    };

    // ── Formulario mascota ──
    const openCreate = async () => {
        setEditingId(null);
        setOwnerType('socio');
        setForm({ socio_id: '', particular_id: '', origen: 'socio', nombre: '', especie: '', raza: '', pelaje: '',
                  tamanio: '', color: '', sexo: '', fecha_nac: '', observaciones: '' });
        setOwnerSearch('');
        setOwners([]);
        setMessage({ type: '', text: '' });
        setShowForm(true);
    };

    const openEdit = (m) => {
        setEditingId(m.id);
        const currentOwnerType = m.particular_id ? 'particular' : 'socio';
        setOwnerType(currentOwnerType);
        setForm({
            socio_id: m.socio_id || '',
            particular_id: m.particular_id || '',
            origen: m.origen || (m.particular_id ? 'particular' : 'socio'),
            nombre: m.nombre || '',
            especie: m.especie || '',
            raza: m.raza || '',
            pelaje: m.pelaje || '',
            tamanio: m.tamanio || '',
            color: m.color || '',
            sexo: m.sexo || '',
            fecha_nac: m.fecha_nac ? m.fecha_nac.split('T')[0] : '',
            observaciones: m.observaciones || ''
        });
        if (m.particular_id) {
            setOwnerSearch(m.particular_apellido ? `${m.particular_apellido}, ${m.particular_nombre}` : '');
        } else {
            setOwnerSearch(m.socio_apellido ? `${m.socio_apellido}, ${m.socio_nombre}` : '');
        }
        setOwners([]);
        setMessage({ type: '', text: '' });
        setShowForm(true);
    };

    const searchOwners = async (q, type = ownerType) => {
        setOwnerSearch(q);
        if (q.length < 2) { setOwners([]); return; }
        try {
            const endpoint = type === 'particular' ? 'particulares' : 'socios';
            const res = await axios.get(`${API_URL}/${endpoint}`, { params: { search: q, limit: 10 } });
            setOwners(res.data.data);
        } catch (err) { /* ignore */ }
    };

    const handleOwnerTypeChange = (newType) => {
        setOwnerType(newType);
        setOwnerSearch('');
        setOwners([]);
        setForm(f => ({
            ...f,
            socio_id: '',
            particular_id: '',
            origen: newType
        }));
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setMessage({ type: '', text: '' });
        try {
            if (editingId) {
                await axios.put(`${API_URL}/mascotas/${editingId}`, form);
                setMessage({ type: 'success', text: 'Mascota actualizada' });
                if (selectedMascota?.id === editingId) fetchDetalle({ id: editingId });
            } else {
                await axios.post(`${API_URL}/mascotas`, form);
                setMessage({ type: 'success', text: 'Mascota creada correctamente' });
            }
            fetchMascotas(page, search, filtroEspecie);
            setTimeout(() => { setShowForm(false); setMessage({ type: '', text: '' }); }, 1500);
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al guardar' });
        }
    };

    const handleDelete = async (id) => {
        if (!confirm('¿Dar de baja esta mascota?')) return;
        try {
            await axios.delete(`${API_URL}/mascotas/${id}`);
            if (selectedMascota?.id === id) setSelectedMascota(null);
            fetchMascotas(page, search, filtroEspecie);
        } catch (err) {
            alert(err.response?.data?.error || 'Error al eliminar');
        }
    };

    // ── Historia Clínica ──
    const handleAddHC = async (e) => {
        e.preventDefault();
        setHcMessage({ type: '', text: '' });
        try {
            await axios.post(`${API_URL}/mascotas/${selectedMascota.id}/historia`, hcForm);
            setHcMessage({ type: 'success', text: 'Entrada guardada' });
            setHcForm({ descripcion: '', diagnostico: '', tratamiento: '' });
            fetchDetalle(selectedMascota);
        } catch (err) {
            setHcMessage({ type: 'error', text: err.response?.data?.error || 'Error al guardar' });
        }
    };

    const totalPages = Math.ceil(total / LIMIT);
    const isAdmin = ['admin', 'superadmin', 'recepcion'].includes(currentUser?.rol);
    const canEdit = ['admin', 'superadmin', 'recepcion', 'veterinario'].includes(currentUser?.rol);

    return (
        <div className="view-container">
            {/* Header */}
            <div className="view-header">
                <div>
                    <h1 className="view-title">🐾 Mascotas</h1>
                    <p className="view-subtitle">{total.toLocaleString()} mascotas registradas</p>
                </div>
                {canEdit && (
                    <button className="btn-primary" onClick={openCreate}>+ Nueva Mascota</button>
                )}
            </div>

            {/* Filtros */}
            <form onSubmit={handleSearch} style={{ display: 'flex', gap: '0.75rem', marginBottom: '1rem', flexWrap: 'wrap' }}>
                <input
                    className="form-input"
                    style={{ flex: 1, minWidth: '220px' }}
                    placeholder="Buscar por nombre, raza, dueño..."
                    value={search}
                    onChange={e => setSearch(e.target.value)}
                />
                <button type="submit" className="btn-primary">Buscar</button>
                {search && (
                    <button type="button" className="btn-secondary" onClick={() => { setSearch(''); fetchMascotas(1, '', filtroEspecie); }}>
                        Limpiar
                    </button>
                )}
            </form>

            {/* Filtro por especie */}
            <div style={{ display: 'flex', gap: '0.5rem', marginBottom: '1.5rem', flexWrap: 'wrap' }}>
                <button
                    className={filtroEspecie === '' ? 'btn-primary' : 'btn-secondary'}
                    style={{ fontSize: '0.8rem', padding: '0.35rem 0.9rem' }}
                    onClick={() => handleFiltroEspecie('')}
                >
                    Todas
                </button>
                {especies.slice(0, 10).map(esp => (
                    <button
                        key={esp}
                        className={filtroEspecie === esp ? 'btn-primary' : 'btn-secondary'}
                        style={{ fontSize: '0.8rem', padding: '0.35rem 0.9rem' }}
                        onClick={() => handleFiltroEspecie(esp)}
                    >
                        {especieEmoji(esp)} {esp}
                    </button>
                ))}
            </div>

            <div style={{ display: 'grid', gridTemplateColumns: selectedMascota ? '1fr 400px' : '1fr', gap: '1.5rem' }}>
                {/* Tabla */}
                <div className="card" style={{ padding: 0, overflow: 'hidden' }}>
                    {loading ? (
                        <div style={{ padding: '3rem', textAlign: 'center', color: 'var(--text-dim)' }}>Cargando...</div>
                    ) : (
                        <>
                            <table className="data-table">
                                <thead>
                                    <tr>
                                        <th>Mascota</th>
                                        <th>Especie / Raza</th>
                                        <th>Sexo</th>
                                        <th>Dueño</th>
                                        <th>Teléfono</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {mascotas.length === 0 ? (
                                        <tr><td colSpan={6} style={{ textAlign: 'center', padding: '2rem', color: 'var(--text-dim)' }}>
                                            No hay mascotas para mostrar
                                        </td></tr>
                                    ) : mascotas.map(m => (
                                        <tr
                                            key={m.id}
                                            className={selectedMascota?.id === m.id ? 'selected-row' : ''}
                                            style={{ cursor: 'pointer' }}
                                            onClick={() => fetchDetalle(m)}
                                        >
                                            <td>
                                                <span style={{ fontSize: '1.2rem', marginRight: '0.4rem' }}>{especieEmoji(m.especie)}</span>
                                                <strong>{m.nombre}</strong>
                                            </td>
                                            <td>{[m.especie, m.raza].filter(Boolean).join(' / ') || '—'}</td>
                                            <td>{m.sexo || '—'}</td>
                                            <td>
                                                {m.socio_apellido ? (
                                                    <span>{m.socio_apellido}, {m.socio_nombre} <span className="badge">Socio</span></span>
                                                ) : m.particular_apellido ? (
                                                    <span>{m.particular_apellido}, {m.particular_nombre} <span className="badge" style={{ background: 'var(--accent)' }}>Particular</span></span>
                                                ) : (
                                                    <span style={{ color: 'var(--text-dim)' }}>Sin dueño</span>
                                                )}
                                            </td>
                                            <td>{m.socio_celular || m.socio_telefono || m.particular_celular || m.particular_telefono || '—'}</td>
                                            <td onClick={e => e.stopPropagation()}>
                                                {canEdit && (
                                                    <div style={{ display: 'flex', gap: '0.4rem' }}>
                                                        <button className="btn-icon" title="Editar" onClick={() => openEdit(m)}>✏️</button>
                                                        {isAdmin && <button className="btn-icon btn-danger" title="Dar de baja" onClick={() => handleDelete(m.id)}>🗑️</button>}
                                                    </div>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>

                            {totalPages > 1 && (
                                <div style={{ display: 'flex', justifyContent: 'center', gap: '0.5rem', padding: '1rem', borderTop: '1px solid var(--border)' }}>
                                    <button className="btn-secondary" disabled={page <= 1} onClick={() => fetchMascotas(page - 1, search, filtroEspecie)}>← Anterior</button>
                                    <span style={{ padding: '0.5rem 1rem', color: 'var(--text-dim)' }}>Pág. {page} de {totalPages}</span>
                                    <button className="btn-secondary" disabled={page >= totalPages} onClick={() => fetchMascotas(page + 1, search, filtroEspecie)}>Siguiente →</button>
                                </div>
                            )}
                        </>
                    )}
                </div>

                {/* Panel de detalle */}
                {selectedMascota && (
                    <div className="card" style={{ position: 'sticky', top: '1rem', alignSelf: 'flex-start', maxHeight: '85vh', overflowY: 'auto' }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
                            <h3 style={{ margin: 0 }}>
                                {especieEmoji(selectedMascota.especie)} {selectedMascota.nombre}
                            </h3>
                            <button className="btn-icon" onClick={() => setSelectedMascota(null)}>✕</button>
                        </div>

                        {loadingDetalle ? (
                            <div style={{ color: 'var(--text-dim)', textAlign: 'center', padding: '2rem' }}>Cargando...</div>
                        ) : detalle && (
                            <>
                                {/* Datos de la mascota */}
                                <div style={{ display: 'grid', gap: '0.4rem', fontSize: '0.875rem', marginBottom: '1.25rem' }}>
                                    {detalle.especie && <div><span style={{ color: 'var(--text-dim)' }}>Especie:</span> {detalle.especie}</div>}
                                    {detalle.raza && <div><span style={{ color: 'var(--text-dim)' }}>Raza:</span> {detalle.raza}</div>}
                                    {detalle.color && <div><span style={{ color: 'var(--text-dim)' }}>Color:</span> {detalle.color}</div>}
                                    {detalle.pelaje && <div><span style={{ color: 'var(--text-dim)' }}>Pelaje:</span> {detalle.pelaje}</div>}
                                    {detalle.tamanio && <div><span style={{ color: 'var(--text-dim)' }}>Tamaño:</span> {detalle.tamanio}</div>}
                                    {detalle.sexo && <div><span style={{ color: 'var(--text-dim)' }}>Sexo:</span> {detalle.sexo}</div>}
                                    {detalle.fecha_nac && <div><span style={{ color: 'var(--text-dim)' }}>Nac.:</span> {new Date(detalle.fecha_nac).toLocaleDateString('es-AR')}</div>}
                                </div>

                                {/* Dueño */}
                                {detalle.socio_apellido && (
                                    <div style={{ background: 'var(--surface-alt)', borderRadius: '8px', padding: '0.75rem', marginBottom: '1.25rem', fontSize: '0.875rem' }}>
                                        <div style={{ fontWeight: 600, marginBottom: '0.25rem' }}>👤 {detalle.socio_apellido}, {detalle.socio_nombre} <span className="badge" style={{ verticalAlign: 'middle', marginLeft: '0.5rem' }}>Socio</span></div>
                                        {(detalle.socio_celular || detalle.socio_telefono) && <div>📞 {detalle.socio_celular || detalle.socio_telefono}</div>}
                                        {detalle.socio_documento && <div>DNI: {detalle.socio_documento}</div>}
                                    </div>
                                )}
                                {detalle.particular_apellido && (
                                    <div style={{ background: 'var(--surface-alt)', borderRadius: '8px', padding: '0.75rem', marginBottom: '1.25rem', fontSize: '0.875rem' }}>
                                        <div style={{ fontWeight: 600, marginBottom: '0.25rem' }}>👤 {detalle.particular_apellido}, {detalle.particular_nombre} <span className="badge" style={{ verticalAlign: 'middle', marginLeft: '0.5rem', background: 'var(--accent)' }}>Particular</span></div>
                                        {(detalle.particular_celular || detalle.particular_telefono) && <div>📞 {detalle.particular_celular || detalle.particular_telefono}</div>}
                                        {detalle.particular_documento && <div>DNI: {detalle.particular_documento}</div>}
                                    </div>
                                )}

                                {/* Historia Clínica */}
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.75rem' }}>
                                    <h4 style={{ margin: 0, color: 'var(--accent)' }}>
                                        📋 Historia Clínica ({detalle.historia_clinica?.length || 0})
                                    </h4>
                                    {canEdit && (
                                        <button className="btn-secondary" style={{ fontSize: '0.75rem', padding: '0.3rem 0.7rem' }}
                                            onClick={() => setShowHC(v => !v)}>
                                            {showHC ? 'Cerrar' : '+ Agregar'}
                                        </button>
                                    )}
                                </div>

                                {showHC && (
                                    <form onSubmit={handleAddHC} style={{ marginBottom: '1rem', display: 'flex', flexDirection: 'column', gap: '0.6rem' }}>
                                        <textarea className="form-input" rows={2} placeholder="Descripción / motivo de consulta *"
                                            value={hcForm.descripcion} required
                                            onChange={e => setHcForm(f => ({ ...f, descripcion: e.target.value }))} />
                                        <textarea className="form-input" rows={2} placeholder="Diagnóstico"
                                            value={hcForm.diagnostico}
                                            onChange={e => setHcForm(f => ({ ...f, diagnostico: e.target.value }))} />
                                        <textarea className="form-input" rows={2} placeholder="Tratamiento / indicaciones"
                                            value={hcForm.tratamiento}
                                            onChange={e => setHcForm(f => ({ ...f, tratamiento: e.target.value }))} />
                                        {hcMessage.text && (
                                            <div className={hcMessage.type === 'success' ? 'success-msg' : 'login-error'}>
                                                {hcMessage.text}
                                            </div>
                                        )}
                                        <button type="submit" className="btn-primary">Guardar entrada</button>
                                    </form>
                                )}

                                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.6rem' }}>
                                    {detalle.historia_clinica?.length === 0 && (
                                        <p style={{ color: 'var(--text-dim)', fontSize: '0.875rem' }}>Sin entradas clínicas</p>
                                    )}
                                    {detalle.historia_clinica?.map(hc => (
                                        <div key={hc.id} className="card" style={{ padding: '0.75rem', background: 'var(--surface-alt)', fontSize: '0.85rem' }}>
                                            <div style={{ color: 'var(--text-dim)', fontSize: '0.75rem', marginBottom: '0.3rem' }}>
                                                {new Date(hc.FechaCreacion).toLocaleString('es-AR')}
                                                {hc.veterinario_apellido && ` · ${hc.veterinario_apellido}`}
                                            </div>
                                            {hc.descripcion && <div><strong>Consulta:</strong> {hc.descripcion}</div>}
                                            {hc.diagnostico && <div><strong>Diagnóstico:</strong> {hc.diagnostico}</div>}
                                            {hc.tratamiento && <div><strong>Tratamiento:</strong> {hc.tratamiento}</div>}
                                        </div>
                                    ))}
                                </div>
                            </>
                        )}
                    </div>
                )}
            </div>

            {/* Modal Formulario Mascota */}
            {showForm && (
                <div className="modal-overlay" onClick={() => setShowForm(false)}>
                    <div className="modal-content" style={{ maxWidth: '600px' }} onClick={e => e.stopPropagation()}>
                        <div className="modal-header">
                            <h2>{editingId ? 'Editar Mascota' : 'Nueva Mascota'}</h2>
                            <button className="btn-icon" onClick={() => setShowForm(false)}>✕</button>
                        </div>

                        <form onSubmit={handleSubmit} className="login-form" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                            {/* Búsqueda de dueño */}
                            <div className="form-group" style={{ gridColumn: 'span 2', position: 'relative' }}>
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.35rem' }}>
                                    <label style={{ margin: 0 }}>Dueño</label>
                                    <div style={{ display: 'flex', gap: '0.75rem' }}>
                                        <label style={{ display: 'flex', alignItems: 'center', gap: '0.25rem', fontSize: '0.8rem', cursor: 'pointer', margin: 0 }}>
                                            <input type="radio" checked={ownerType === 'socio'} onChange={() => handleOwnerTypeChange('socio')} />
                                            Socio
                                        </label>
                                        <label style={{ display: 'flex', alignItems: 'center', gap: '0.25rem', fontSize: '0.8rem', cursor: 'pointer', margin: 0 }}>
                                            <input type="radio" checked={ownerType === 'particular'} onChange={() => handleOwnerTypeChange('particular')} />
                                            Particular
                                        </label>
                                    </div>
                                </div>
                                <input className="form-input" placeholder={`Buscar ${ownerType} por apellido...`}
                                    value={ownerSearch}
                                    onChange={e => searchOwners(e.target.value)} />
                                {owners.length > 0 && (
                                    <div style={{ border: '1px solid var(--border)', borderRadius: '6px', marginTop: '4px', background: 'var(--surface)', maxHeight: '150px', overflowY: 'auto', position: 'absolute', width: '100%', zIndex: 10 }}>
                                        {owners.map(o => (
                                            <div key={o.id}
                                                style={{ padding: '0.5rem 0.75rem', cursor: 'pointer', borderBottom: '1px solid var(--border)', background: 'var(--surface)' }}
                                                onClick={() => {
                                                    if (ownerType === 'particular') {
                                                        setForm(f => ({ ...f, particular_id: o.id, socio_id: null, origen: 'particular' }));
                                                    } else {
                                                        setForm(f => ({ ...f, socio_id: o.id, particular_id: null, origen: 'socio' }));
                                                    }
                                                    setOwnerSearch(`${o.apellido}, ${o.nombre}`);
                                                    setOwners([]);
                                                }}>
                                                <strong>{o.apellido}, {o.nombre}</strong>
                                                {o.documento && <span style={{ color: 'var(--text-dim)', marginLeft: '0.5rem' }}>DNI: {o.documento}</span>}
                                            </div>
                                        ))}
                                    </div>
                                )}
                                {(form.socio_id || form.particular_id) && (
                                    <div style={{ fontSize: '0.8rem', color: 'var(--success)', marginTop: '4px' }}>
                                        ✓ {ownerType === 'particular' ? 'Particular' : 'Socio'} seleccionado
                                        <button type="button" style={{ marginLeft: '0.5rem', fontSize: '0.75rem', background: 'none', border: 'none', color: 'var(--text-dim)', cursor: 'pointer' }}
                                            onClick={() => {
                                                setForm(f => ({ ...f, socio_id: '', particular_id: '' }));
                                                setOwnerSearch('');
                                            }}>
                                            (quitar)
                                        </button>
                                    </div>
                                )}
                            </div>

                            <div className="form-group" style={{ gridColumn: 'span 2' }}>
                                <label>Nombre *</label>
                                <input className="form-input" required value={form.nombre}
                                    onChange={e => setForm(f => ({ ...f, nombre: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Especie</label>
                                <input className="form-input" list="especies-list" value={form.especie}
                                    onChange={e => setForm(f => ({ ...f, especie: e.target.value.toUpperCase() }))} />
                                <datalist id="especies-list">
                                    {especies.map(esp => <option key={esp} value={esp} />)}
                                </datalist>
                            </div>
                            <div className="form-group">
                                <label>Raza</label>
                                <input className="form-input" value={form.raza}
                                    onChange={e => setForm(f => ({ ...f, raza: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Color</label>
                                <input className="form-input" value={form.color}
                                    onChange={e => setForm(f => ({ ...f, color: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Pelaje</label>
                                <input className="form-input" value={form.pelaje}
                                    onChange={e => setForm(f => ({ ...f, pelaje: e.target.value }))} />
                            </div>
                            <div className="form-group">
                                <label>Tamaño</label>
                                <select className="form-input" value={form.tamanio}
                                    onChange={e => setForm(f => ({ ...f, tamanio: e.target.value }))}>
                                    <option value="">Sin especificar</option>
                                    <option>PEQUEÑO</option><option>MEDIANO</option><option>GRANDE</option><option>GIGANTE</option>
                                </select>
                            </div>
                            <div className="form-group">
                                <label>Sexo</label>
                                <select className="form-input" value={form.sexo}
                                    onChange={e => setForm(f => ({ ...f, sexo: e.target.value }))}>
                                    <option value="">Sin especificar</option>
                                    <option value="Macho">Macho</option>
                                    <option value="HEMBRA">Hembra</option>
                                </select>
                            </div>
                            <div className="form-group">
                                <label>Fecha de Nacimiento</label>
                                <input className="form-input" type="date" value={form.fecha_nac}
                                    onChange={e => setForm(f => ({ ...f, fecha_nac: e.target.value }))} />
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
                                <button type="submit" className="btn-primary">{editingId ? 'Guardar cambios' : 'Crear mascota'}</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Mascotas;
