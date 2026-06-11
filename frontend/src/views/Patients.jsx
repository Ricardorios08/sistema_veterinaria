import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import Odontograma from '../components/Odontograma';
import { Search, Plus, UserPlus, FileText, ChevronLeft, Phone, Calendar, Heart, ShieldAlert, Award, Clipboard, Edit2 } from 'lucide-react';

const Patients = ({ activePatientId, setActivePatientId, initialTab = 'info', openHcModalOnLoad = false, setOpenHcModalOnLoad, activeTurnoId, setActiveTurnoId, onReturnToWaitingList, onClose }) => {
    const [patients, setPatients] = useState([]);
    const [searchQuery, setSearchQuery] = useState('');
    const [selectedPatient, setSelectedPatient] = useState(null);
    const [activeTab, setActiveTab] = useState('info'); // 'info', 'odontograma', 'historia'
    const [loading, setLoading] = useState(false);
    const [currentUser, setCurrentUser] = useState(null);

    // Patients CRUD states
    const [showCreateModal, setShowCreateModal] = useState(false);
    const [nombre, setNombre] = useState('');
    const [apellido, setApellido] = useState('');
    const [dni, setDni] = useState('');
    const [telefono, setTelefono] = useState('');
    const [email, setEmail] = useState('');
    const [fechaNacimiento, setFechaNacimiento] = useState('');
    const [coberturaMedica, setCoberturaMedica] = useState('');
    const [numeroAfiliado, setNumeroAfiliado] = useState('');
    const [crudError, setCrudError] = useState('');

    const [obraSocialId, setObraSocialId] = useState('');
    const [obrasSociales, setObrasSociales] = useState([]);

    // Edit states
    const [showEditModal, setShowEditModal] = useState(false);
    const [editNombre, setEditNombre] = useState('');
    const [editApellido, setEditApellido] = useState('');
    const [editDni, setEditDni] = useState('');
    const [editTelefono, setEditTelefono] = useState('');
    const [editEmail, setEditEmail] = useState('');
    const [editFechaNacimiento, setEditFechaNacimiento] = useState('');
    const [editObraSocialId, setEditObraSocialId] = useState('');
    const [editNumeroAfiliado, setEditNumeroAfiliado] = useState('');

    // Clinical History & Odontogram states
    const [history, setHistory] = useState([]);
    const [odontograma, setOdontograma] = useState([]);
    const [nomenclature, setNomenclature] = useState([]);

    // Add medical record state
    const [showHcModal, setShowHcModal] = useState(false);
    const [hcDiagnostico, setHcDiagnostico] = useState('');
    const [hcObservaciones, setHcObservaciones] = useState('');
    const [hcFile, setHcFile] = useState(null); // File upload state
    const [selectedTreatments, setSelectedTreatments] = useState([]); // array of { nomenclador_id, diente_numero, cara, notas }
    const [tempNomencladorId, setTempNomencladorId] = useState('');
    const [tempDiente, setTempDiente] = useState('');
    const [tempCara, setTempCara] = useState('general');
    const [tempNotas, setTempNotas] = useState('');

    // PDF Viewer state
    const [showPdfModal, setShowPdfModal] = useState(false);

    useEffect(() => {
        const userStr = localStorage.getItem('sulb_user');
        if (userStr) {
            try { setCurrentUser(JSON.parse(userStr)); } catch(e){}
        }
        fetchPatients();
        fetchNomenclature();
        fetchObrasSociales();
    }, []);

    useEffect(() => {
        if (activePatientId && patients.length > 0) {
            const match = patients.find(p => p.id === parseInt(activePatientId));
            if (match) {
                setSelectedPatient(match);
                setActiveTab(initialTab || 'info');
                fetchPatientDetails(match.id);
                
                if (openHcModalOnLoad) {
                    setShowHcModal(true);
                    if (setOpenHcModalOnLoad) setOpenHcModalOnLoad(false);
                }
                
                if (setActivePatientId) setActivePatientId(null);
            }
        }
    }, [activePatientId, patients, initialTab, openHcModalOnLoad]);

    const fetchObrasSociales = async () => {
        try {
            const res = await axios.get(`${API_URL}/obras-sociales`);
            setObrasSociales(res.data);
        } catch (e) {
            console.error('Error fetching Obras Sociales:', e);
        }
    };

    const fetchPatients = async (query = '') => {
        setLoading(true);
        try {
            const response = await axios.get(`${API_URL}/pacientes`, {
                params: { query }
            });
            setPatients(response.data);
        } catch (err) {
            console.error('Error fetching patients:', err);
        } finally {
            setLoading(false);
        }
    };

    const fetchNomenclature = async () => {
        try {
            const res = await axios.get(`${API_URL}/nomenclador`);
            setNomenclature(res.data);
        } catch (e) {
            console.error('Error nomenclature:', e);
        }
    };

    const handleSearch = (e) => {
        setSearchQuery(e.target.value);
        fetchPatients(e.target.value);
    };

    const handleCreatePatient = async (e) => {
        e.preventDefault();
        setCrudError('');

        if (!email && !telefono) {
            setCrudError('Debe ingresar al menos un medio de contacto (Email o Teléfono/WhatsApp)');
            return;
        }

        const selectedOs = obrasSociales.find(o => o.id === parseInt(obraSocialId));
        const activeCobertura = selectedOs ? selectedOs.nombre : null;

        try {
            await axios.post(`${API_URL}/pacientes`, {
                nombre,
                apellido,
                dni,
                telefono: telefono || null,
                email: email || null,
                fecha_nacimiento: fechaNacimiento || null,
                cobertura_medica: activeCobertura,
                obra_social_id: obraSocialId ? parseInt(obraSocialId) : null,
                numero_afiliado: numeroAfiliado || null
            });
            
            setShowCreateModal(false);
            // Clear inputs
            setNombre(''); setApellido(''); setDni(''); setTelefono(''); setEmail(''); setFechaNacimiento(''); setObraSocialId(''); setNumeroAfiliado('');
            fetchPatients(searchQuery);
        } catch (err) {
            setCrudError(err.response?.data?.error || 'Error al registrar paciente');
        }
    };

    const handleOpenEditModal = () => {
        setEditNombre(selectedPatient.nombre || '');
        setEditApellido(selectedPatient.apellido || '');
        setEditDni(selectedPatient.dni || '');
        setEditTelefono(selectedPatient.telefono || '');
        setEditEmail(selectedPatient.email || '');
        setEditFechaNacimiento(selectedPatient.fecha_nacimiento ? selectedPatient.fecha_nacimiento.substring(0, 10) : '');
        setEditObraSocialId(selectedPatient.obra_social_id || '');
        setEditNumeroAfiliado(selectedPatient.numero_afiliado || '');
        setCrudError('');
        setShowEditModal(true);
    };

    const handleEditPatient = async (e) => {
        e.preventDefault();
        setCrudError('');

        if (!editEmail && !editTelefono) {
            setCrudError('Debe ingresar al menos un medio de contacto (Email o Teléfono/WhatsApp)');
            return;
        }

        const selectedOs = obrasSociales.find(o => o.id === parseInt(editObraSocialId));
        const activeCobertura = selectedOs ? selectedOs.nombre : null;

        try {
            await axios.put(`${API_URL}/pacientes/${selectedPatient.id}`, {
                nombre: editNombre,
                apellido: editApellido,
                dni: editDni,
                telefono: editTelefono || null,
                email: editEmail || null,
                fecha_nacimiento: editFechaNacimiento || null,
                cobertura_medica: activeCobertura,
                obra_social_id: editObraSocialId ? parseInt(editObraSocialId) : null,
                numero_afiliado: editNumeroAfiliado || null
            });
            
            setShowEditModal(false);
            const refreshedPatient = {
                ...selectedPatient,
                nombre: editNombre,
                apellido: editApellido,
                dni: editDni,
                telefono: editTelefono,
                email: editEmail,
                fecha_nacimiento: editFechaNacimiento,
                cobertura_medica: activeCobertura,
                obra_social_id: editObraSocialId ? parseInt(editObraSocialId) : null,
                numero_afiliado: editNumeroAfiliado,
                cobertura_medica_nombre: activeCobertura
            };
            setSelectedPatient(refreshedPatient);
            fetchPatients(searchQuery);
        } catch (err) {
            setCrudError(err.response?.data?.error || 'Error al actualizar paciente');
        }
    };

    const handleSelectPatient = async (patient) => {
        setSelectedPatient(patient);
        setActiveTab('info');
        fetchPatientDetails(patient.id);
    };

    const fetchPatientDetails = async (patientId) => {
        try {
            const [hcRes, odRes] = await Promise.all([
                axios.get(`${API_URL}/pacientes/${patientId}/historia`),
                axios.get(`${API_URL}/pacientes/${patientId}/odontograma`)
            ]);
            setHistory(hcRes.data);
            setOdontograma(odRes.data);
        } catch (err) {
            console.error('Error loading patient details:', err);
        }
    };

    // Treatments adding in ficha clinica
    const handleAddTempTreatment = () => {
        if (!tempNomencladorId) return;
        const practice = nomenclature.find(n => n.id === parseInt(tempNomencladorId));
        if (!practice) return;

        setSelectedTreatments([
            ...selectedTreatments,
            {
                nomenclador_id: practice.id,
                nomenclador_nombre: practice.nombre,
                nomenclador_codigo: practice.codigo,
                diente_numero: tempDiente ? parseInt(tempDiente) : null,
                cara: tempCara,
                notas: tempNotas
            }
        ]);

        // Reset temp inputs
        setTempNomencladorId('');
        setTempDiente('');
        setTempCara('general');
        setTempNotas('');
    };

    const handleRemoveTempTreatment = (index) => {
        setSelectedTreatments(selectedTreatments.filter((_, i) => i !== index));
    };

    const handleSaveClinicalRecord = async (e) => {
        e.preventDefault();
        if (!hcDiagnostico) return;

        try {
            const res = await axios.post(`${API_URL}/pacientes/${selectedPatient.id}/historia`, {
                diagnostico: hcDiagnostico,
                observaciones: hcObservaciones,
                tratamientos: selectedTreatments,
                turno_id: activeTurnoId // Linking history to active appointment!
            });

            // Upload file if selected
            if (hcFile && res.data.insertId) {
                const formData = new FormData();
                formData.append('archivo', hcFile);
                await axios.post(`${API_URL}/pacientes/${selectedPatient.id}/historia/${res.data.insertId}/archivos`, formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
            }

            setShowHcModal(false);
            setHcDiagnostico('');
            setHcObservaciones('');
            setHcFile(null);
            setSelectedTreatments([]);
            if (setActiveTurnoId) setActiveTurnoId(null); // Clear context
            fetchPatientDetails(selectedPatient.id);
            
            if (activeTurnoId && onReturnToWaitingList) {
                onReturnToWaitingList();
            }
        } catch (e) {
            alert('Error al registrar la ficha clínica o subir el archivo.');
        }
    };

    const handleAnnulFicha = async (entryId, reason) => {
        try {
            await axios.put(`${API_URL}/pacientes/${selectedPatient.id}/historia/${entryId}/anular`, {
                motivo_anulacion: reason
            });
            alert("Ficha clínica anulada con éxito. Por favor complete la nueva ficha corregida a continuación.");
            // Fetch updated patient details
            fetchPatientDetails(selectedPatient.id);
            // Force/obligate them to write a new record by opening the modal!
            setShowHcModal(true);
        } catch (err) {
            alert(err.response?.data?.error || "Error al anular la ficha clínica.");
        }
    };

    const [pdfBlobUrl, setPdfBlobUrl] = useState(null);
    const [loadingPdf, setLoadingPdf] = useState(false);

    const handleOpenPdf = async () => {
        setLoadingPdf(true);
        setShowPdfModal(true);
        try {
            const res = await axios.get(`${API_URL}/pacientes/${selectedPatient.id}/historia/pdf`, {
                responseType: 'blob'
            });
            const url = window.URL.createObjectURL(new Blob([res.data], { type: 'application/pdf' }));
            setPdfBlobUrl(url);
        } catch (err) {
            alert('Error al generar el PDF. Revise si el paciente tiene historial registrado.');
            setShowPdfModal(false);
        } finally {
            setLoadingPdf(false);
        }
    };

    const handleClosePdf = () => {
        setShowPdfModal(false);
        if (pdfBlobUrl) {
            window.URL.revokeObjectURL(pdfBlobUrl);
            setPdfBlobUrl(null);
        }
    };

    return (
        <div className="body-content" style={{ overflowY: 'auto', maxHeight: 'calc(100vh - 100px)' }}>
            {!selectedPatient ? (
                // PATIENTS LIST VIEW
                <>
                    <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '2rem' }}>
                        <div>
                            <h1>Gestión de Pacientes</h1>
                            <p style={{ color: 'var(--text-dim)' }}>Base de datos unificada de pacientes de la clínica</p>
                        </div>
                        <button onClick={() => setShowCreateModal(true)} className="btn btn-primary" style={{ width: 'auto', padding: '0.6rem 2.5rem' }}>
                            <UserPlus size={18} style={{ marginRight: '0.5rem' }} />
                            Nuevo Paciente
                        </button>
                    </div>

                    {/* SEARCH BAR */}
                    <div className="user-form-card" style={{ padding: '1rem', marginBottom: '1.5rem' }}>
                        <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem' }}>
                            <Search size={20} color="var(--text-dim)" />
                            <input 
                                type="text" 
                                className="input-field" 
                                placeholder="Buscar por Nombre, Apellido o DNI del paciente..." 
                                value={searchQuery}
                                onChange={handleSearch}
                                style={{ marginBottom: 0, border: 'none', background: 'transparent' }}
                            />
                        </div>
                    </div>

                    {/* PATIENTS TABLE */}
                    <div className="users-list-card">
                        <h2>Fichero General</h2>
                        <div style={{ overflowX: 'auto' }}>
                            <table className="user-table">
                                <thead>
                                    <tr>
                                        <th>Paciente</th>
                                        <th>DNI</th>
                                        <th>Teléfono</th>
                                        <th>Cobertura Médica</th>
                                        <th style={{ textAlign: 'center' }}>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {loading ? (
                                        <tr>
                                            <td colSpan="5" style={{ textAlign: 'center', padding: '2rem' }}>Cargando pacientes...</td>
                                        </tr>
                                    ) : patients.length === 0 ? (
                                        <tr>
                                            <td colSpan="5" style={{ textAlign: 'center', padding: '2rem', color: 'var(--text-dim)' }}>
                                                No se encontraron pacientes.
                                            </td>
                                        </tr>
                                    ) : (
                                        patients.map(p => (
                                            <tr key={p.id} style={{ cursor: 'pointer' }} onClick={() => handleSelectPatient(p)}>
                                                <td>
                                                    <span style={{ fontWeight: 600, color: 'var(--primary)' }}>
                                                        {p.apellido}, {p.nombre}
                                                    </span>
                                                </td>
                                                <td>{p.dni}</td>
                                                <td>{p.telefono || '-'}</td>
                                                <td>
                                                    {p.cobertura_medica ? (
                                                        <span className="role-badge municipalidad" style={{ textTransform: 'none' }}>
                                                            {p.cobertura_medica}
                                                        </span>
                                                    ) : '-'}
                                                </td>
                                                <td style={{ textAlign: 'center' }}>
                                                    <button 
                                                        className="btn btn-secondary" 
                                                        style={{ padding: '0.3rem 0.8rem', fontSize: '0.75rem', display: 'inline-flex', alignItems: 'center' }}
                                                    >
                                                        <FileText size={12} style={{ marginRight: '4px' }} />
                                                        Ver ficha
                                                    </button>
                                                </td>
                                            </tr>
                                        ))
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </>
            ) : (
                // PATIENT DETAIL VIEW (TABS)
                <>
                    <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.5rem', flexWrap: 'wrap', gap: '1rem' }}>
                        <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                            <button onClick={() => onClose ? onClose() : setSelectedPatient(null)} className="btn btn-secondary" style={{ width: 'auto', padding: '0.4rem 1rem' }}>
                                <ChevronLeft size={16} />
                                Volver
                            </button>
                            <div>
                                <h1 style={{ margin: 0 }}>
                                    {selectedPatient.apellido}, {selectedPatient.nombre}
                                </h1>
                                <p style={{ color: 'var(--text-dim)', fontSize: '0.85rem' }}>DNI: {selectedPatient.dni}</p>
                            </div>
                        </div>
                        <button onClick={handleOpenEditModal} className="btn btn-secondary" style={{ width: 'auto', padding: '0.5rem 1.5rem', display: 'flex', alignItems: 'center', gap: '6px' }}>
                            <Edit2 size={14} />
                            Editar Datos
                        </button>
                    </div>

                    {/* TABS SELECTOR */}
                    <div style={{ display: 'flex', gap: '1rem', borderBottom: '1px solid var(--border)', marginBottom: '1.5rem' }}>
                        <button 
                            className={`tab-btn ${activeTab === 'info' ? 'active' : ''}`}
                            onClick={() => setActiveTab('info')}
                            style={{
                                padding: '0.75rem 1.5rem',
                                background: 'transparent',
                                border: 'none',
                                borderBottom: activeTab === 'info' ? '2px solid var(--primary)' : '2px solid transparent',
                                color: activeTab === 'info' ? '#fff' : 'var(--text-dim)',
                                cursor: 'pointer',
                                fontWeight: activeTab === 'info' ? 600 : 400
                            }}
                        >
                            Información General
                        </button>
                        <button 
                            className={`tab-btn ${activeTab === 'odontograma' ? 'active' : ''}`}
                            onClick={() => setActiveTab('odontograma')}
                            style={{
                                padding: '0.75rem 1.5rem',
                                background: 'transparent',
                                border: 'none',
                                borderBottom: activeTab === 'odontograma' ? '2px solid var(--primary)' : '2px solid transparent',
                                color: activeTab === 'odontograma' ? '#fff' : 'var(--text-dim)',
                                cursor: 'pointer',
                                fontWeight: activeTab === 'odontograma' ? 600 : 400
                            }}
                        >
                            Odontograma
                        </button>
                        <button 
                            className={`tab-btn ${activeTab === 'historia' ? 'active' : ''}`}
                            onClick={() => setActiveTab('historia')}
                            style={{
                                padding: '0.75rem 1.5rem',
                                background: 'transparent',
                                border: 'none',
                                borderBottom: activeTab === 'historia' ? '2px solid var(--primary)' : '2px solid transparent',
                                color: activeTab === 'historia' ? '#fff' : 'var(--text-dim)',
                                cursor: 'pointer',
                                fontWeight: activeTab === 'historia' ? 600 : 400
                            }}
                        >
                            Historia Clínica
                        </button>
                    </div>

                    {/* TAB CONTENT: GENERAL INFO */}
                    {activeTab === 'info' && (
                        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))', gap: '1.5rem' }}>
                            <div className="users-list-card" style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
                                <h3>Contacto y Datos Básicos</h3>
                                <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
                                    <Phone size={16} color="var(--primary)" />
                                    <span>Teléfono: <strong>{selectedPatient.telefono || 'No registrado'}</strong></span>
                                </div>
                                <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
                                    <Calendar size={16} color="var(--primary)" />
                                    <span>Nacimiento: <strong>{selectedPatient.fecha_nacimiento ? new Date(selectedPatient.fecha_nacimiento).toLocaleDateString('es-AR') : 'No registrado'}</strong></span>
                                </div>
                                <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
                                    <Clipboard size={16} color="var(--primary)" />
                                    <span>Email: <strong>{selectedPatient.email || 'No registrado'}</strong></span>
                                </div>
                            </div>
                            <div className="users-list-card" style={{ display: 'flex', flexDirection: 'column', gap: '1rem' }}>
                                <h3>Cobertura y Obra Social</h3>
                                <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
                                    <Heart size={16} color="var(--primary)" />
                                    <span>Obra Social: <strong>{selectedPatient.cobertura_medica_nombre || selectedPatient.cobertura_medica || 'Particular / Sin cobertura'}</strong></span>
                                </div>
                                <div style={{ display: 'flex', gap: '0.5rem', alignItems: 'center' }}>
                                    <Award size={16} color="var(--primary)" />
                                    <span>Nº Afiliado: <strong>{selectedPatient.numero_afiliado || '-'}</strong></span>
                                </div>
                            </div>
                        </div>
                    )}

                    {/* TAB CONTENT: ODONTOGRAMA */}
                    {activeTab === 'odontograma' && (
                        <div className="users-list-card">
                            <Odontograma 
                                pacienteId={selectedPatient.id} 
                                odontogramaData={odontograma} 
                                onUpdate={() => fetchPatientDetails(selectedPatient.id)}
                                isReadOnly={currentUser?.rol !== 'profesional'}
                            />
                        </div>
                    )}

                    {/* TAB CONTENT: CLINICAL HISTORY */}
                    {activeTab === 'historia' && (
                        <div>
                            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.5rem' }}>
                                <h3>Historial de Visitas y Fichas Médicas</h3>
                                <div style={{ display: 'flex', gap: '1rem' }}>
                                    <button onClick={handleOpenPdf} className="btn" style={{ width: 'auto', padding: '0.5rem 1.5rem', background: 'rgba(255,255,255,0.05)', color: '#fff' }}>
                                        <FileText size={16} style={{ marginRight: '4px' }} />
                                        Imprimir PDF
                                    </button>
                                    {currentUser?.rol === 'profesional' && (
                                        <button onClick={() => setShowHcModal(true)} className="btn btn-primary" style={{ width: 'auto', padding: '0.5rem 1.5rem' }}>
                                            <Plus size={16} style={{ marginRight: '4px' }} />
                                            Nueva Ficha Clínica
                                        </button>
                                    )}
                                </div>
                            </div>

                            {history.length === 0 ? (
                                <div className="users-list-card" style={{ textAlign: 'center', padding: '2.5rem', color: 'var(--text-dim)' }}>
                                    El paciente aún no cuenta con registros en su Historia Clínica.
                                </div>
                            ) : (
                                <div style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem' }}>
                                    {history.map(hc => (
                                        <div 
                                            key={hc.id} 
                                            className="users-list-card" 
                                            style={{ 
                                                borderLeft: hc.anulado === 1 ? '4px solid #ef4444' : '4px solid var(--primary)', 
                                                paddingLeft: '1.5rem',
                                                background: hc.anulado === 1 ? 'rgba(239, 68, 68, 0.01)' : 'rgba(255,255,255,0.01)',
                                                position: 'relative'
                                            }}
                                        >
                                            {/* Top Header bar with time and annul button */}
                                            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.5rem', flexWrap: 'wrap', gap: '8px' }}>
                                                <span style={{ fontSize: '0.8rem', color: 'var(--text-dim)', fontWeight: 600 }}>
                                                    {new Date(hc.fecha).toLocaleString('es-AR')}
                                                </span>
                                                
                                                <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                                    <span style={{ fontSize: '0.8rem', background: 'rgba(255,255,255,0.05)', padding: '2px 8px', borderRadius: '4px' }}>
                                                        Dr/a: {hc.odontologo_nombre}
                                                    </span>

                                                    {/* Annul record button (attending professional only, and not already annulled) */}
                                                    {currentUser?.rol === 'profesional' && hc.odontologo_id === currentUser.id && hc.anulado !== 1 && (
                                                        <button 
                                                            type="button"
                                                            className="delete-btn"
                                                            style={{ 
                                                                padding: '2px 8px', 
                                                                fontSize: '0.7rem', 
                                                                width: 'auto', 
                                                                minHeight: 'auto', 
                                                                display: 'inline-flex', 
                                                                alignItems: 'center', 
                                                                gap: '4px',
                                                                background: 'rgba(239, 68, 68, 0.1)',
                                                                color: '#f87171',
                                                                border: '1px solid rgba(239, 68, 68, 0.2)'
                                                            }}
                                                            onClick={() => {
                                                                const reason = window.prompt("Ingrese el motivo por el cual desea ANULAR esta ficha clínica (este cambio se guardará con baja lógica de auditoría):");
                                                                if (reason && reason.trim()) {
                                                                    handleAnnulFicha(hc.id, reason.trim());
                                                                }
                                                            }}
                                                        >
                                                            <ShieldAlert size={12} />
                                                            Anular Ficha
                                                        </button>
                                                    )}
                                                </div>
                                            </div>

                                            {/* Annul Warning Badge if logically deleted */}
                                            {hc.anulado === 1 && (
                                                <div style={{ 
                                                    display: 'flex', 
                                                    gap: '8px', 
                                                    alignItems: 'center', 
                                                    background: 'rgba(239, 68, 68, 0.08)', 
                                                    color: '#fca5a5', 
                                                    padding: '0.4rem 0.8rem', 
                                                    borderRadius: '6px', 
                                                    fontSize: '0.8rem', 
                                                    marginBottom: '0.8rem', 
                                                    fontWeight: 600,
                                                    border: '1px solid rgba(239, 68, 68, 0.15)' 
                                                }}>
                                                    <ShieldAlert size={14} />
                                                    <span>FICHA ANULADA - Motivo: <em>"{hc.motivo_anulacion}"</em> {hc.fecha_anulacion && `el ${new Date(hc.fecha_anulacion).toLocaleString('es-AR')}`}</span>
                                                </div>
                                            )}

                                            <h4 style={{ margin: '0.5rem 0', color: hc.anulado === 1 ? 'var(--text-dim)' : '#fff', textDecoration: hc.anulado === 1 ? 'line-through' : 'none' }}>
                                                Diagnóstico:
                                            </h4>
                                            <p style={{ 
                                                background: 'rgba(255,255,255,0.02)', 
                                                padding: '0.75rem', 
                                                borderRadius: '6px', 
                                                margin: 0,
                                                color: hc.anulado === 1 ? 'var(--text-dim)' : '#fff',
                                                textDecoration: hc.anulado === 1 ? 'line-through' : 'none'
                                            }}>
                                                {hc.diagnostico}
                                            </p>
                                            
                                            {hc.observaciones && (
                                                <>
                                                    <h4 style={{ margin: '0.75rem 0 0.5rem 0', color: 'var(--text-dim)', textDecoration: hc.anulado === 1 ? 'line-through' : 'none' }}>Observaciones:</h4>
                                                    <p style={{ fontSize: '0.9rem', opacity: hc.anulado === 1 ? 0.4 : 0.8, textDecoration: hc.anulado === 1 ? 'line-through' : 'none' }}>{hc.observaciones}</p>
                                                </>
                                            )}

                                            {hc.tratamientos && hc.tratamientos.length > 0 && (
                                                <div style={{ marginTop: '1rem', opacity: hc.anulado === 1 ? 0.5 : 1 }}>
                                                    <h5 style={{ color: 'var(--primary)', marginBottom: '0.5rem', textDecoration: hc.anulado === 1 ? 'line-through' : 'none' }}>Prácticas / Tratamientos Realizados:</h5>
                                                    <div style={{ display: 'flex', flexWrap: 'wrap', gap: '0.5rem' }}>
                                                        {hc.tratamientos.map(t => (
                                                            <span key={t.id} style={{ 
                                                                fontSize: '0.75rem', 
                                                                background: hc.anulado === 1 ? 'rgba(255,255,255,0.05)' : 'rgba(59, 130, 246, 0.1)', 
                                                                color: hc.anulado === 1 ? 'var(--text-dim)' : '#93c5fd', 
                                                                border: hc.anulado === 1 ? '1px solid rgba(255,255,255,0.1)' : '1px solid rgba(59, 130, 246, 0.2)', 
                                                                padding: '4px 10px', 
                                                                borderRadius: '20px',
                                                                textDecoration: hc.anulado === 1 ? 'line-through' : 'none'
                                                            }}>
                                                                [{t.nomenclador_codigo}] {t.nomenclador_nombre} 
                                                                {t.diente_numero && ` (Pieza #${t.diente_numero}${t.cara !== 'general' ? ` - ${t.cara}` : ''})`}
                                                            </span>
                                                        ))}
                                                    </div>
                                                </div>
                                            )}

                                            {hc.archivos && hc.archivos.length > 0 && (
                                                <div style={{ marginTop: '1rem', opacity: hc.anulado === 1 ? 0.5 : 1 }}>
                                                    <h5 style={{ color: 'var(--primary)', marginBottom: '0.5rem', textDecoration: hc.anulado === 1 ? 'line-through' : 'none' }}>Archivos Adjuntos:</h5>
                                                    <div style={{ display: 'flex', flexWrap: 'wrap', gap: '0.5rem' }}>
                                                        {hc.archivos.map(a => (
                                                            <a 
                                                                key={a.id} 
                                                                href={`${API_URL.replace('/api', '')}${a.ruta_archivo}`} 
                                                                target="_blank" 
                                                                rel="noreferrer"
                                                                style={{ 
                                                                    fontSize: '0.8rem', 
                                                                    background: 'rgba(16, 185, 129, 0.1)', 
                                                                    color: '#34d399', 
                                                                    border: '1px solid rgba(16, 185, 129, 0.2)', 
                                                                    padding: '4px 10px', 
                                                                    borderRadius: '20px',
                                                                    textDecoration: 'none',
                                                                    display: 'flex',
                                                                    alignItems: 'center',
                                                                    gap: '4px'
                                                                }}
                                                            >
                                                                <FileText size={12} />
                                                                {a.nombre_archivo}
                                                            </a>
                                                        ))}
                                                    </div>
                                                </div>
                                            )}
                                        </div>
                                    ))}
                                </div>
                            )}
                        </div>
                    )}
                </>
            )}

            {/* CREATE PACIENTE MODAL */}
            {showCreateModal && (
                <div style={{ 
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, 
                    background: 'rgba(0,0,0,0.6)', display: 'flex', justifyContent: 'center', alignItems: 'center', 
                    zIndex: 1000, backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '90%', maxWidth: '600px', maxHeight: '90vh', overflowY: 'auto' }}>
                        <h2>Registrar Nuevo Paciente</h2>
                        <form onSubmit={handleCreatePatient} className="login-form" style={{ marginTop: '1.5rem', display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                            <div className="form-group">
                                <label>Nombre *</label>
                                <input type="text" className="input-field" value={nombre} onChange={e => setNombre(e.target.value)} required />
                            </div>
                            <div className="form-group">
                                <label>Apellido *</label>
                                <input type="text" className="input-field" value={apellido} onChange={e => setApellido(e.target.value)} required />
                            </div>
                            <div className="form-group">
                                <label>DNI *</label>
                                <input type="text" className="input-field" value={dni} onChange={e => setDni(e.target.value)} required />
                            </div>
                            <div className="form-group">
                                <label>Teléfono</label>
                                <input type="text" className="input-field" value={telefono} onChange={e => setTelefono(e.target.value)} />
                            </div>
                            <div className="form-group">
                                <label>Email</label>
                                <input type="email" className="input-field" value={email} onChange={e => setEmail(e.target.value)} />
                            </div>
                            <div className="form-group">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" className="input-field" value={fechaNacimiento} onChange={e => setFechaNacimiento(e.target.value)} />
                            </div>
                            <div className="form-group">
                                <label>Obra Social / Cobertura</label>
                                <select 
                                    className="input-field" 
                                    value={obraSocialId} 
                                    onChange={e => setObraSocialId(e.target.value)}
                                >
                                    <option value="">Particular / Sin Cobertura</option>
                                    {obrasSociales.map(os => (
                                        <option key={os.id} value={os.id}>
                                            {os.sigla ? `[${os.sigla}] ` : ''}{os.nombre}
                                        </option>
                                    ))}
                                </select>
                            </div>
                            <div className="form-group">
                                <label>Nº Afiliado</label>
                                <input type="text" className="input-field" value={numeroAfiliado} onChange={e => setNumeroAfiliado(e.target.value)} />
                            </div>

                            {crudError && (
                                <div className="login-error" style={{ gridColumn: 'span 2' }}>
                                    {crudError}
                                </div>
                            )}

                            <div style={{ gridColumn: 'span 2', display: 'flex', gap: '1rem', justifyContent: 'flex-end', marginTop: '1rem' }}>
                                <button type="button" onClick={() => setShowCreateModal(false)} className="btn">Cancelar</button>
                                <button type="submit" className="btn btn-primary" style={{ width: 'auto', padding: '0.5rem 2rem' }}>Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            {/* EDIT PACIENTE MODAL */}
            {showEditModal && (
                <div style={{ 
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, 
                    background: 'rgba(0,0,0,0.6)', display: 'flex', justifyContent: 'center', alignItems: 'center', 
                    zIndex: 1000, backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '90%', maxWidth: '600px', maxHeight: '90vh', overflowY: 'auto' }}>
                        <h2>Editar Paciente</h2>
                        <form onSubmit={handleEditPatient} className="login-form" style={{ marginTop: '1.5rem', display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem' }}>
                            <div className="form-group">
                                <label>Nombre *</label>
                                <input type="text" className="input-field" value={editNombre} onChange={e => setEditNombre(e.target.value)} required />
                            </div>
                            <div className="form-group">
                                <label>Apellido *</label>
                                <input type="text" className="input-field" value={editApellido} onChange={e => setEditApellido(e.target.value)} required />
                            </div>
                            <div className="form-group">
                                <label>DNI *</label>
                                <input type="text" className="input-field" value={editDni} onChange={e => setEditDni(e.target.value)} required />
                            </div>
                            <div className="form-group">
                                <label>Teléfono</label>
                                <input type="text" className="input-field" value={editTelefono} onChange={e => setEditTelefono(e.target.value)} />
                            </div>
                            <div className="form-group">
                                <label>Email</label>
                                <input type="email" className="input-field" value={editEmail} onChange={e => setEditEmail(e.target.value)} />
                            </div>
                            <div className="form-group">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" className="input-field" value={editFechaNacimiento} onChange={e => setEditFechaNacimiento(e.target.value)} />
                            </div>
                            <div className="form-group">
                                <label>Obra Social / Cobertura</label>
                                <select 
                                    className="input-field" 
                                    value={editObraSocialId} 
                                    onChange={e => setEditObraSocialId(e.target.value)}
                                >
                                    <option value="">Particular / Sin Cobertura</option>
                                    {obrasSociales.map(os => (
                                        <option key={os.id} value={os.id}>
                                            {os.sigla ? `[${os.sigla}] ` : ''}{os.nombre}
                                        </option>
                                    ))}
                                </select>
                            </div>
                            <div className="form-group">
                                <label>Nº Afiliado</label>
                                <input type="text" className="input-field" value={editNumeroAfiliado} onChange={e => setEditNumeroAfiliado(e.target.value)} />
                            </div>

                            {crudError && (
                                <div className="login-error" style={{ gridColumn: 'span 2' }}>
                                    {crudError}
                                </div>
                            )}

                            <div style={{ gridColumn: 'span 2', display: 'flex', gap: '1rem', justifyContent: 'flex-end', marginTop: '1rem' }}>
                                <button type="button" onClick={() => setShowEditModal(false)} className="btn">Cancelar</button>
                                <button type="submit" className="btn btn-primary" style={{ width: 'auto', padding: '0.5rem 2rem' }}>Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}

            {/* CREATE HC / FICHA CLINICA MODAL */}
            {showHcModal && (
                <div style={{ 
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, 
                    background: 'rgba(0,0,0,0.6)', display: 'flex', justifyContent: 'center', alignItems: 'center', 
                    zIndex: 1000, backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '95%', maxWidth: '750px', maxHeight: '90vh', overflowY: 'auto' }}>
                        <h2>Nueva Ficha Clínica</h2>
                        <form onSubmit={handleSaveClinicalRecord} className="login-form" style={{ marginTop: '1.5rem' }}>
                            
                            <div className="form-group">
                                <label>Diagnóstico / Motivo de Consulta *</label>
                                <input 
                                    type="text" 
                                    className="input-field" 
                                    value={hcDiagnostico} 
                                    onChange={e => setHcDiagnostico(e.target.value)}
                                    placeholder="Ej: Carie dental detectada en pieza 16, dolor leve al frío..."
                                    required 
                                />
                            </div>

                            <div className="form-group">
                                <label>Observaciones Clínicas</label>
                                <textarea 
                                    className="input-field" 
                                    rows="2"
                                    value={hcObservaciones}
                                    onChange={e => setHcObservaciones(e.target.value)}
                                    placeholder="Detalles sobre el examen o el procedimiento..."
                                    style={{ resize: 'none', padding: '0.5rem' }}
                                />
                            </div>

                            <div className="form-group" style={{ marginBottom: '1.5rem' }}>
                                <label>Adjuntar Archivo / Radiografía / Informe (Opcional)</label>
                                <input 
                                    type="file" 
                                    className="input-field" 
                                    onChange={e => setHcFile(e.target.files[0])}
                                    style={{ padding: '0.5rem', background: 'rgba(255,255,255,0.02)', color: 'var(--text-dim)' }}
                                />
                                <small style={{ color: 'var(--text-dim)', marginTop: '4px', display: 'inline-block' }}>Puede subir archivos PDF o imágenes (JPG, PNG).</small>
                            </div>

                            {/* TREATMENT SELECTOR (SUB-FORM) */}
                            <div style={{ border: '1px solid var(--border)', padding: '1rem', borderRadius: '8px', background: 'rgba(255,255,255,0.01)', marginBottom: '1.5rem' }}>
                                <h4 style={{ marginBottom: '1rem', fontSize: '0.9rem', color: 'var(--primary)' }}>Cargar Prácticas del Nomenclador</h4>
                                <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(130px, 1fr))', gap: '0.75rem', marginBottom: '1rem' }}>
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label>Tratamiento</label>
                                        <select 
                                            className="input-field"
                                            value={tempNomencladorId}
                                            onChange={e => setTempNomencladorId(e.target.value)}
                                        >
                                            <option value="">Selecciona práctica...</option>
                                            {nomenclature.map(n => (
                                                <option key={n.id} value={n.id}>[{n.codigo}] {n.nombre}</option>
                                            ))}
                                        </select>
                                    </div>
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label>Diente (Nº)</label>
                                        <input 
                                            type="number" 
                                            className="input-field" 
                                            placeholder="Opcional"
                                            value={tempDiente}
                                            onChange={e => setTempDiente(e.target.value)}
                                        />
                                    </div>
                                    <div className="form-group" style={{ marginBottom: 0 }}>
                                        <label>Cara</label>
                                        <select 
                                            className="input-field"
                                            value={tempCara}
                                            onChange={e => setTempCara(e.target.value)}
                                        >
                                            <option value="general">Pieza General</option>
                                            <option value="vestibular">Vestibular (Arriba)</option>
                                            <option value="lingual">Lingual / Palatina (Abajo)</option>
                                            <option value="derecha">Derecha</option>
                                            <option value="izquierda">Izquierda</option>
                                            <option value="oclusal">Oclusal (Centro)</option>
                                        </select>
                                    </div>
                                    <div className="form-group" style={{ gridColumn: 'span 2', marginBottom: 0 }}>
                                        <label>Notas Práctica</label>
                                        <input 
                                            type="text" 
                                            className="input-field" 
                                            placeholder="Notas de este tratamiento..."
                                            value={tempNotas}
                                            onChange={e => setTempNotas(e.target.value)}
                                        />
                                    </div>
                                    <div style={{ display: 'flex', alignItems: 'flex-end', justifyContent: 'flex-end' }}>
                                        <button 
                                            type="button" 
                                            onClick={handleAddTempTreatment}
                                            className="btn btn-secondary"
                                            style={{ height: '40px', padding: '0 1rem', width: '100%', fontSize: '0.85rem' }}
                                        >
                                            Añadir
                                        </button>
                                    </div>
                                </div>

                                {/* LIST OF TEMP ADDED TREATMENTS */}
                                {selectedTreatments.length > 0 && (
                                    <div style={{ background: '#0a0b10', padding: '0.75rem', borderRadius: '6px', border: '1px solid var(--border)' }}>
                                        <span style={{ fontSize: '0.75rem', fontWeight: 600, color: 'var(--text-dim)', display: 'block', marginBottom: '0.5rem' }}>Prácticas cargadas en la ficha:</span>
                                        <div style={{ display: 'flex', flexDirection: 'column', gap: '0.4rem' }}>
                                            {selectedTreatments.map((t, idx) => (
                                                <div key={idx} style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', background: 'rgba(255,255,255,0.02)', padding: '4px 10px', borderRadius: '4px', fontSize: '0.8rem' }}>
                                                    <span>
                                                        <strong>[{t.nomenclador_codigo}] {t.nomenclador_nombre}</strong> 
                                                        {t.diente_numero && ` (Pieza #${t.diente_numero} - ${t.cara})`}
                                                        {t.notas && ` - ${t.notas}`}
                                                    </span>
                                                    <button 
                                                        type="button" 
                                                        onClick={() => handleRemoveTempTreatment(idx)}
                                                        className="delete-btn"
                                                        style={{ padding: '2px 6px', fontSize: '0.65rem', width: 'auto', minHeight: 'auto' }}
                                                    >
                                                        Quitar
                                                    </button>
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                )}
                            </div>

                            {/* INTEGRATED ODONTOGRAM inside HC Modal */}
                            {(currentUser?.rol === 'profesional' || currentUser?.rol === 'admin' || currentUser?.rol === 'superadmin') && (
                                <div style={{ marginTop: '1.5rem', borderTop: '1px solid var(--border)', paddingTop: '1.5rem', marginBottom: '1.5rem' }}>
                                    <h4 style={{ marginBottom: '1rem', color: 'var(--primary)', fontSize: '0.95rem' }}>Actualizar Odontograma</h4>
                                    <div style={{ background: 'rgba(0,0,0,0.2)', padding: '1rem', borderRadius: '8px', border: '1px solid var(--border)', overflowX: 'auto' }}>
                                        <Odontograma 
                                            pacienteId={selectedPatient.id} 
                                            odontogramaData={odontograma} 
                                            onUpdate={() => fetchPatientDetails(selectedPatient.id)} 
                                        />
                                    </div>
                                </div>
                            )}

                            <div style={{ display: 'flex', gap: '1rem', justifyContent: 'flex-end' }}>
                                <button type="button" onClick={() => { 
                                    setShowHcModal(false); 
                                    setSelectedTreatments([]); 
                                    if (activeTurnoId && onReturnToWaitingList) {
                                        onReturnToWaitingList();
                                    }
                                }} className="btn">Cancelar</button>
                                <button type="submit" className="btn btn-primary" style={{ width: 'auto', padding: '0.5rem 2.5rem', background: '#10b981', borderColor: '#10b981' }}>Registrar Ficha</button>
                            </div>
                        </form>
                    </div>
                </div>
            )}
            {/* PDF VIEWER MODAL */}
            {showPdfModal && (
                <div style={{ 
                    position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, 
                    background: 'rgba(0,0,0,0.8)', 
                    display: 'flex', flexDirection: 'column',
                    justifyContent: 'center', alignItems: 'center', zIndex: 1000,
                    backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '90%', height: '90%', maxWidth: '1000px', display: 'flex', flexDirection: 'column', background: '#0f111a', border: '1px solid var(--border)' }}>
                        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1rem' }}>
                            <h2 style={{ margin: 0, fontSize: '1.2rem', color: 'var(--primary)' }}>Visor PDF - Historia Clínica</h2>
                            <button onClick={handleClosePdf} className="btn" style={{ width: 'auto', padding: '0.4rem 1rem', background: 'rgba(239, 68, 68, 0.2)', color: '#fca5a5' }}>Cerrar Visor</button>
                        </div>
                        <div style={{ flex: 1, background: '#fff', borderRadius: '4px', overflow: 'hidden' }}>
                            {loadingPdf ? (
                                <div style={{ height: '100%', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#333' }}>
                                    Generando documento oficial...
                                </div>
                            ) : pdfBlobUrl ? (
                                <iframe 
                                    src={pdfBlobUrl} 
                                    style={{ width: '100%', height: '100%', border: 'none' }}
                                    title="PDF Historia Clinica"
                                />
                            ) : (
                                <div style={{ height: '100%', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#ef4444' }}>
                                    No se pudo cargar el documento.
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Patients;
