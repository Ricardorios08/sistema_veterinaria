import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { Plus, Trash2, Edit2, Check, X, ShieldAlert, Sparkles, Lock } from 'lucide-react';

const ObrasSociales = ({ user }) => {
    const [obras, setObras] = useState([]);
    const [globalObras, setGlobalObras] = useState([]);
    const [nombre, setNombre] = useState('');
    const [sigla, setSigla] = useState('');
    const [descripcion, setDescripcion] = useState('');
    const [tipo, setTipo] = useState('publica');
    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState({ type: '', text: '' });
    const [showModal, setShowModal] = useState(false);

    // Editing states
    const [editingId, setEditingId] = useState(null);
    const [editNombre, setEditNombre] = useState('');
    const [editSigla, setEditSigla] = useState('');
    const [editDescripcion, setEditDescripcion] = useState('');

    const isReadOnly = ['profesional', 'veterinario', 'peluquero', 'traslado'].includes(user?.rol);

    useEffect(() => {
        fetchObras();
        fetchGlobalObras();
    }, []);

    const fetchObras = async () => {
        try {
            const response = await axios.get(`${API_URL}/obras-sociales`);
            setObras(response.data);
        } catch (err) {
            console.error('Error fetching Obras Sociales:', err);
        }
    };

    const fetchGlobalObras = async () => {
        try {
            const response = await axios.get(`${API_URL}/obras-sociales?catalog=true`);
            setGlobalObras(response.data);
        } catch (err) {
            console.error('Error fetching global Obras Sociales:', err);
        }
    };

    const handleLinkObra = async (globalObra) => {
        if (isReadOnly) return;
        setLoading(true);
        setMessage({ type: '', text: '' });
        try {
            await axios.post(`${API_URL}/obras-sociales`, {
                nombre: globalObra.nombre,
                sigla: globalObra.sigla,
                descripcion: globalObra.descripcion
            });
            setMessage({ type: 'success', text: `Obra Social "${globalObra.nombre}" vinculada con éxito` });
            setNombre('');
            setSigla('');
            setDescripcion('');
            fetchObras();
            fetchGlobalObras();
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al vincular Obra Social' });
        } finally {
            setLoading(false);
        }
    };

    const unlinkedObras = globalObras.filter(go => !obras.some(o => o.id === go.id));
    const matchingGlobalObra = nombre.trim() ? unlinkedObras.find(o => o.nombre.trim().toLowerCase() === nombre.trim().toLowerCase()) : null;

    const handleCreateObra = async (e) => {
        e.preventDefault();
        if (isReadOnly) return;
        if (!nombre.trim()) return;

        if (tipo === 'publica') {
            const confirm = window.confirm('Se va a guardar una obra social pública en el catálogo general, lo que permitirá que otras instituciones la vinculen. ¿Está seguro de continuar?');
            if (!confirm) {
                return;
            }
        }

        setLoading(true);
        setMessage({ type: '', text: '' });

        try {
            await axios.post(`${API_URL}/obras-sociales`, {
                nombre: nombre.trim(),
                sigla: sigla.trim() || null,
                descripcion: descripcion.trim() || null,
                tipo: tipo
            });
            setMessage({ type: 'success', text: 'Obra Social registrada con éxito' });
            setNombre('');
            setSigla('');
            setDescripcion('');
            setTipo('publica');
            fetchObras();
            fetchGlobalObras();
            setShowModal(false);
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al registrar Obra Social' });
        } finally {
            setLoading(false);
        }
    };

    const handleStartEdit = (item) => {
        if (isReadOnly) return;
        setEditingId(item.id);
        setEditNombre(item.nombre);
        setEditSigla(item.sigla || '');
        setEditDescripcion(item.descripcion || '');
    };

    const handleSaveEdit = async (id) => {
        if (isReadOnly) return;
        if (!editNombre.trim()) return;
        setLoading(true);
        try {
            await axios.put(`${API_URL}/obras-sociales/${id}`, {
                nombre: editNombre.trim(),
                sigla: editSigla.trim() || null,
                descripcion: editDescripcion.trim() || null
            });
            setEditingId(null);
            fetchObras();
            fetchGlobalObras();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al actualizar Obra Social');
        } finally {
            setLoading(false);
        }
    };

    const handleDeleteObra = async (id) => {
        if (isReadOnly) return;
        if (!window.confirm('¿Está seguro de eliminar esta Obra Social?')) return;
        try {
            await axios.delete(`${API_URL}/obras-sociales/${id}`);
            fetchObras();
            fetchGlobalObras();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al eliminar Obra Social');
        }
    };

    return (
        <div className="body-content" style={{ overflowY: 'auto', maxHeight: 'calc(100vh - 100px)' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem' }}>
                <div>
                    <h1>Obras Sociales y Prepagas</h1>
                    <p style={{ color: 'var(--text-dim)' }}>Gestión de convenios, coberturas médicas y aranceles</p>
                </div>
                {!isReadOnly && (
                    <button
                        onClick={() => {
                            setMessage({ type: '', text: '' });
                            setNombre('');
                            setSigla('');
                            setDescripcion('');
                            setTipo('publica');
                            setShowModal(true);
                        }}
                        className="btn btn-primary"
                        style={{ display: 'flex', alignItems: 'center', gap: '8px', width: 'auto', padding: '0.6rem 1.2rem' }}
                    >
                        <Plus size={18} />
                        Nueva Obra Social
                    </button>
                )}
            </div>

            <div style={{ display: 'grid', gridTemplateColumns: isReadOnly ? '1fr' : '1.2fr 1.8fr', gap: '1.5rem', alignItems: 'start' }}>
                {/* LEFT COLUMN: GLOBAL CATALOG ONLY */}
                {!isReadOnly && (
                    <div style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem' }}>
                        {/* GLOBAL CATALOG */}
                        <div className="users-list-card" style={{ width: '100%', margin: 0 }}>
                            <h2>Catálogo General (Red)</h2>
                            <p style={{ color: 'var(--text-dim)', fontSize: '0.8rem', marginBottom: '1rem' }}>
                                Convenios registrados en otras clínicas que puedes agregar a tu institución.
                            </p>
                            
                            {unlinkedObras.length === 0 ? (
                                <p style={{ fontSize: '0.85rem', color: 'var(--text-dim)', padding: '1rem', textAlign: 'center' }}>
                                    No hay más obras sociales disponibles en el catálogo global.
                                </p>
                            ) : (
                                <div style={{ maxHeight: '400px', overflowY: 'auto', display: 'flex', flexDirection: 'column', gap: '0.6rem' }}>
                                    {unlinkedObras.map(o => (
                                        <div key={o.id} style={{ 
                                            display: 'flex', 
                                            justifyContent: 'space-between', 
                                            alignItems: 'center', 
                                            padding: '0.5rem 0.8rem', 
                                            background: 'rgba(255, 255, 255, 0.03)', 
                                            borderRadius: '6px',
                                            border: '1px solid rgba(255, 255, 255, 0.05)'
                                        }}>
                                            <div style={{ display: 'flex', flexDirection: 'column' }}>
                                                <span style={{ fontWeight: 600, fontSize: '0.9rem', color: '#fff' }}>{o.nombre}</span>
                                                {o.sigla && <span className="role-badge admin" style={{ alignSelf: 'flex-start', marginTop: '4px', fontSize: '0.7rem' }}>{o.sigla}</span>}
                                            </div>
                                            <button 
                                                type="button"
                                                onClick={() => handleLinkObra(o)}
                                                className="btn btn-secondary"
                                                style={{ padding: '0.3rem 0.6rem', fontSize: '0.75rem', minHeight: 'auto', width: 'auto' }}
                                                disabled={loading}
                                            >
                                                Habilitar
                                            </button>
                                        </div>
                                    ))}
                                </div>
                            )}
                        </div>
                    </div>
                )}

                {/* LIST OF OBRAS SOCIALES */}
                <div className="users-list-card">
                    <h2 style={{ display: 'flex', alignItems: 'center', justifyContent: 'space-between' }}>
                        Coberturas Registradas
                        {isReadOnly && (
                            <span style={{ fontSize: '0.8rem', fontWeight: 'normal', color: 'var(--text-dim)', display: 'flex', alignItems: 'center', gap: '4px' }}>
                                <Lock size={12} /> Modo Lectura
                            </span>
                        )}
                    </h2>
                    
                    {obras.length === 0 ? (
                        <p style={{ textAlign: 'center', padding: '3rem', color: 'var(--text-dim)' }}>
                            No hay coberturas médicas registradas en el sistema.
                        </p>
                    ) : (
                        <div style={{ overflowX: 'auto', marginTop: '1rem' }}>
                            <table className="user-table">
                                <thead>
                                    <tr>
                                        <th style={{ width: '30%' }}>Nombre / Prepaga</th>
                                        <th style={{ width: '15%' }}>Sigla</th>
                                        <th style={{ width: '15%' }}>Tipo</th>
                                        <th style={{ width: isReadOnly ? '40%' : '25%' }}>Descripción</th>
                                        {!isReadOnly && <th style={{ width: '15%', textAlign: 'center' }}>Acciones</th>}
                                    </tr>
                                </thead>
                                <tbody>
                                    {obras.map(item => (
                                        <tr key={item.id}>
                                            <td>
                                                {editingId === item.id ? (
                                                    <input 
                                                        type="text" 
                                                        className="input-field"
                                                        value={editNombre}
                                                        onChange={e => setEditNombre(e.target.value)}
                                                        style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.9rem' }}
                                                    />
                                                ) : (
                                                    <span style={{ fontWeight: 600, color: '#fff' }}>{item.nombre}</span>
                                                )}
                                            </td>
                                            <td>
                                                {editingId === item.id ? (
                                                    <input 
                                                        type="text" 
                                                        className="input-field"
                                                        value={editSigla}
                                                        onChange={e => setEditSigla(e.target.value)}
                                                        style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.9rem' }}
                                                    />
                                                ) : (
                                                    item.sigla ? (
                                                        <span className="role-badge admin">{item.sigla}</span>
                                                    ) : (
                                                        <span style={{ color: 'var(--text-dim)' }}>-</span>
                                                    )
                                                )}
                                            </td>
                                            <td>
                                                {item.tipo === 'privada' ? (
                                                    <span className="role-badge" style={{ background: '#6366f1', color: '#fff', fontSize: '0.75rem', padding: '0.2rem 0.5rem' }}>Privada</span>
                                                ) : (
                                                    <span className="role-badge admin" style={{ background: '#10b981', color: '#fff', fontSize: '0.75rem', padding: '0.2rem 0.5rem' }}>Pública</span>
                                                )}
                                            </td>
                                            <td>
                                                {editingId === item.id ? (
                                                    <textarea 
                                                        className="input-field"
                                                        value={editDescripcion}
                                                        onChange={e => setEditDescripcion(e.target.value)}
                                                        rows="1"
                                                        style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.85rem', resize: 'none' }}
                                                    />
                                                ) : (
                                                    <span style={{ fontSize: '0.85rem', color: 'var(--text-dim)' }}>
                                                        {item.descripcion || '-'}
                                                    </span>
                                                )}
                                            </td>
                                            {!isReadOnly && (
                                                <td>
                                                    {editingId === item.id ? (
                                                        <div style={{ display: 'flex', gap: '0.4rem', justifyContent: 'center' }}>
                                                            <button 
                                                                onClick={() => handleSaveEdit(item.id)} 
                                                                className="btn btn-primary" 
                                                                style={{ padding: '0.3rem 0.5rem', fontSize: '0.8rem', background: '#10b981', borderColor: '#10b981' }}
                                                                disabled={loading}
                                                            >
                                                                <Check size={14} />
                                                            </button>
                                                            <button 
                                                                onClick={() => setEditingId(null)} 
                                                                className="btn" 
                                                                style={{ padding: '0.3rem 0.5rem', fontSize: '0.8rem' }}
                                                            >
                                                                <X size={14} />
                                                            </button>
                                                        </div>
                                                    ) : (
                                                        <div style={{ display: 'flex', gap: '0.4rem', justifyContent: 'center' }}>
                                                            <button 
                                                                onClick={() => handleStartEdit(item)}
                                                                className="btn btn-secondary"
                                                                style={{ padding: '0.3rem 0.5rem', fontSize: '0.8rem' }}
                                                            >
                                                                <Edit2 size={12} />
                                                            </button>
                                                            {item.sigla !== 'PART' && (
                                                                <button 
                                                                    onClick={() => handleDeleteObra(item.id)}
                                                                    className="delete-btn"
                                                                    style={{ padding: '0.3rem 0.5rem', fontSize: '0.8rem' }}
                                                                >
                                                                    <Trash2 size={12} />
                                                                </button>
                                                            )}
                                                        </div>
                                                    )}
                                                </td>
                                            )}
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    )}
                </div>
            </div>

            {/* MODAL PARA AGREGAR NUEVA OBRA SOCIAL */}
            {showModal && (
                <div style={{
                    position: 'fixed',
                    top: 0,
                    left: 0,
                    right: 0,
                    bottom: 0,
                    backgroundColor: 'rgba(0, 0, 0, 0.75)',
                    backdropFilter: 'blur(5px)',
                    display: 'flex',
                    justifyContent: 'center',
                    alignItems: 'center',
                    zIndex: 1000,
                    padding: '1rem'
                }}>
                    <div className="user-form-card" style={{
                        maxWidth: '500px',
                        width: '100%',
                        margin: 0,
                        background: 'var(--bg-card)',
                        border: '1px solid var(--border-color)',
                        borderRadius: '12px',
                        boxShadow: '0 8px 32px 0 rgba(0, 0, 0, 0.37)',
                        padding: '1.5rem',
                        position: 'relative'
                    }}>
                        <button
                            onClick={() => setShowModal(false)}
                            style={{
                                position: 'absolute',
                                top: '1rem',
                                right: '1rem',
                                background: 'transparent',
                                border: 'none',
                                color: 'var(--text-dim)',
                                cursor: 'pointer'
                            }}
                            title="Cerrar"
                        >
                            <X size={20} />
                        </button>
                        
                        <h2 style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '1rem' }}>
                            <Sparkles size={18} color="var(--primary)" />
                            Nueva Cobertura Médica
                        </h2>
                        
                        <form onSubmit={handleCreateObra} className="login-form">
                            <div className="form-group">
                                <label>Nombre de la Obra Social / Prepaga *</label>
                                <input 
                                    type="text"
                                    className="input-field"
                                    value={nombre}
                                    onChange={(e) => setNombre(e.target.value)}
                                    placeholder="Ej: Obra Social de Empleados Públicos"
                                    required
                                />
                                {matchingGlobalObra && (
                                    <div style={{ 
                                        marginTop: '0.5rem', 
                                        padding: '0.6rem', 
                                        background: 'rgba(59, 130, 246, 0.1)', 
                                        border: '1px solid #3b82f6', 
                                        borderRadius: '8px',
                                        fontSize: '0.85rem',
                                        display: 'flex', 
                                        justifyContent: 'space-between', 
                                        alignItems: 'center',
                                        gap: '10px'
                                    }}>
                                        <span>
                                            💡 <strong>{matchingGlobalObra.nombre} ({matchingGlobalObra.sigla || 'Sin sigla'})</strong> ya existe. ¿Deseas vincularla?
                                        </span>
                                        <button 
                                            type="button"
                                            className="btn btn-primary"
                                            style={{ padding: '0.2rem 0.6rem', fontSize: '0.75rem', width: 'auto', minHeight: 'auto' }}
                                            onClick={() => {
                                                handleLinkObra(matchingGlobalObra);
                                                setShowModal(false);
                                            }}
                                            disabled={loading}
                                        >
                                            Vincular
                                        </button>
                                    </div>
                                )}
                            </div>

                            <div className="form-group">
                                <label>Sigla / Abreviación (Opcional)</label>
                                <input 
                                    type="text"
                                    className="input-field"
                                    value={sigla}
                                    onChange={(e) => setSigla(e.target.value)}
                                    placeholder="Ej: OSEP"
                                />
                            </div>

                            <div className="form-group">
                                <label>Tipo de Obra Social</label>
                                <select 
                                    className="input-field"
                                    value={tipo}
                                    onChange={(e) => setTipo(e.target.value)}
                                    style={{ background: 'var(--bg-card)', color: '#fff', border: '1px solid var(--border-color)', height: '42px' }}
                                >
                                    <option value="publica">Pública (Disponible en el catálogo global de la red)</option>
                                    <option value="privada">Privada (Visible únicamente para mi clínica)</option>
                                </select>
                            </div>

                            <div className="form-group">
                                <label>Descripción / Observaciones</label>
                                <textarea 
                                    className="input-field"
                                    rows="3"
                                    value={descripcion}
                                    onChange={(e) => setDescripcion(e.target.value)}
                                    placeholder="Detalles de facturación o convenios..."
                                    style={{ resize: 'none', padding: '0.5rem' }}
                                />
                            </div>

                            {message.text && (
                                <div className={message.type === 'success' ? 'success-msg' : 'login-error'} style={{ marginBottom: '1rem', padding: '0.6rem' }}>
                                    {message.text}
                                </div>
                            )}

                            <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '0.5rem', marginTop: '1.5rem' }}>
                                <button 
                                    type="button" 
                                    className="btn btn-secondary" 
                                    onClick={() => setShowModal(false)}
                                    style={{ width: 'auto', padding: '0.5rem 1.5rem', minHeight: 'auto' }}
                                >
                                    Cancelar
                                </button>
                                <button 
                                    type="submit" 
                                    className="btn btn-primary" 
                                    disabled={loading}
                                    style={{ display: 'flex', alignItems: 'center', gap: '6px', width: 'auto', padding: '0.5rem 1.5rem', minHeight: 'auto' }}
                                >
                                    <Plus size={16} />
                                    Agregar Cobertura
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
};

export default ObrasSociales;
