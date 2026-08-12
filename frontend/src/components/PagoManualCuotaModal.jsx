import React, { useState } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { CreditCard, Trash2, Check, Lock, AlertCircle } from 'lucide-react';

const PagoManualCuotaModal = ({ socio, cuota, cobradores = [], onClose, onSuccess }) => {
  const [fechaPago, setFechaPago] = useState(new Date().toISOString().split('T')[0]);
  const [cobrador, setCobrador] = useState(cuota?.cobrador || socio?.cobrador || '10');
  const [importe, setImporte] = useState(cuota?.importe || '0');
  const [contraDelete, setContraDelete] = useState('');
  const [showDeleteSection, setShowDeleteSection] = useState(false);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  if (!cuota) return null;

  const handleAceptar = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError(null);
    try {
      await axios.post(`${API_URL}/socios/pago-manual-individual`, {
        cod_socio: socio.cod_mevep || socio.id,
        nro_boleta: cuota.nro_boleta,
        mes: cuota.mes,
        anio: cuota.anio,
        fecha_pago: fechaPago,
        cobrador,
        importe
      });
      if (onSuccess) onSuccess();
      onClose();
    } catch (err) {
      setError(err.response?.data?.error || 'Error al registrar el pago manual');
    } finally {
      setLoading(false);
    }
  };

  const handleEliminar = async (e) => {
    e.preventDefault();
    if (!contraDelete.trim()) {
      setError('Ingrese la contraseña de seguridad para eliminar la deuda.');
      return;
    }
    setLoading(true);
    setError(null);
    try {
      await axios.post(`${API_URL}/socios/eliminar-deuda`, {
        cod_socio: socio.cod_mevep || socio.id,
        nro_boleta: cuota.nro_boleta,
        mes: cuota.mes,
        anio: cuota.anio,
        contra: contraDelete.trim()
      });
      if (onSuccess) onSuccess();
      onClose();
    } catch (err) {
      setError(err.response?.data?.error || 'Error al eliminar la deuda');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={{
      position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
      background: 'rgba(0,0,0,0.7)', display: 'flex', justifyContent: 'center',
      alignItems: 'center', zIndex: 1100, backdropFilter: 'blur(4px)', padding: '1rem'
    }} onClick={onClose}>
      <div className="user-form-card" style={{
        width: '100%', maxWidth: '550px', margin: 0, padding: '1.8rem',
        background: 'var(--bg, #0f172a)', borderRadius: '12px', border: '1px solid var(--border, #1e293b)'
      }} onClick={e => e.stopPropagation()}>

        {/* Header */}
        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.2rem', borderBottom: '1px solid var(--border, #1e293b)', paddingBottom: '0.8rem' }}>
          <h3 style={{ margin: 0, color: 'var(--primary, #3b82f6)', display: 'flex', alignItems: 'center', gap: '8px' }}>
            <CreditCard size={22} /> Cobrador Pago Manual / Administrar Cuota
          </h3>
          <button className="close-btn" onClick={onClose} style={{ background: 'transparent', border: 'none', color: '#94a3b8', fontSize: '1.5rem', cursor: 'pointer' }}>×</button>
        </div>

        {/* Socio & Cuota Card Header */}
        <div style={{ background: 'rgba(59, 130, 246, 0.08)', border: '1px solid rgba(59, 130, 246, 0.2)', padding: '1rem', borderRadius: '8px', marginBottom: '1.2rem', display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.8rem' }}>
          <div>
            <span style={{ fontSize: '0.75rem', color: '#94a3b8' }}>Socio</span>
            <div style={{ fontWeight: 'bold', color: '#fff', fontSize: '0.95rem' }}>{socio.apellido?.toUpperCase()}, {socio.nombre?.toUpperCase()}</div>
          </div>
          <div>
            <span style={{ fontSize: '0.75rem', color: '#94a3b8' }}>Código MEVEP</span>
            <div style={{ fontWeight: 'bold', color: '#93c5fd', fontSize: '0.95rem' }}>{socio.cod_mevep || socio.id}</div>
          </div>
          <div>
            <span style={{ fontSize: '0.75rem', color: '#94a3b8' }}>Período / Cuota</span>
            <div style={{ fontWeight: 'bold', color: '#fbbf24', fontSize: '1rem' }}>{cuota.mes}/{cuota.anio}</div>
          </div>
          <div>
            <span style={{ fontSize: '0.75rem', color: '#94a3b8' }}>N° Boleta</span>
            <div style={{ fontWeight: 'bold', color: '#cbd5e1', fontSize: '0.95rem' }}>{cuota.nro_boleta || '—'}</div>
          </div>
        </div>

        {error && (
          <div style={{ background: 'rgba(239, 68, 68, 0.1)', border: '1px solid #ef4444', color: '#fca5a5', padding: '0.6rem 1rem', borderRadius: '6px', marginBottom: '1rem', fontSize: '0.85rem', display: 'flex', alignItems: 'center', gap: '6px' }}>
            <AlertCircle size={16} />
            {error}
          </div>
        )}

        {/* Formulario de Pago Manual */}
        <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem', marginBottom: '1.2rem' }}>
          <div>
            <label style={{ fontSize: '0.8rem', color: '#94a3b8', fontWeight: 'bold', marginBottom: '0.3rem', display: 'block' }}>Fecha de Pago:</label>
            <input
              type="date"
              className="input-field"
              value={fechaPago}
              onChange={e => setFechaPago(e.target.value)}
              style={{ width: '100%', margin: 0, padding: '0.5rem', fontSize: '0.85rem' }}
            />
          </div>
          <div>
            <label style={{ fontSize: '0.8rem', color: '#94a3b8', fontWeight: 'bold', marginBottom: '0.3rem', display: 'block' }}>Importe ($):</label>
            <input
              type="number"
              step="0.01"
              className="input-field"
              value={importe}
              onChange={e => setImporte(e.target.value)}
              style={{ width: '100%', margin: 0, padding: '0.5rem', fontSize: '0.85rem' }}
            />
          </div>
          <div style={{ gridColumn: 'span 2' }}>
            <label style={{ fontSize: '0.8rem', color: '#94a3b8', fontWeight: 'bold', marginBottom: '0.3rem', display: 'block' }}>Cobrador:</label>
            <select
              className="input-field"
              value={cobrador}
              onChange={e => setCobrador(e.target.value)}
              style={{ width: '100%', margin: 0, padding: '0.5rem', fontSize: '0.85rem' }}
            >
              {cobradores.length > 0 ? (
                cobradores.map(cob => (
                  <option key={cob.cod_cobrador} value={cob.cod_cobrador}>
                    {cob.cod_cobrador} - {cob.nombre_cobrador}
                  </option>
                ))
              ) : (
                <>
                  <option value="10">10 - LOCAL</option>
                  <option value="11">11 - DANIEL</option>
                  <option value="12">12 - JORGE</option>
                  <option value="13">13 - GUSTAVO</option>
                  <option value="14">14 - RICARDO</option>
                </>
              )}
            </select>
          </div>
        </div>

        {/* Action Buttons: ACEPTAR (Cobrar) */}
        <div style={{ display: 'flex', gap: '0.8rem', marginBottom: '1.2rem' }}>
          <button
            type="button"
            onClick={handleAceptar}
            disabled={loading}
            className="btn btn-primary"
            style={{ flex: 1, background: '#10b981', borderColor: '#10b981', display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '6px', fontWeight: 'bold' }}
          >
            <Check size={16} />
            {loading ? 'Procesando...' : 'ACEPTAR (Cobrar)'}
          </button>
        </div>

        {/* Collapsible Elimination Section */}
        <div style={{ borderTop: '1px dashed rgba(255,255,255,0.1)', paddingTop: '1rem' }}>
          {!showDeleteSection ? (
            <button
              type="button"
              onClick={() => setShowDeleteSection(true)}
              style={{ background: 'transparent', border: 'none', color: '#ef4444', cursor: 'pointer', fontSize: '0.8rem', display: 'flex', alignItems: 'center', gap: '4px', textDecoration: 'underline' }}
            >
              <Trash2 size={14} /> ¿Desea eliminar la deuda por completo?
            </button>
          ) : (
            <div style={{ background: 'rgba(239, 68, 68, 0.08)', border: '1px solid rgba(239, 68, 68, 0.25)', padding: '1rem', borderRadius: '8px' }}>
              <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.6rem' }}>
                <span style={{ fontSize: '0.85rem', color: '#ef4444', fontWeight: 'bold', display: 'flex', alignItems: 'center', gap: '6px' }}>
                  <Lock size={14} /> Eliminar Deuda (Contraseña legacy: 450 gramos)
                </span>
                <button
                  type="button"
                  onClick={() => setShowDeleteSection(false)}
                  style={{ background: 'transparent', border: 'none', color: '#94a3b8', fontSize: '0.8rem', cursor: 'pointer' }}
                >
                  Ocultar
                </button>
              </div>
              <div style={{ display: 'flex', gap: '0.6rem' }}>
                <input
                  type="password"
                  className="input-field"
                  placeholder="Ingrese contraseña de seguridad"
                  value={contraDelete}
                  onChange={e => setContraDelete(e.target.value)}
                  style={{ flex: 1, margin: 0, padding: '0.4rem 0.8rem', fontSize: '0.85rem' }}
                />
                <button
                  type="button"
                  onClick={handleEliminar}
                  disabled={loading || !contraDelete.trim()}
                  className="delete-btn"
                  style={{ width: 'auto', padding: '0.4rem 1rem', display: 'flex', alignItems: 'center', gap: '4px' }}
                >
                  <Trash2 size={14} /> Eliminar Deuda
                </button>
              </div>
            </div>
          )}
        </div>

      </div>
    </div>
  );
};

export default PagoManualCuotaModal;
