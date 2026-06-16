import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { Plus, Trash2, Edit2, Check, X, ShieldAlert, Sparkles } from 'lucide-react';

const Nomenclature = () => {
    const [practices, setPractices] = useState([]);
    const [globalPractices, setGlobalPractices] = useState([]);
    const [loading, setLoading] = useState(false);
    const [currentUser, setCurrentUser] = useState(null);
    const [message, setMessage] = useState({ type: '', text: '' });
    const [showModal, setShowModal] = useState(false);

    // Create State
    const [codigo, setCodigo] = useState('');
    const [nombre, setNombre] = useState('');
    const [descripcion, setDescripcion] = useState('');
    const [precio, setPrecio] = useState('');
    const [categoria, setCategoria] = useState('veterinario');
    const [tipo, setTipo] = useState('publica');

    // Edit State
    const [editingId, setEditingId] = useState(null);
    const [editCodigo, setEditCodigo] = useState('');
    const [editNombre, setEditNombre] = useState('');
    const [editDescripcion, setEditDescripcion] = useState('');
    const [editPrecio, setEditPrecio] = useState('');
    const [editCategoria, setEditCategoria] = useState('veterinario');

    const [globalSearch, setGlobalSearch] = useState('');
    const [selectedCategoryFilter, setSelectedCategoryFilter] = useState('todos');

    useEffect(() => {
        const userStr = localStorage.getItem('sulb_user');
        if (userStr) {
            try { setCurrentUser(JSON.parse(userStr)); } catch(e){}
        }
        fetchPractices();
        fetchGlobalPractices();
    }, []);

    const fetchPractices = async () => {
        setLoading(true);
        try {
            const response = await axios.get(`${API_URL}/nomenclador`);
            setPractices(response.data);
        } catch (err) {
            console.error('Error fetching nomenclature:', err);
        } finally {
            setLoading(false);
        }
    };

    const fetchGlobalPractices = async () => {
        try {
            const response = await axios.get(`${API_URL}/nomenclador?catalog=true`);
            setGlobalPractices(response.data);
        } catch (err) {
            console.error('Error fetching global nomenclature:', err);
        }
    };

    const handleCreate = async (e) => {
        e.preventDefault();
        setMessage({ type: '', text: '' });
        setLoading(true);

        if (tipo === 'publica') {
            const confirmSave = window.confirm('Se va a guardar una práctica pública en el catálogo general, lo que permitirá que otras instituciones la vinculen con sus propios aranceles. ¿Está seguro de continuar?');
            if (!confirmSave) {
                setLoading(false);
                return;
            }
        }

        try {
            await axios.post(`${API_URL}/nomenclador`, {
                codigo,
                nombre,
                descripcion,
                precio: parseFloat(precio || '0'),
                categoria,
                tipo
            });
            setMessage({ type: 'success', text: 'Práctica dental agregada con éxito' });
            setCodigo('');
            setNombre('');
            setDescripcion('');
            setPrecio('');
            setCategoria('veterinario');
            setTipo('publica');
            fetchPractices();
            fetchGlobalPractices();
            setShowModal(false);
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al agregar la práctica' });
        } finally {
            setLoading(false);
        }
    };

    const handleLinkPractice = async (globalPractice, customPrice) => {
        setMessage({ type: '', text: '' });
        setLoading(true);
        try {
            await axios.post(`${API_URL}/nomenclador`, {
                codigo: globalPractice.codigo,
                nombre: globalPractice.nombre,
                descripcion: globalPractice.descripcion,
                precio: parseFloat(customPrice || '0'),
                categoria: globalPractice.categoria
            });
            setMessage({ type: 'success', text: `Práctica "${globalPractice.codigo}" vinculada con éxito` });
            setCodigo('');
            setNombre('');
            setDescripcion('');
            setPrecio('');
            fetchPractices();
            fetchGlobalPractices();
            setShowModal(false);
        } catch (err) {
            setMessage({ type: 'error', text: err.response?.data?.error || 'Error al vincular práctica' });
        } finally {
            setLoading(false);
        }
    };

    const handleDelete = async (id) => {
        if (!window.confirm('¿Está seguro de eliminar esta práctica del nomenclador?')) return;

        try {
            await axios.delete(`${API_URL}/nomenclador/${id}`);
            fetchPractices();
            fetchGlobalPractices();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al eliminar práctica');
        }
    };

    const handleStartEdit = (p) => {
        setEditingId(p.id);
        setEditCodigo(p.codigo);
        setEditNombre(p.nombre);
        setEditDescripcion(p.descripcion || '');
        setEditPrecio(p.precio);
        setEditCategoria(p.categoria || 'veterinario');
    };

    const handleSaveEdit = async (id) => {
        setLoading(true);
        try {
            await axios.put(`${API_URL}/nomenclador/${id}`, {
                codigo: editCodigo,
                nombre: editNombre,
                descripcion: editDescripcion,
                precio: parseFloat(editPrecio || '0'),
                categoria: editCategoria
            });
            setEditingId(null);
            fetchPractices();
            fetchGlobalPractices();
        } catch (err) {
            alert(err.response?.data?.error || 'Error al actualizar nomenclador');
        } finally {
            setLoading(false);
        }
    };

    const unlinkedPractices = globalPractices.filter(gp => !practices.some(p => p.codigo === gp.codigo && p.categoria === gp.categoria));
    const matchingGlobalPractice = codigo.trim() ? unlinkedPractices.find(p => p.codigo.trim().toLowerCase() === codigo.trim().toLowerCase() && p.categoria === categoria) : null;
    const filteredGlobal = unlinkedPractices.filter(gp => 
        (selectedCategoryFilter === 'todos' || gp.categoria === selectedCategoryFilter) &&
        (gp.codigo.toLowerCase().includes(globalSearch.toLowerCase()) || gp.nombre.toLowerCase().includes(globalSearch.toLowerCase()))
    );
    const filteredPractices = practices.filter(p => selectedCategoryFilter === 'todos' || p.categoria === selectedCategoryFilter);

    const getCategoryBadge = (cat) => {
        const colors = {
            veterinario: { bg: 'rgba(16, 185, 129, 0.15)', border: '#10b981', label: 'Veterinario' },
            radiologo: { bg: 'rgba(59, 130, 246, 0.15)', border: '#3b82f6', label: 'Radiología' },
            bioquimico: { bg: 'rgba(139, 92, 246, 0.15)', border: '#8b5cf6', label: 'Bioquímica' },
            peluquero: { bg: 'rgba(245, 158, 11, 0.15)', border: '#f59e0b', label: 'Peluquería' },
            cobrador: { bg: 'rgba(234, 179, 8, 0.15)', border: '#eab308', label: 'Cobranza / Caja' },
            otro: { bg: 'rgba(107, 114, 128, 0.15)', border: '#6b7280', label: 'Otro' }
        };
        const style = colors[cat] || colors.otro;
        return (
            <span style={{ 
                background: style.bg, 
                border: `1px solid ${style.border}`, 
                color: style.border, 
                fontSize: '0.75rem', 
                padding: '0.15rem 0.5rem',
                borderRadius: '12px',
                fontWeight: 600,
                whiteSpace: 'nowrap'
            }}>
                {style.label}
            </span>
        );
    };

    const isAdmin = currentUser?.rol === 'admin' || currentUser?.rol === 'superadmin' || currentUser?.rol === 'recepcion';
    const canEditPracticeMetadata = (p) => currentUser?.rol === 'superadmin' || p.tipo === 'privada';

    return (
        <div className="body-content" style={{ overflowY: 'auto', maxHeight: 'calc(100vh - 100px)' }}>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem' }}>
                <div>
                    <h1>Nomenclador de Prácticas</h1>
                    <p style={{ color: 'var(--text-dim)' }}>Listado arancelario de prácticas, prestaciones y tratamientos dentales o médicos</p>
                </div>
                {isAdmin && (
                    <button
                        onClick={() => {
                            setMessage({ type: '', text: '' });
                            setCodigo('');
                            setNombre('');
                            setDescripcion('');
                            setPrecio('');
                            setCategoria('veterinario');
                            setShowModal(true);
                        }}
                        className="btn btn-primary"
                        style={{ display: 'flex', alignItems: 'center', gap: '8px', width: 'auto', padding: '0.6rem 1.2rem' }}
                    >
                        <Plus size={18} />
                        Nueva Práctica
                    </button>
                )}
            </div>

            {/* CATEGORY TABS / FILTER */}
            <div style={{ display: 'flex', gap: '0.5rem', marginBottom: '1.5rem', flexWrap: 'wrap', alignItems: 'center' }}>
                <span style={{ color: 'var(--text-dim)', fontSize: '0.85rem', marginRight: '0.5rem' }}>Filtrar por Especialidad:</span>
                {[
                    { id: 'todos', label: 'Todos' },
                    { id: 'veterinario', label: 'Veterinario' },
                    { id: 'radiologo', label: 'Radiología' },
                    { id: 'bioquimico', label: 'Bioquímica' },
                    { id: 'peluquero', label: 'Peluquería' },
                    { id: 'cobrador', label: 'Cobranza / Caja' },
                    { id: 'otro', label: 'Otros' }
                ].map(tab => (
                    <button
                        key={tab.id}
                        type="button"
                        onClick={() => setSelectedCategoryFilter(tab.id)}
                        className={`btn ${selectedCategoryFilter === tab.id ? 'btn-primary' : 'btn-secondary'}`}
                        style={{ 
                            padding: '0.3rem 0.8rem', 
                            fontSize: '0.8rem', 
                            minHeight: 'auto', 
                            width: 'auto',
                            borderRadius: '20px',
                            border: selectedCategoryFilter === tab.id ? 'none' : '1px solid var(--border-color)',
                            background: selectedCategoryFilter === tab.id ? 'var(--primary-color)' : 'transparent',
                            color: selectedCategoryFilter === tab.id ? '#fff' : 'var(--text-dim)',
                            cursor: 'pointer'
                        }}
                    >
                        {tab.label}
                    </button>
                ))}
            </div>

            {isAdmin && (
                <div className="users-list-card" style={{ marginBottom: '2rem' }}>
                    <h2>Prácticas Disponibles en la Red (Catálogo General)</h2>
                    <p style={{ color: 'var(--text-dim)', fontSize: '0.85rem', marginBottom: '1.2rem' }}>
                        Si otra clínica ya registró una práctica en su nomenclador, búscala aquí y habilítala en tu institución ingresando tu precio arancelario.
                    </p>
                    
                    <div className="form-group" style={{ maxWidth: '400px', marginBottom: '1.5rem' }}>
                        <input 
                            type="text" 
                            className="input-field" 
                            placeholder="Buscar por código o nombre..." 
                            value={globalSearch} 
                            onChange={e => setGlobalSearch(e.target.value)} 
                        />
                    </div>

                    {filteredGlobal.length === 0 ? (
                        <p style={{ fontSize: '0.85rem', color: 'var(--text-dim)', padding: '1rem', textAlign: 'center' }}>
                            No hay más prácticas disponibles en esta especialidad para importar.
                        </p>
                    ) : (
                        <div style={{ overflowX: 'auto' }}>
                            <table className="user-table" style={{ fontSize: '0.85rem' }}>
                                <thead>
                                    <tr>
                                        <th style={{ width: '15%' }}>Código</th>
                                        <th style={{ width: '15%' }}>Categoría</th>
                                        <th style={{ width: '25%' }}>Nombre</th>
                                        <th style={{ width: '25%' }}>Descripción</th>
                                        <th style={{ width: '20%', textAlign: 'right' }}>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {filteredGlobal.map(gp => {
                                        const inputId = `price-gp-${gp.id}`;
                                        return (
                                            <tr key={gp.id}>
                                                <td style={{ fontWeight: 600, color: '#fff' }}>{gp.codigo}</td>
                                                <td>{getCategoryBadge(gp.categoria)}</td>
                                                <td>{gp.nombre}</td>
                                                <td style={{ color: 'var(--text-dim)' }}>{gp.descripcion || '-'}</td>
                                                <td style={{ textAlign: 'right' }}>
                                                    <div style={{ display: 'flex', gap: '0.5rem', justifyContent: 'flex-end', alignItems: 'center' }}>
                                                        <input 
                                                            type="number"
                                                            placeholder="Precio ($)"
                                                            className="input-field"
                                                            style={{ padding: '0.2rem 0.4rem', minHeight: 'auto', width: '100px', fontSize: '0.8rem', margin: 0 }}
                                                            id={inputId}
                                                        />
                                                        <button 
                                                            onClick={() => {
                                                                const priceInput = document.getElementById(inputId);
                                                                const priceVal = priceInput ? priceInput.value : '';
                                                                if (!priceVal) {
                                                                    alert('Por favor, ingresa un precio para vincular la práctica.');
                                                                    return;
                                                                }
                                                                handleLinkPractice(gp, priceVal);
                                                            }}
                                                            className="btn btn-secondary"
                                                            style={{ padding: '0.2rem 0.6rem', fontSize: '0.75rem', minHeight: 'auto', width: 'auto' }}
                                                            disabled={loading}
                                                        >
                                                            Habilitar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        );
                                    })}
                                </tbody>
                            </table>
                        </div>
                    )}
                </div>
            )}

            <div className="users-list-card">
                <h2>Catálogo de Prestaciones Habilitadas</h2>
                <div style={{ overflowX: 'auto', marginTop: '1rem' }}>
                    <table className="user-table">
                        <thead>
                            <tr>
                                <th style={{ width: '10%' }}>Código</th>
                                <th style={{ width: '10%' }}>Tipo</th>
                                <th style={{ width: '15%' }}>Categoría</th>
                                <th style={{ width: '20%' }}>Nombre</th>
                                <th style={{ width: '20%' }}>Descripción</th>
                                <th style={{ width: '15%' }}>Precio</th>
                                {isAdmin && <th style={{ width: '10%', textAlign: 'center' }}>Acciones</th>}
                            </tr>
                        </thead>
                        <tbody>
                            {filteredPractices.length === 0 ? (
                                <tr>
                                    <td colSpan={isAdmin ? 6 : 5} style={{ textAlign: 'center', padding: '2rem', color: 'var(--text-dim)' }}>
                                        No hay prácticas cargadas en esta categoría.
                                    </td>
                                </tr>
                            ) : (
                                filteredPractices.map(p => (
                                    <tr key={p.id}>
                                        <td>
                                            {editingId === p.id && canEditPracticeMetadata(p) ? (
                                                <input 
                                                    type="text" 
                                                    className="input-field"
                                                    value={editCodigo} 
                                                    onChange={(e) => setEditCodigo(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto' }}
                                                />
                                            ) : p.codigo}
                                        </td>
                                        <td>
                                            <span style={{
                                                background: p.tipo === 'privada' ? 'rgba(239, 68, 68, 0.15)' : 'rgba(16, 185, 129, 0.15)',
                                                border: p.tipo === 'privada' ? '1px solid #ef4444' : '1px solid #10b981',
                                                color: p.tipo === 'privada' ? '#ef4444' : '#10b981',
                                                fontSize: '0.75rem',
                                                padding: '0.15rem 0.5rem',
                                                borderRadius: '12px',
                                                fontWeight: 600
                                            }}>
                                                {p.tipo === 'privada' ? 'Privada' : 'Pública'}
                                            </span>
                                        </td>
                                        <td>
                                            {editingId === p.id && canEditPracticeMetadata(p) ? (
                                                <select 
                                                    className="input-field"
                                                    value={editCategoria} 
                                                    onChange={(e) => setEditCategoria(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.85rem' }}
                                                >
                                                    <option value="veterinario">Veterinario</option>
                                                    <option value="radiologo">Radiología</option>
                                                    <option value="bioquimico">Bioquímica</option>
                                                    <option value="peluquero">Peluquería</option>
                                                    <option value="cobrador">Cobranza / Caja</option>
                                                    <option value="otro">Otro</option>
                                                </select>
                                            ) : getCategoryBadge(p.categoria)}
                                        </td>
                                        <td>
                                            {editingId === p.id && canEditPracticeMetadata(p) ? (
                                                <input 
                                                    type="text" 
                                                    className="input-field"
                                                    value={editNombre} 
                                                    onChange={(e) => setEditNombre(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto' }}
                                                />
                                            ) : p.nombre}
                                        </td>
                                        <td>
                                            {editingId === p.id && canEditPracticeMetadata(p) ? (
                                                <input 
                                                    type="text" 
                                                    className="input-field"
                                                    value={editDescripcion} 
                                                    onChange={(e) => setEditDescripcion(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto' }}
                                                />
                                            ) : p.descripcion || '-'}
                                        </td>
                                        <td>
                                            {editingId === p.id ? (
                                                <input 
                                                    type="number" 
                                                    className="input-field"
                                                    value={editPrecio} 
                                                    onChange={(e) => setEditPrecio(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto' }}
                                                />
                                            ) : (
                                                <span style={{ fontWeight: 600, color: 'var(--primary)' }}>
                                                    ${parseFloat(p.precio).toLocaleString('es-AR', { minimumFractionDigits: 2 })}
                                                </span>
                                            )}
                                        </td>
                                        {isAdmin && (
                                            <td>
                                                {editingId === p.id ? (
                                                    <div style={{ display: 'flex', gap: '0.3rem', justifyContent: 'center' }}>
                                                        <button 
                                                            onClick={() => handleSaveEdit(p.id)} 
                                                            className="btn btn-primary" 
                                                            style={{ padding: '0.3rem', minHeight: 'auto', background: '#10b981', borderColor: '#10b981' }}
                                                            title="Guardar"
                                                            disabled={loading}
                                                        >
                                                            <Check size={14} />
                                                        </button>
                                                        <button 
                                                            onClick={() => setEditingId(null)} 
                                                            className="btn btn-secondary" 
                                                            style={{ padding: '0.3rem', minHeight: 'auto' }}
                                                            title="Cancelar"
                                                        >
                                                            <X size={14} />
                                                        </button>
                                                    </div>
                                                ) : (
                                                    <div style={{ display: 'flex', gap: '0.3rem', justifyContent: 'center' }}>
                                                        <button 
                                                            onClick={() => handleStartEdit(p)}
                                                            className="btn btn-primary"
                                                            style={{ padding: '0.3rem', minHeight: 'auto', background: '#3b82f6', borderColor: '#3b82f6' }}
                                                            title="Editar"
                                                        >
                                                            <Edit2 size={14} />
                                                        </button>
                                                        <button 
                                                            onClick={() => handleDelete(p.id)}
                                                            className="delete-btn"
                                                            style={{ padding: '0.3rem', minHeight: 'auto' }}
                                                            title="Eliminar"
                                                        >
                                                            <Trash2 size={14} />
                                                        </button>
                                                    </div>
                                                )}
                                            </td>
                                        )}
                                    </tr>
                                ))
                            )}
                        </tbody>
                    </table>
                </div>
            </div>

            {/* MODAL PARA AGREGAR NUEVA PRÁCTICA */}
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
                        maxWidth: '550px',
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
                        
                        <h2 style={{ display: 'flex', alignItems: 'center', gap: '8px', marginBottom: '1.5rem' }}>
                            <Sparkles size={18} color="var(--primary)" />
                            Nueva Práctica / Prestación
                        </h2>
                        
                        <form onSubmit={handleCreate} className="login-form" style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Código Arancelario *</label>
                                <input 
                                    type="text" 
                                    className="input-field"
                                    value={codigo} 
                                    onChange={(e) => setCodigo(e.target.value)} 
                                    placeholder="Ej: 02.01"
                                    required 
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Nombre *</label>
                                <input 
                                    type="text" 
                                    className="input-field"
                                    value={nombre} 
                                    onChange={(e) => setNombre(e.target.value)} 
                                    placeholder="Ej: Tratamiento de Conducto"
                                    required 
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Precio ($) *</label>
                                <input 
                                    type="number" 
                                    className="input-field"
                                    value={precio} 
                                    onChange={(e) => setPrecio(e.target.value)} 
                                    placeholder="Ej: 25000"
                                    required 
                                />
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Categoría</label>
                                <select 
                                    className="input-field"
                                    value={categoria} 
                                    onChange={(e) => setCategoria(e.target.value)} 
                                    style={{ background: 'var(--bg-card)', color: '#fff', border: '1px solid var(--border-color)', height: '42px' }}
                                >
                                    <option value="veterinario">Veterinario</option>
                                    <option value="radiologo">Radiología</option>
                                    <option value="bioquimico">Bioquímica</option>
                                    <option value="peluquero">Peluquería</option>
                                    <option value="cobrador">Cobranza / Caja</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div className="form-group" style={{ marginBottom: 0 }}>
                                <label>Tipo de Práctica</label>
                                <select 
                                    className="input-field"
                                    value={tipo} 
                                    onChange={(e) => setTipo(e.target.value)} 
                                    style={{ background: 'var(--bg-card)', color: '#fff', border: '1px solid var(--border-color)', height: '42px' }}
                                >
                                    <option value="publica">Pública (Catálogo general de la red)</option>
                                    <option value="privada">Privada (Solo para mi clínica)</option>
                                </select>
                            </div>
                            <div className="form-group" style={{ gridColumn: 'span 2', marginBottom: 0 }}>
                                <label>Descripción</label>
                                <input 
                                    type="text" 
                                    className="input-field"
                                    value={descripcion} 
                                    onChange={(e) => setDescripcion(e.target.value)} 
                                    placeholder="Ej: Limpieza profunda de sarro..."
                                />
                            </div>

                            {matchingGlobalPractice && (
                                <div style={{ 
                                    gridColumn: '1 / -1',
                                    padding: '0.8rem', 
                                    background: 'rgba(59, 130, 246, 0.1)', 
                                    border: '1px solid #3b82f6', 
                                    borderRadius: '8px',
                                    fontSize: '0.85rem',
                                    display: 'flex', 
                                    justifyContent: 'space-between', 
                                    alignItems: 'center',
                                    gap: '10px',
                                    marginTop: '0.5rem'
                                }}>
                                    <span>
                                        💡 El código <strong>{matchingGlobalPractice.codigo}</strong> ya existe globalmente en la categoría <strong>{matchingGlobalPractice.categoria}</strong> como <strong>{matchingGlobalPractice.nombre}</strong>. ¿Deseas agregarlo a tu clínica con el precio ingresado?
                                    </span>
                                    <button 
                                        type="button"
                                        className="btn btn-primary"
                                        style={{ padding: '0.3rem 0.8rem', fontSize: '0.75rem', width: 'auto', minHeight: 'auto' }}
                                        onClick={() => handleLinkPractice(matchingGlobalPractice, precio)}
                                        disabled={loading || !precio}
                                    >
                                        Vincular
                                    </button>
                                </div>
                            )}

                            {message.text && (
                                <div className={message.type === 'success' ? 'success-msg' : 'login-error'} style={{ gridColumn: 'span 2', marginTop: '0.5rem' }}>
                                    {message.text}
                                </div>
                            )}

                            <div style={{ gridColumn: 'span 2', display: 'flex', justifyContent: 'flex-end', gap: '0.5rem', marginTop: '1rem' }}>
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
                                    Agregar Práctica
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Nomenclature;
