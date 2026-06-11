import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { Plus, Trash2, Edit2, Check, X, ShieldAlert, Sparkles, Building, Phone, MapPin } from 'lucide-react';

const Prestadores = () => {
    const [prestadores, setPrestadores] = useState([]);
    const [nombre, setNombre] = useState('');
    const [sigla, setSigla] = useState('');
    const [cuit, setCuit] = useState('');
    const [direccion, setDireccion] = useState('');
    const [telefono, setTelefono] = useState('');
    const [loading, setLoading] = useState(false);
    const [message, setMessage] = useState({ type: '', text: '' });

    // Editing states
    const [editingId, setEditingId] = useState(null);
    const [editNombre, setEditNombre] = useState('');
    const [editSigla, setEditSigla] = useState('');
    const [editCuit, setEditCuit] = useState('');
    const [editDireccion, setEditDireccion] = useState('');
    const [editTelefono, setEditTelefono] = useState('');

    useEffect(() => {
        fetchPrestadores();
    }, []);

    const fetchPrestadores = async () => {
        try {
            const token = localStorage.getItem('sulb_token');
            const response = await axios.get(`${API_URL}/prestadores`, {
                headers: { Authorization: `Bearer ${token}` }
            });
            setPrestadores(response.data);
        } catch (err) {
            console.error('Error fetching Prestadores:', err);
        }
    };

    const handleCreatePrestador = async (e) => {
        e.preventDefault();
        if (!nombre.trim()) return;

        setLoading(true);
        setMessage({ type: '', text: '' });

        try {
            const token = localStorage.getItem('sulb_token');
            await axios.post(
                `${API_URL}/prestadores`, 
                {
                    nombre: nombre.trim(),
                    sigla: sigla.trim() || null,
                    cuit: cuit.trim() || null,
                    direccion: direccion.trim() || null,
                    telefono: telefono.trim() || null
                },
                { headers: { Authorization: `Bearer ${token}` } }
            );
            setMessage({ type: 'success', text: 'Institución registrada con éxito.' });
            setNombre('');
            setSigla('');
            setCuit('');
            setDireccion('');
            setTelefono('');
            fetchPrestadores();
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al registrar institución' });
        } finally {
            setLoading(false);
        }
    };

    const handleStartEdit = (item) => {
        setEditingId(item.id);
        setEditNombre(item.nombre);
        setEditSigla(item.sigla || '');
        setEditCuit(item.cuit || '');
        setEditDireccion(item.direccion || '');
        setEditTelefono(item.telefono || '');
    };

    const handleSaveEdit = async (id) => {
        if (!editNombre.trim()) return;
        setLoading(true);
        try {
            const token = localStorage.getItem('sulb_token');
            await axios.put(
                `${API_URL}/prestadores/${id}`, 
                {
                    nombre: editNombre.trim(),
                    sigla: editSigla.trim() || null,
                    cuit: editCuit.trim() || null,
                    direccion: editDireccion.trim() || null,
                    telefono: editTelefono.trim() || null
                },
                { headers: { Authorization: `Bearer ${token}` } }
            );
            setEditingId(null);
            fetchPrestadores();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al actualizar institución');
        } finally {
            setLoading(false);
        }
    };

    const handleDeletePrestador = async (id) => {
        if (id === 1) {
            alert('No se puede eliminar la institución por defecto.');
            return;
        }
        if (!window.confirm('¿Está seguro de eliminar esta institución?')) return;
        try {
            const token = localStorage.getItem('sulb_token');
            await axios.delete(`${API_URL}/prestadores/${id}`, {
                headers: { Authorization: `Bearer ${token}` }
            });
            fetchPrestadores();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al eliminar institución');
        }
    };

    return (
        <div className="body-content" style={{ overflowY: 'auto', maxHeight: 'calc(100vh - 100px)' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem' }}>
                <div>
                    <h1>Instituciones y Consultorios</h1>
                    <p style={{ color: 'var(--text-dim)' }}>Gestión multi-tenant de consultorios, clínicas y hospitales</p>
                </div>
            </div>

            <div style={{ display: 'grid', gridTemplateColumns: '1.2fr 1.8fr', gap: '1.5rem', alignItems: 'start' }}>
                {/* CREATE FORM */}
                <div className="user-form-card" style={{ maxWidth: 'none', margin: 0 }}>
                    <h2 style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                        <Building size={18} color="var(--primary)" />
                        Nueva Institución
                    </h2>
                    
                    <form onSubmit={handleCreatePrestador} className="login-form" style={{ marginTop: '1.5rem' }}>
                        <div className="form-group">
                            <label>Nombre de la Institución / Consultorio *</label>
                            <input 
                                type="text"
                                className="input-field"
                                value={nombre}
                                onChange={(e) => setNombre(e.target.value)}
                                placeholder="Ej: Consultorio Odontológico del Este"
                                required
                            />
                        </div>

                        <div className="form-group">
                            <label>Sigla / Código (Opcional)</label>
                            <input 
                                type="text"
                                className="input-field"
                                value={sigla}
                                onChange={(e) => setSigla(e.target.value)}
                                placeholder="Ej: ODOM_ESTE"
                            />
                        </div>

                        <div className="form-group">
                            <label>CUIT (Opcional)</label>
                            <input 
                                type="text"
                                className="input-field"
                                value={cuit}
                                onChange={(e) => setCuit(e.target.value)}
                                placeholder="Ej: 30-71234567-9"
                            />
                        </div>

                        <div className="form-group">
                            <label>Dirección (Opcional)</label>
                            <input 
                                type="text"
                                className="input-field"
                                value={direccion}
                                onChange={(e) => setDireccion(e.target.value)}
                                placeholder="Ej: Av. San Martín 456, Mendoza"
                            />
                        </div>

                        <div className="form-group">
                            <label>Teléfono de Contacto (Opcional)</label>
                            <input 
                                type="text"
                                className="input-field"
                                value={telefono}
                                onChange={(e) => setTelefono(e.target.value)}
                                placeholder="Ej: 2614567890"
                            />
                        </div>

                        {message.text && (
                            <div className={message.type === 'success' ? 'success-msg' : 'login-error'} style={{ marginBottom: '1rem', padding: '0.6rem' }}>
                                {message.text}
                            </div>
                        )}

                        <button 
                            type="submit" 
                            className="btn btn-primary" 
                            disabled={loading}
                            style={{ display: 'flex', alignItems: 'center', gap: '6px', width: 'auto', padding: '0.6rem 2.5rem', marginLeft: 'auto' }}
                        >
                            <Plus size={16} />
                            {loading ? 'Registrando...' : 'Registrar'}
                        </button>
                    </form>
                </div>

                {/* LIST */}
                <div className="users-list-card">
                    <h2>Instituciones Registradas</h2>
                    
                    {prestadores.length === 0 ? (
                        <p style={{ textAlign: 'center', padding: '3rem', color: 'var(--text-dim)' }}>
                            No hay instituciones registradas en la plataforma.
                        </p>
                    ) : (
                        <div style={{ overflowX: 'auto', marginTop: '1rem' }}>
                            <table className="user-table">
                                <thead>
                                    <tr>
                                        <th style={{ width: '45%' }}>Nombre / Sigla</th>
                                        <th style={{ width: '20%' }}>CUIT</th>
                                        <th style={{ width: '20%' }}>Contacto</th>
                                        <th style={{ width: '15%', textAlign: 'center' }}>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {prestadores.map(item => (
                                        <tr key={item.id}>
                                            <td>
                                                {editingId === item.id ? (
                                                    <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                                                        <input 
                                                            type="text" 
                                                            className="input-field"
                                                            value={editNombre}
                                                            onChange={e => setEditNombre(e.target.value)}
                                                            placeholder="Nombre *"
                                                            style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.9rem' }}
                                                        />
                                                        <input 
                                                            type="text" 
                                                            className="input-field"
                                                            value={editSigla}
                                                            onChange={e => setEditSigla(e.target.value)}
                                                            placeholder="Sigla"
                                                            style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.85rem' }}
                                                        />
                                                    </div>
                                                ) : (
                                                    <div>
                                                        <span style={{ fontWeight: 600, color: '#fff' }}>{item.nombre}</span>
                                                        {item.sigla && (
                                                            <div style={{ marginTop: '0.2rem' }}>
                                                                <span className="role-badge admin" style={{ textTransform: 'none', fontSize: '0.75rem' }}>{item.sigla}</span>
                                                            </div>
                                                        )}
                                                    </div>
                                                )}
                                            </td>
                                            <td>
                                                {editingId === item.id ? (
                                                    <input 
                                                        type="text" 
                                                        className="input-field"
                                                        value={editCuit}
                                                        onChange={e => setEditCuit(e.target.value)}
                                                        placeholder="CUIT"
                                                        style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.9rem' }}
                                                    />
                                                ) : (
                                                    <span style={{ fontSize: '0.85rem', color: 'var(--text-dim)' }}>
                                                        {item.cuit || '-'}
                                                    </span>
                                                )}
                                            </td>
                                            <td>
                                                {editingId === item.id ? (
                                                    <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                                                        <input 
                                                            type="text" 
                                                            className="input-field"
                                                            value={editDireccion}
                                                            onChange={e => setEditDireccion(e.target.value)}
                                                            placeholder="Dirección"
                                                            style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.85rem' }}
                                                        />
                                                        <input 
                                                            type="text" 
                                                            className="input-field"
                                                            value={editTelefono}
                                                            onChange={e => setEditTelefono(e.target.value)}
                                                            placeholder="Teléfono"
                                                            style={{ padding: '0.3rem 0.6rem', minHeight: 'auto', fontSize: '0.85rem' }}
                                                        />
                                                    </div>
                                                ) : (
                                                    <div style={{ display: 'flex', flexDirection: 'column', gap: '0.2rem', fontSize: '0.8rem', color: 'var(--text-dim)' }}>
                                                        {item.direccion && (
                                                            <div style={{ display: 'flex', alignItems: 'center', gap: '4px' }}>
                                                                <MapPin size={12} />
                                                                <span>{item.direccion}</span>
                                                            </div>
                                                        )}
                                                        {item.telefono && (
                                                            <div style={{ display: 'flex', alignItems: 'center', gap: '4px' }}>
                                                                <Phone size={12} />
                                                                <span>{item.telefono}</span>
                                                            </div>
                                                        )}
                                                        {!item.direccion && !item.telefono && <span>-</span>}
                                                    </div>
                                                )}
                                            </td>
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
                                                    <div style={{ display: 'flex', gap: '0.4rem', justifyContent: 'center', alignItems: 'center' }}>
                                                        <button 
                                                            onClick={() => handleStartEdit(item)}
                                                            className="btn btn-primary"
                                                            style={{ padding: '0.3rem 0.5rem', fontSize: '0.8rem', background: '#3b82f6', borderColor: '#3b82f6' }}
                                                            title="Editar Institución"
                                                        >
                                                            <Edit2 size={14} />
                                                        </button>
                                                        <button 
                                                            onClick={() => handleDeletePrestador(item.id)}
                                                            className="delete-btn"
                                                            style={{ padding: '0.3rem 0.5rem', fontSize: '0.8rem' }}
                                                            disabled={item.id === 1}
                                                            title="Eliminar Institución"
                                                        >
                                                            <Trash2 size={14} />
                                                        </button>
                                                    </div>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
};

export default Prestadores;
