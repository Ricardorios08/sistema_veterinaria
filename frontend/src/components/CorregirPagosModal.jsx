import React, { useState } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { RefreshCw, CheckSquare, Square, Lock, AlertCircle } from 'lucide-react';

const CorregirPagosModal = ({ socio, cuotas = [], onClose, onSuccess }) => {
  const pagadas = cuotas.filter(c => c.estado === 'PAGADO');
  const [selectedBoletas, setSelectedBoletas] = useState([]);
  const [seguridad, setSeguridad] = useState('');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const toggleBoleta = (nro_boleta) => {
    if (selectedBoletas.includes(nro_boleta)) {
      setSelectedBoletas(selectedBoletas.filter(b => b !== nro_boleta));
    } else {
      setSelectedBoletas([...selectedBoletas, nro_boleta]);
    }
  };

  const toggleSelectAll = () => {
    if (selectedBoletas.length === pagadas.length) {
      setSelectedBoletas([]);
    } else {
      setSelectedBoletas(pagadas.map(c => c.nro_boleta));
    }
  };

  const totalImporte = pagadas
    .filter(c => selectedBoletas.includes(c.nro_boleta))
    .reduce((acc, c) => acc + parseFloat(c.importe || 0), 0);

  const handleCorregir = async (e) => {
    e.preventDefault();
    if (selectedBoletas.length === 0) {
      setError('Seleccione al menos una cuota pagada para corregir.');
      return;
    }
    if (!seguridad.trim()) {
      setError('Ingrese la contraseña de seguridad.');
      return;
    }

    setLoading(true);
    setError(null);
    try {
      await axios.post(`${API_URL}/socios/corregir-pagos`, {
        cod_socio: socio.cod_mevep || socio.id,
        boletas: selectedBoletas,
        seguridad: seguridad.trim()
      });
      if (onSuccess) onSuccess();
      onClose();
    } catch (err) {
      setError(err.response?.data?.error || 'Error al corregir los pagos');
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
        width: '100%', maxWidth: '650px', margin: 0, padding: '1.8rem',
        background: 'var(--bg, #0f172a)', borderRadius: '12px', border: '1px solid var(--border, #1e293b)'
      }} onClick={e => e.stopPropagation()}>
        
        {/* Header */}
        <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.2rem', borderBottom: '1px solid var(--border, #1e293b)', paddingBottom: '0.8rem' }}>
          <h3 style={{ margin: 0, color: '#f59e0b', display: 'flex', alignItems: 'center', gap: '8px' }}>
            <RefreshCw size={22} /> Corregir Pagos (Revertir a Pendiente)
          </h3>
          <button className="close-btn" onClick={onClose} style={{ background: 'transparent', border: 'none', color: '#94a3b8', fontSize: '1.5rem', cursor: 'pointer' }}>×</button>
        </div>

        {/* Socio Info */}
        <div style={{ background: 'rgba(255,255,255,0.03)', padding: '0.8rem 1rem', borderRadius: '8px', marginBottom: '1rem', display: 'flex', justifyContent: 'space-between', flexWrap: 'wrap', gap: '0.5rem' }}>
          <div>
            <span style={{ fontSize: '0.75rem', color: 'var(--text-dim, #94a3b8)' }}>Socio</span>
            <div style={{ fontWeight: 'bold', color: '#fff' }}>{socio.apellido?.toUpperCase()}, {socio.nombre?.toUpperCase()}</div>
          </div>
          <div>
            <span style={{ fontSize: '0.75rem', color: 'var(--text-dim, #94a3b8)' }}>Código MEVEP</span>
            <div style={{ fontWeight: 'bold', color: '#93c5fd' }}>{socio.cod_mevep || socio.id}</div>
          </div>
        </div>

        {error && (
          <div style={{ background: 'rgba(239, 68, 68, 0.1)', border: '1px solid #ef4444', color: '#fca5a5', padding: '0.6rem 1rem', borderRadius: '6px', marginBottom: '1rem', fontSize: '0.85rem', display: 'flex', alignItems: 'center', gap: '6px' }}>
            <AlertCircle size={16} />
            {error}
          </div>
        )}

        {/* Lista de Cuotas Pagadas */}
        {pagadas.length === 0 ? (
          <div style={{ textAlign: 'center', padding: '2rem', color: '#94a3b8' }}>
            El socio no posee boletas pagadas registradas para corregir.
          </div>
        ) : (
          <>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.8rem' }}>
              <button
                type="button"
                onClick={toggleSelectAll}
                style={{ background: 'transparent', border: 'none', color: '#f59e0b', cursor: 'pointer', display: 'flex', alignItems: 'center', gap: '6px', fontSize: '0.85rem', fontWeight: 600 }}
              >
                {selectedBoletas.length === pagadas.length ? <CheckSquare size={16} /> : <Square size={16} />}
                {selectedBoletas.length === pagadas.length ? 'Desmarcar Todas' : 'Marcar Todas'}
              </button>
              <span style={{ fontSize: '0.85rem', color: '#94a3b8' }}>
                Seleccionadas: {selectedBoletas.length} de {pagadas.length}
              </span>
            </div>

            <div style={{ maxHeight: '220px', overflowY: 'auto', border: '1px solid var(--border, #1e293b)', borderRadius: '8px', marginBottom: '1.2rem' }}>
              <table style={{ width: '100%', borderCollapse: 'collapse', fontSize: '0.85rem' }}>
                <thead>
                  <tr style={{ background: 'rgba(255,255,255,0.05)', textAlign: 'left', color: '#94a3b8' }}>
                    <th style={{ padding: '0.6rem 0.8rem', width: '40px' }}></th>
                    <th style={{ padding: '0.6rem 0.8rem' }}>Período</th>
                    <th style={{ padding: '0.6rem 0.8rem' }}>N° Boleta</th>
                    <th style={{ padding: '0.6rem 0.8rem' }}>Fecha Pago</th>
                    <th style={{ padding: '0.6rem 0.8rem', textAlign: 'right' }}>Importe</th>
                  </tr>
                </thead>
                <tbody>
                  {pagadas.map((c) => {
                    const selected = selectedBoletas.includes(c.nro_boleta);
                    return (
                      <tr
                        key={c.nro_boleta || `${c.anio}-${c.mes}`}
                        onClick={() => toggleBoleta(c.nro_boleta)}
                        style={{
                          cursor: 'pointer',
                          background: selected ? 'rgba(245, 158, 11, 0.12)' : 'transparent',
                          borderBottom: '1px solid rgba(255,255,255,0.05)'
                        }}
                      >
                        <td style={{ padding: '0.6rem 0.8rem', textAlign: 'center' }}>
                          {selected ? <CheckSquare size={16} color="#f59e0b" /> : <Square size={16} color="#64748b" />}
                        </td>
                        <td style={{ padding: '0.6rem 0.8rem', fontWeight: 600, color: '#fff' }}>
                          {c.mes}/{c.anio}
                        </td>
                        <td style={{ padding: '0.6rem 0.8rem', color: '#cbd5e1' }}>
                          {c.nro_boleta || '—'}
                        </td>
                        <td style={{ padding: '0.6rem 0.8rem', color: '#94a3b8' }}>
                          {c.fecha_pago || '—'}
                        </td>
                        <td style={{ padding: '0.6rem 0.8rem', textAlign: 'right', fontWeight: 'bold', color: '#f59e0b' }}>
                          ${parseFloat(c.importe || 0).toLocaleString('es-AR', { minimumFractionDigits: 2 })}
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>

            {/* Clave de Seguridad */}
            <div style={{ background: 'rgba(245, 158, 11, 0.05)', border: '1px solid rgba(245, 158, 11, 0.2)', padding: '0.8rem 1rem', borderRadius: '8px', marginBottom: '1.2rem' }}>
              <label style={{ fontSize: '0.85rem', color: '#f59e0b', fontWeight: 'bold', display: 'flex', alignItems: 'center', gap: '6px', marginBottom: '0.4rem' }}>
                <Lock size={14} /> Contraseña de Seguridad (Legacy: raza):
              </label>
              <input
                type="password"
                className="input-field"
                placeholder="Ingrese contraseña para autorizar"
                value={seguridad}
                onChange={e => setSeguridad(e.target.value)}
                style={{ width: '100%', margin: 0, padding: '0.5rem 0.8rem', fontSize: '0.9rem' }}
              />
            </div>

            {/* Total Footer */}
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', paddingTop: '1rem', borderTop: '1px solid var(--border, #1e293b)' }}>
              <div>
                <span style={{ fontSize: '0.8rem', color: '#94a3b8' }}>Total a Revertir</span>
                <div style={{ fontSize: '1.4rem', fontWeight: 'bold', color: '#f59e0b' }}>
                  ${totalImporte.toLocaleString('es-AR', { minimumFractionDigits: 2 })}
                </div>
              </div>
              <div style={{ display: 'flex', gap: '0.8rem' }}>
                <button type="button" onClick={onClose} className="btn btn-secondary" style={{ width: 'auto' }}>
                  Cancelar
                </button>
                <button
                  type="button"
                  onClick={handleCorregir}
                  disabled={loading || selectedBoletas.length === 0 || !seguridad.trim()}
                  className="btn btn-primary"
                  style={{ width: 'auto', background: '#f59e0b', borderColor: '#f59e0b', display: 'flex', alignItems: 'center', gap: '6px', color: '#000', fontWeight: 'bold' }}
                >
                  <RefreshCw size={16} />
                  {loading ? 'Procesando...' : `Corregir (${selectedBoletas.length})`}
                </button>
              </div>
            </div>
          </>
        )}
      </div>
    </div>
  );
};

export default CorregirPagosModal;
