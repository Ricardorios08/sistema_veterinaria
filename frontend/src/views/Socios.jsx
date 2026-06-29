import React, { useState, useEffect, useCallback } from 'react';
import axios from 'axios';
import { API_URL } from '../config';

const MESES = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];

const CuotaChip = ({ cuota }) => {
    const pagado = cuota.estado === 'PAGADO';
    return (
        <div title={pagado ? `Pagado el ${cuota.fecha_pago || '—'}` : `Pendiente · Boleta ${cuota.nro_boleta}`}
            style={{
                display: 'flex', flexDirection: 'column', alignItems: 'center',
                padding: '6px 10px', borderRadius: '8px', minWidth: '68px',
                background: pagado ? 'rgba(52,211,153,0.12)' : 'rgba(251,191,36,0.15)',
                border: `1px solid ${pagado ? '#34d39944' : '#fbbf2466'}`,
                cursor: 'default', transition: 'all 0.15s',
            }}>
            <span style={{ fontSize: '0.68rem', fontWeight: 700, color: pagado ? '#34d399' : '#fbbf24', lineHeight: 1 }}>
                {MESES[(cuota.mes - 1) % 12]}/{String(cuota.anio).slice(2)}
            </span>
            <span style={{ fontSize: '0.72rem', color: pagado ? '#34d399bb' : '#fbbf24bb', marginTop: '2px' }}>
                ${(cuota.importe / 1000).toFixed(1)}K
            </span>
            <span style={{ fontSize: '0.6rem', marginTop: '2px', color: pagado ? '#34d399' : '#fbbf24', opacity: 0.8 }}>
                {pagado ? '✓' : '⏳'}
            </span>
        </div>
    );
};

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

    // Cuotas / pagos
    const [pagosData, setPagosData] = useState(null);
    const [loadingPagos, setLoadingPagos] = useState(false);
    const [mostrarTodasCuotas, setMostrarTodasCuotas] = useState(false);

    // Formulario crear/editar
    const [showForm, setShowForm] = useState(false);
    const [editingId, setEditingId] = useState(null);
    const [cobradores, setCobradores] = useState([]);
    const [form, setForm] = useState({
        apellido: '', nombre: '', tipo_doc: 'D.N.I', documento: '',
        telefono: '', celular: '', domicilio: '', localidad: '',
        departamento: '', cod_postal: '', mail: '', sexo: '',
        fecha_ingreso: '', importe_cuota: '', observaciones: '',
        ruta: '', cobrador: '', no_imprimir: 'FALSO'
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

    const fetchCobradores = async () => {
        try {
            const res = await axios.get(`${API_URL}/socios/cobradores`);
            setCobradores(res.data);
        } catch (err) {
            console.error('Error fetching cobradores:', err);
        }
    };

    useEffect(() => { 
        fetchSocios(1, ''); 
        fetchCobradores();
    }, []);

    const handleSearch = (e) => {
        e.preventDefault();
        fetchSocios(1, search);
    };

    const fetchDetalle = async (socio) => {
        setSelectedSocio(socio);
        setDetalle(null);
        setPagosData(null);
        setMostrarTodasCuotas(false);
        setLoadingDetalle(true);
        try {
            const [detalleRes, pagosRes] = await Promise.allSettled([
                axios.get(`${API_URL}/socios/${socio.id}`),
                axios.get(`${API_URL}/socios/${socio.id}/pagos`, { params: { limit: 24 } }),
            ]);
            if (detalleRes.status === 'fulfilled') setDetalle(detalleRes.value.data);
            if (pagosRes.status === 'fulfilled') setPagosData(pagosRes.value.data);
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
                  fecha_ingreso: '', importe_cuota: '', observaciones: '',
                  ruta: '', cobrador: '', no_imprimir: 'FALSO' });
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
            importe_cuota: s.importe_cuota || '', observaciones: s.observaciones || '',
            ruta: s.ruta || '', cobrador: s.cobrador || '', no_imprimir: s.no_imprimir || 'FALSO'
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
                    <div className="card" style={{ position: 'sticky', top: '1rem', alignSelf: 'flex-start', maxHeight: 'calc(100vh - 10rem)', overflowY: 'auto' }}>

                        {/* Header del panel */}
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'flex-start', marginBottom: '1rem' }}>
                            <div>
                                {detalle?.cod_mevep && (
                                    <div style={{ fontSize: '0.7rem', color: 'var(--text-dim)', marginBottom: '2px' }}>
                                        Socio N° <strong style={{ color: '#38bdf8' }}>{detalle.cod_mevep}</strong>
                                    </div>
                                )}
                                <h3 style={{ margin: 0, fontSize: '1rem' }}>{selectedSocio.apellido}, {selectedSocio.nombre}</h3>
                            </div>
                            <button className="btn-icon" onClick={() => { setSelectedSocio(null); setPagosData(null); }}>✕</button>
                        </div>

                        {loadingDetalle ? (
                            <div style={{ color: 'var(--text-dim)', textAlign: 'center', padding: '2rem' }}>Cargando...</div>
                        ) : detalle && (
                            <>
                                {/* ── Datos personales ── */}
                                <div style={{ display: 'grid', gap: '0.4rem', fontSize: '0.82rem', marginBottom: '1rem' }}>
                                    {detalle.documento && <div><span style={{ color: 'var(--text-dim)' }}>DNI:</span> {detalle.tipo_doc} {detalle.documento}</div>}
                                    {(detalle.celular || detalle.telefono) && <div><span style={{ color: 'var(--text-dim)' }}>Tel:</span> {detalle.celular || detalle.telefono}</div>}
                                    {detalle.mail && <div><span style={{ color: 'var(--text-dim)' }}>Mail:</span> {detalle.mail}</div>}
                                    {detalle.domicilio && <div><span style={{ color: 'var(--text-dim)' }}>Dom:</span> {detalle.domicilio}</div>}
                                    {detalle.departamento && <div><span style={{ color: 'var(--text-dim)' }}>Localidad:</span> {detalle.departamento}</div>}
                                    {(detalle.ruta || detalle.cobrador || detalle.no_imprimir === 'VERDADERO') && (
                                        <div>
                                            {detalle.ruta && <span style={{ marginRight: '1rem' }}><span style={{ color: 'var(--text-dim)' }}>Ruta:</span> <strong>{detalle.ruta}</strong></span>}
                                            {detalle.cobrador && <span><span style={{ color: 'var(--text-dim)' }}>Cobrador:</span> <strong>{detalle.cobrador}</strong></span>}
                                            {detalle.no_imprimir === 'VERDADERO' && <span style={{ marginLeft: '1rem', color: '#f87171', fontWeight: 600 }}>(Cobro Local)</span>}
                                        </div>
                                    )}
                                </div>

                                {/* ── Sección Cuotas / Pagos ── */}
                                {pagosData && (
                                    <div style={{ marginBottom: '1.25rem' }}>
                                        <div style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between', marginBottom: '0.6rem' }}>
                                            <span style={{ fontSize: '0.75rem', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '0.06em', color: 'var(--text-dim)' }}>
                                                💳 Cuotas
                                            </span>
                                            {/* Badge estado */}
                                            {pagosData.resumen.estado === 'al_dia' && (
                                                <span style={{ background: 'rgba(52,211,153,0.15)', color: '#34d399', border: '1px solid #34d39944', borderRadius: '20px', padding: '2px 10px', fontSize: '0.7rem', fontWeight: 700 }}>
                                                    ✓ Al día
                                                </span>
                                            )}
                                            {pagosData.resumen.estado === 'con_deuda' && (
                                                <span style={{ background: 'rgba(251,191,36,0.15)', color: '#fbbf24', border: '1px solid #fbbf2444', borderRadius: '20px', padding: '2px 10px', fontSize: '0.7rem', fontWeight: 700 }}>
                                                    ⚠ {pagosData.resumen.pendientes} pendiente{pagosData.resumen.pendientes > 1 ? 's' : ''}
                                                </span>
                                            )}
                                            {pagosData.resumen.estado === 'inhabilitado' && (
                                                <span style={{ background: 'rgba(239,68,68,0.15)', color: '#f87171', border: '1px solid #f8717144', borderRadius: '20px', padding: '2px 10px', fontSize: '0.7rem', fontWeight: 700, animation: 'pulse 1.5s infinite' }}>
                                                    🔴 INHABILITADO
                                                </span>
                                            )}
                                        </div>

                                        {/* Info cobrador / modo pago */}
                                        {(pagosData.resumen.cobrador_nombre || pagosData.resumen.ruta) && (
                                            <div style={{ display: 'flex', gap: '0.5rem', marginBottom: '0.75rem', flexWrap: 'wrap' }}>
                                                {pagosData.resumen.modo_pago && (
                                                    <span style={{ background: 'rgba(129,140,248,0.12)', color: '#818cf8', border: '1px solid #818cf833', borderRadius: '6px', padding: '2px 8px', fontSize: '0.7rem' }}>
                                                        Pago: {pagosData.resumen.modo_pago}
                                                    </span>
                                                )}
                                                {pagosData.resumen.cobrador_nombre && (
                                                    <span style={{ background: 'rgba(129,140,248,0.12)', color: '#818cf8', border: '1px solid #818cf833', borderRadius: '6px', padding: '2px 8px', fontSize: '0.7rem' }}>
                                                        Cobrador: {pagosData.resumen.cobrador_nombre}
                                                    </span>
                                                )}
                                                {pagosData.resumen.ruta > 0 && (
                                                    <span style={{ background: 'rgba(129,140,248,0.12)', color: '#818cf8', border: '1px solid #818cf833', borderRadius: '6px', padding: '2px 8px', fontSize: '0.7rem' }}>
                                                        Ruta: {pagosData.resumen.ruta}
                                                    </span>
                                                )}
                                            </div>
                                        )}

                                        {/* Deuda total si tiene pendientes */}
                                        {pagosData.resumen.deuda_total > 0 && (
                                            <div style={{
                                                background: 'rgba(251,191,36,0.08)', border: '1px solid #fbbf2433',
                                                borderRadius: '8px', padding: '0.5rem 0.75rem',
                                                marginBottom: '0.75rem', display: 'flex', justifyContent: 'space-between', alignItems: 'center'
                                            }}>
                                                <span style={{ fontSize: '0.75rem', color: '#fbbf24' }}>Deuda total:</span>
                                                <span style={{ fontSize: '0.9rem', fontWeight: 800, color: '#fbbf24' }}>
                                                    ${pagosData.resumen.deuda_total.toLocaleString('es-AR')}
                                                </span>
                                            </div>
                                        )}

                                        {/* Grid de chips de cuotas */}
                                        {pagosData.cuotas.length > 0 ? (
                                            <>
                                                <div style={{ display: 'flex', flexWrap: 'wrap', gap: '0.4rem' }}>
                                                    {(mostrarTodasCuotas ? pagosData.cuotas : pagosData.cuotas.slice(0, 12)).map((c, i) => (
                                                        <CuotaChip key={i} cuota={c} />
                                                    ))}
                                                </div>
                                                {pagosData.cuotas.length > 12 && (
                                                    <button
                                                        style={{ all: 'unset', cursor: 'pointer', fontSize: '0.72rem', color: 'var(--text-dim)', marginTop: '0.5rem', display: 'block', textDecoration: 'underline' }}
                                                        onClick={() => setMostrarTodasCuotas(v => !v)}
                                                    >
                                                        {mostrarTodasCuotas ? 'Mostrar menos' : `Ver los ${pagosData.cuotas.length - 12} anteriores`}
                                                    </button>
                                                )}
                                            </>
                                        ) : (
                                            <p style={{ fontSize: '0.8rem', color: 'var(--text-dim)' }}>Sin cuotas registradas en el sistema</p>
                                        )}
                                    </div>
                                )}

                                <div style={{ height: '1px', background: 'var(--border)', margin: '0.75rem 0' }} />

                                {/* ── Mascotas ── */}
                                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.75rem' }}>
                                    <h4 style={{ margin: 0, color: 'var(--accent)', fontSize: '0.9rem' }}>
                                        🐶 Mascotas ({detalle.mascotas?.length || 0})
                                    </h4>
                                    <button className="btn-secondary" style={{ fontSize: '0.72rem', padding: '0.25rem 0.6rem' }}
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
                    <div className="modal-content" style={{ maxWidth: '850px', width: '100%' }} onClick={e => e.stopPropagation()}>
                        <div className="modal-header">
                            <h2>{editingId ? 'Editar Socio' : 'Nuevo Socio'}</h2>
                            <button className="btn-icon" onClick={() => setShowForm(false)}>✕</button>
                        </div>

                        <form onSubmit={handleSubmit} style={{ margin: 0, display: 'flex', flexDirection: 'column' }}>
                            <div className="modal-body">
                                <div className="form-grid-2">
                                    {/* ── Datos Personales ── */}
                                    <div className="form-section-title">
                                        👤 Datos Personales
                                    </div>
                                    
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
                                    
                                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
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

                                    {/* ── Contacto ── */}
                                    <div className="form-section-title">
                                        📞 Datos de Contacto
                                    </div>
                                    
                                    <div className="form-group">
                                        <label>Mail</label>
                                        <input className="form-input" type="email" value={form.mail}
                                            onChange={e => setForm(f => ({ ...f, mail: e.target.value }))} />
                                    </div>
                                    
                                    <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
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
                                    </div>

                                    {/* ── Domicilio ── */}
                                    <div className="form-section-title">
                                        📍 Domicilio y Localización
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

                                    {/* ── Información de Socio ── */}
                                    <div className="form-section-title">
                                        💳 Información de Socio
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
                                    <div className="form-group">
                                        <label>Ruta de Cobro (Nro/Orden)</label>
                                        <input className="form-input" type="number" value={form.ruta}
                                            placeholder="Ej: 145"
                                            onChange={e => setForm(f => ({ ...f, ruta: e.target.value }))} />
                                    </div>
                                    <div className="form-group">
                                        <label>Cobrador Asignado</label>
                                        <select className="form-input" value={form.cobrador}
                                            onChange={e => setForm(f => ({ ...f, cobrador: e.target.value }))}>
                                            <option value="">Sin cobrador</option>
                                            {cobradores.map(c => (
                                                <option key={c.cod_cobrador} value={c.cod_cobrador}>
                                                    {c.cod_cobrador} - {c.nombre_cobrador}
                                                </option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="form-group" style={{ gridColumn: 'span 2' }}>
                                        <label style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', cursor: 'pointer', userSelect: 'none' }}>
                                            <input type="checkbox" checked={form.no_imprimir === 'VERDADERO'}
                                                onChange={e => setForm(f => ({ ...f, no_imprimir: e.target.checked ? 'VERDADERO' : 'FALSO' }))}
                                                style={{ width: 'auto', margin: 0 }} />
                                            No Imprimir Boleta (Pago directo en Local/Oficina)
                                        </label>
                                    </div>

                                    {/* ── Observaciones ── */}
                                    <div className="form-section-title">
                                        📝 Observaciones
                                    </div>
                                    
                                    <div className="form-group" style={{ gridColumn: 'span 2', marginBottom: 0 }}>
                                        <textarea className="form-input" rows={2} placeholder="Notas adicionales sobre el socio..." value={form.observaciones}
                                            onChange={e => setForm(f => ({ ...f, observaciones: e.target.value }))} />
                                    </div>
                                </div>

                                {message.text && (
                                    <div className={message.type === 'success' ? 'success-msg' : 'login-error'}
                                        style={{ marginTop: '1.5rem', marginBottom: 0 }}>
                                        {message.text}
                                    </div>
                                )}
                            </div>

                            <div className="modal-footer">
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
