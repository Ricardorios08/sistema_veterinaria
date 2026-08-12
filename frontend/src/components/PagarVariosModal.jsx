import React, { useState } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { DollarSign, CheckSquare, Square, X, AlertCircle } from 'lucide-react';

const PagarVariosModal = ({ socio, cuotas = [], cobradores = [], onClose, onSuccess }) => {
  const pendientes = cuotas.filter(c => c.estado === 'PENDIENTE');
  const [selectedBoletas, setSelectedBoletas] = useState([]);
  const [selectedCobrador, setSelectedCobrador] = useState(socio?.cobrador || '10');
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
    if (selectedBoletas.length === pendientes.length) {
      setSelectedBoletas([]);
    } else {
      setSelectedBoletas(pendientes.map(c => c.nro_boleta));
    }
  };

  const totalImporte = pendientes
    .filter(c => selectedBoletas.includes(c.nro_boleta))
    .reduce((acc, c) => acc + parseFloat(c.importe || 0), 0);

  const handlePagar = async (e) => {
    e.preventDefault();
    if (selectedBoletas.length === 0) {
      setError('Seleccione al menos una cuota para pagar.');
      return;
    }

    setLoading(true);
    setError(null);
    try {
      await axios.post(`${API_URL}/socios/pagar-varios`, {
        cod_socio: socio.cod_mevep || socio.id,
        boletas: selectedBoletas,
        cobrador: selectedCobrador
      });
      if (onSuccess) onSuccess();
      onClose();
    } catch (err) {
      setError(err.response?.data?.error || 'Error al procesar el pago de varias cuotas');
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
          <h3 style={{ margin: 0, color: 'var(--primary, #3b82f6)', display: 'flex', alignItems: 'center', gap: '8px' }}>
            <DollarSign size={22} /> Pagar Varios (Cuotas Pendientes)
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

        {/* Lista de Cuotas Pendientes */}
        {pendientes.length === 0 ? (
          <div style={{ textAlign: 'center', padding: '2rem', color: '#94a3b8' }}>
            El socio no posee cuotas pendientes para abonar.
          </div>
        ) : (
          <>
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '0.8rem' }}>
              <button
                type="button"
                onClick={toggleSelectAll}
                style={{ background: 'transparent', border: 'none', color: 'var(--primary, #3b82f6)', cursor: 'pointer', display: 'flex', alignItems: 'center', gap: '6px', fontSize: '0.85rem', fontWeight: 600 }}
              >
                {selectedBoletas.length === pendientes.length ? <CheckSquare size={16} /> : <Square size={16} />}
                {selectedBoletas.length === pendientes.length ? 'Desmarcar Todas' : 'Marcar Todas'}
              </button>
              <span style={{ fontSize: '0.85rem', color: '#94a3b8' }}>
                Seleccionadas: {selectedBoletas.length} de {pendientes.length}
              </span>
            </div>

            <div style={{ maxHeight: '250px', overflowY: 'auto', border: '1px solid var(--border, #1e293b)', borderRadius: '8px', marginBottom: '1.2rem' }}>
              <table style={{ width: '100%', borderCollapse: 'collapse', fontSize: '0.85rem' }}>
                <thead>
                  <tr style={{ background: 'rgba(255,255,255,0.05)', textAlign: 'left', color: '#94a3b8' }}>
                    <th style={{ padding: '0.6rem 0.8rem', width: '40px' }}></th>
                    <th style={{ padding: '0.6rem 0.8rem' }}>Período</th>
                    <th style={{ padding: '0.6rem 0.8rem' }}>N° Boleta</th>
                    <th style={{ padding: '0.6rem 0.8rem', textAlign: 'right' }}>Importe</th>
                  </tr>
                </thead>
                <tbody>
                  {pendientes.map((c) => {
                    const selected = selectedBoletas.includes(c.nro_boleta);
                    return (
                      <tr
                        key={c.nro_boleta || `${c.anio}-${c.mes}`}
                        onClick={() => toggleBoleta(c.nro_boleta)}
                        style={{
                          cursor: 'pointer',
                          background: selected ? 'rgba(59, 130, 246, 0.12)' : 'transparent',
                          borderBottom: '1px solid rgba(255,255,255,0.05)'
                        }}
                      >
                        <td style={{ padding: '0.6rem 0.8rem', textAlign: 'center' }}>
                          {selected ? <CheckSquare size={16} color="#3b82f6" /> : <Square size={16} color="#64748b" />}
                        </td>
                        <td style={{ padding: '0.6rem 0.8rem', fontWeight: 600, color: '#fff' }}>
                          {c.mes}/{c.anio}
                        </td>
                        <td style={{ padding: '0.6rem 0.8rem', color: '#cbd5e1' }}>
                          {c.nro_boleta || '—'}
                        </td>
                        <td style={{ padding: '0.6rem 0.8rem', textAlign: 'right', fontWeight: 'bold', color: '#10b981' }}>
                          ${parseFloat(c.importe || 0).toLocaleString('es-AR', { minimumFractionDigits: 2 })}
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>

            {/* Cobrador Selector */}
            <div style={{ display: 'flex', gap: '1rem', alignItems: 'center', marginBottom: '1.5rem', flexWrap: 'wrap' }}>
              <label style={{ fontSize: '0.85rem', color: '#94a3b8', fontWeight: 'bold' }}>Cobrador:</label>
              <select
                className="input-field"
                value={selectedCobrador}
                onChange={e => setSelectedCobrador(e.target.value)}
                style={{ width: 'auto', margin: 0, padding: '0.4rem 0.8rem', fontSize: '0.85rem' }}
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

            {/* Total Footer */}
            <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', paddingTop: '1rem', borderTop: '1px solid var(--border, #1e293b)' }}>
              <div>
                <span style={{ fontSize: '0.8rem', color: '#94a3b8' }}>Total Seleccionado</span>
                <div style={{ fontSize: '1.5rem', fontWeight: 'bold', color: '#10b981' }}>
                  ${totalImporte.toLocaleString('es-AR', { minimumFractionDigits: 2 })}
                </div>
              </div>
              <div style={{ display: 'flex', gap: '0.8rem' }}>
                <button type="button" onClick={onClose} className="btn btn-secondary" style={{ width: 'auto' }}>
                  Cancelar
                </button>
                <button
                  type="button"
                  onClick={handlePagar}
                  disabled={loading || selectedBoletas.length === 0}
                  className="btn btn-primary"
                  style={{ width: 'auto', background: '#10b981', borderColor: '#10b981', display: 'flex', alignItems: 'center', gap: '6px' }}
                >
                  <DollarSign size={16} />
                  {loading ? 'Procesando...' : `Pagar (${selectedBoletas.length})`}
                </button>
              </div>
            </div>
          </>
        )}
      </div>
    </div>
  );
};

export default PagarVariosModal;
