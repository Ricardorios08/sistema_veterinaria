import React, { useState } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { Check, Info } from 'lucide-react';

const Odontograma = ({ pacienteId, odontogramaData = [], onUpdate, isReadOnly = false }) => {
    const [selectedTooth, setSelectedTooth] = useState(null);
    const [selectedFace, setSelectedFace] = useState(null);
    const [selectedState, setSelectedState] = useState('sano');
    const [notas, setNotas] = useState('');
    const [submitting, setSubmitting] = useState(false);

    // Tooth numbering (FDI system)
    // Upper jaw (left-to-right from viewer's perspective: 18 to 11, then 21 to 28)
    const upperJawRight = [18, 17, 16, 15, 14, 13, 12, 11];
    const upperJawLeft = [21, 22, 23, 24, 25, 26, 27, 28];
    // Lower jaw (left-to-right from viewer's perspective: 48 to 41, then 31 to 38)
    const lowerJawRight = [48, 47, 46, 45, 44, 43, 42, 41];
    const lowerJawLeft = [31, 32, 33, 34, 35, 36, 37, 38];

    // Helper to get state of a specific tooth and face
    const getFaceState = (toothNum, face) => {
        const found = odontogramaData.find(item => item.diente_numero === toothNum && item.cara === face);
        return found ? found.estado : 'sano';
    };

    // Helper to get notes of a tooth/face
    const getFaceNotes = (toothNum, face) => {
        const found = odontogramaData.find(item => item.diente_numero === toothNum && item.cara === face);
        return found ? found.notas : '';
    };

    // Colors mapping
    const colors = {
        sano: 'rgba(255, 255, 255, 0.1)',
        caries: '#ef4444',     // Red
        tratado: '#3b82f6',    // Blue
        corona: '#fbbf24',     // Gold
        ausente: '#475569',    // Dark Slate
        filtrado: '#f97316'    // Orange
    };

    const handleSelectFace = (toothNum, face) => {
        if (isReadOnly) return;
        setSelectedTooth(toothNum);
        setSelectedFace(face);
        const currentState = getFaceState(toothNum, face);
        setSelectedState(currentState);
        setNotas(getFaceNotes(toothNum, face) || '');
    };

    const handleSaveState = async () => {
        if (!selectedTooth || !selectedFace) return;
        setSubmitting(true);

        try {
            await axios.post(`${API_URL}/pacientes/${pacienteId}/odontograma`, {
                diente_numero: selectedTooth,
                cara: selectedFace,
                estado: selectedState,
                notas: notas
            });
            setSelectedTooth(null);
            setSelectedFace(null);
            setNotas('');
            if (onUpdate) onUpdate();
        } catch (err) {
            alert('Error al guardar el estado en el odontograma');
        } finally {
            setSubmitting(false);
        }
    };

    // Sub-component to render interactive Tooth SVG
    const Tooth = ({ number }) => {
        const isAusente = getFaceState(number, 'general') === 'ausente';

        return (
            <div style={{ 
                display: 'flex', 
                flexDirection: 'column', 
                alignItems: 'center', 
                padding: '0.4rem', 
                background: 'rgba(255, 255, 255, 0.02)', 
                border: '1px solid var(--border)', 
                borderRadius: '8px', 
                width: '60px',
                position: 'relative'
            }}>
                <span style={{ fontSize: '0.75rem', fontWeight: 600, marginBottom: '0.25rem', color: 'var(--text-dim)' }}>
                    {number}
                </span>

                {/* Tooth SVG */}
                <svg width="40" height="40" viewBox="0 0 40 40" style={{ cursor: 'pointer', overflow: 'visible' }}>
                    {isAusente ? (
                        // Render a crossed-out look if tooth is missing
                        <>
                            <line x1="0" y1="0" x2="40" y2="40" stroke="#ef4444" strokeWidth="3" />
                            <line x1="40" y1="0" x2="0" y2="40" stroke="#ef4444" strokeWidth="3" />
                            <text x="5" y="25" fill="#94a3b8" fontSize="9" fontWeight="bold">AUS</text>
                        </>
                    ) : (
                        <>
                            {/* Top (Vestibular) */}
                            <polygon 
                                points="0,0 40,0 28,12 12,12" 
                                fill={colors[getFaceState(number, 'vestibular')]} 
                                stroke="#555" 
                                strokeWidth="0.8" 
                                onClick={() => handleSelectFace(number, 'vestibular')}
                                style={{ transition: 'all 0.2s' }}
                            />
                            {/* Right (Distal / Mesial) */}
                            <polygon 
                                points="40,0 40,40 28,28 28,12" 
                                fill={colors[getFaceState(number, 'derecha')]} 
                                stroke="#555" 
                                strokeWidth="0.8" 
                                onClick={() => handleSelectFace(number, 'derecha')}
                                style={{ transition: 'all 0.2s' }}
                            />
                            {/* Bottom (Lingual / Palatina) */}
                            <polygon 
                                points="0,40 40,40 28,28 12,28" 
                                fill={colors[getFaceState(number, 'lingual')]} 
                                stroke="#555" 
                                strokeWidth="0.8" 
                                onClick={() => handleSelectFace(number, 'lingual')}
                                style={{ transition: 'all 0.2s' }}
                            />
                            {/* Left (Mesial / Distal) */}
                            <polygon 
                                points="0,0 0,40 12,28 12,12" 
                                fill={colors[getFaceState(number, 'izquierda')]} 
                                stroke="#555" 
                                strokeWidth="0.8" 
                                onClick={() => handleSelectFace(number, 'izquierda')}
                                style={{ transition: 'all 0.2s' }}
                            />
                            {/* Center (Oclusal) */}
                            <polygon 
                                points="12,12 28,12 28,28 12,28" 
                                fill={colors[getFaceState(number, 'oclusal')]} 
                                stroke="#555" 
                                strokeWidth="0.8" 
                                onClick={() => handleSelectFace(number, 'oclusal')}
                                style={{ transition: 'all 0.2s' }}
                            />
                        </>
                    )}
                </svg>

                {/* Option to set whole tooth as missing */}
                <button 
                    onClick={() => handleSelectFace(number, 'general')}
                    style={{ 
                        marginTop: '0.4rem', 
                        fontSize: '0.6rem', 
                        padding: '1px 4px', 
                        borderRadius: '4px',
                        background: isAusente ? '#10b981' : 'rgba(255,255,255,0.05)',
                        color: '#fff',
                        border: 'none',
                        cursor: 'pointer'
                    }}
                >
                    {isAusente ? 'Poner Sano' : 'Ausente'}
                </button>
            </div>
        );
    };

    return (
        <div style={{ marginTop: '1.5rem' }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', marginBottom: '1.5rem', background: 'rgba(59, 130, 246, 0.05)', padding: '1rem', borderRadius: '8px', border: '1px dashed rgba(59, 130, 246, 0.2)' }}>
                <Info size={18} color="var(--primary)" />
                <span style={{ fontSize: '0.85rem', color: 'var(--text-dim)' }}>
                    <strong>Odontograma Interactivo:</strong> Haz clic en cualquier cara (arriba, derecha, abajo, izquierda, centro) o en el botón "Ausente" de una pieza dental para ver o modificar su estado clínico.
                </span>
            </div>

            {/* ODONTOGRAM MAP */}
            <div className="odontograma-map" style={{ display: 'flex', flexDirection: 'column', gap: '2rem', overflowX: 'auto', paddingBottom: '1rem' }}>
                
                {/* UPPER JAW */}
                <div>
                    <h3 style={{ fontSize: '0.9rem', marginBottom: '0.5rem', color: 'var(--primary)' }}>Arcada Superior</h3>
                    <div style={{ display: 'flex', gap: '0.5rem', justifyContent: 'center' }}>
                        {/* Upper Right Quadrant (18 - 11) */}
                        <div style={{ display: 'flex', gap: '0.3rem' }}>
                            {upperJawRight.map(num => <Tooth key={num} number={num} />)}
                        </div>
                        {/* Divider */}
                        <div style={{ width: '2px', background: 'var(--border)', margin: '0 0.5rem' }}></div>
                        {/* Upper Left Quadrant (21 - 28) */}
                        <div style={{ display: 'flex', gap: '0.3rem' }}>
                            {upperJawLeft.map(num => <Tooth key={num} number={num} />)}
                        </div>
                    </div>
                </div>

                {/* LOWER JAW */}
                <div>
                    <h3 style={{ fontSize: '0.9rem', marginBottom: '0.5rem', color: 'var(--primary)' }}>Arcada Inferior</h3>
                    <div style={{ display: 'flex', gap: '0.5rem', justifyContent: 'center' }}>
                        {/* Lower Right Quadrant (48 - 41) */}
                        <div style={{ display: 'flex', gap: '0.3rem' }}>
                            {lowerJawRight.map(num => <Tooth key={num} number={num} />)}
                        </div>
                        {/* Divider */}
                        <div style={{ width: '2px', background: 'var(--border)', margin: '0 0.5rem' }}></div>
                        {/* Lower Left Quadrant (31 - 38) */}
                        <div style={{ display: 'flex', gap: '0.3rem' }}>
                            {lowerJawLeft.map(num => <Tooth key={num} number={num} />)}
                        </div>
                    </div>
                </div>
            </div>

            {/* EDIT STATE MODAL / DRAWER */}
            {selectedTooth && (
                <div style={{ 
                    position: 'fixed', 
                    top: 0, left: 0, right: 0, bottom: 0, 
                    background: 'rgba(0,0,0,0.6)', 
                    display: 'flex', 
                    justifyContent: 'center', 
                    alignItems: 'center',
                    zIndex: 1000,
                    backdropFilter: 'blur(4px)'
                }}>
                    <div className="user-form-card" style={{ width: '90%', maxWidth: '450px', background: '#0f111a', border: '1px solid var(--border)' }}>
                        <h2>Editar Pieza #{selectedTooth} - Cara: <span style={{ textTransform: 'uppercase', color: 'var(--primary)' }}>{selectedFace}</span></h2>
                        
                        <div className="form-group" style={{ marginTop: '1.5rem' }}>
                            <label>Estado Clínico</label>
                            <select 
                                className="input-field" 
                                value={selectedState} 
                                onChange={(e) => setSelectedState(e.target.value)}
                            >
                                <option value="sano">Sano / Sin anomalías (Verde/Transparente)</option>
                                <option value="caries">Caries Activa (Rojo)</option>
                                <option value="tratado">Pieza Tratada / Obturada (Azul)</option>
                                <option value="corona">Corona / Perno (Amarillo)</option>
                                <option value="filtrado">Caries Filtrada (Naranja)</option>
                                <option value="ausente">Pieza Ausente / Extraída (Gris)</option>
                            </select>
                        </div>

                        <div className="form-group">
                            <label>Observaciones / Diagnóstico</label>
                            <textarea 
                                className="input-field" 
                                rows="3"
                                value={notas}
                                onChange={(e) => setNotas(e.target.value)}
                                placeholder="Escribe notas adicionales sobre esta pieza..."
                                style={{ resize: 'none', padding: '0.5rem', fontSize: '0.85rem' }}
                            />
                        </div>

                        <div style={{ display: 'flex', gap: '1rem', marginTop: '1.5rem', justifyContent: 'flex-end' }}>
                            <button 
                                onClick={() => { setSelectedTooth(null); setSelectedFace(null); }} 
                                className="btn" 
                                style={{ width: 'auto', padding: '0.5rem 1.5rem' }}
                            >
                                Cancelar
                            </button>
                            <button 
                                onClick={handleSaveState} 
                                className="btn btn-primary" 
                                style={{ width: 'auto', padding: '0.5rem 1.5rem', background: '#10b981', borderColor: '#10b981' }}
                                disabled={submitting}
                            >
                                {submitting ? 'Guardando...' : 'Guardar Estado'}
                            </button>
                        </div>
                    </div>
                </div>
            )}
        </div>
    );
};

export default Odontograma;
