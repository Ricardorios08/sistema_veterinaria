import React, { useState } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import { Route, Save, AlertCircle } from 'lucide-react';

const AcomodarRutaModal = ({ socio, cobradores = [], onClose, onSuccess }) => {
  const [tipoPago, setTipoPago] = useState(socio?.no_imprimir === 'VERDADERO' ? 'VERDADERO' : 'FALSO');
  const [cobrador, setCobrador] = useState(socio?.cobrador || '10');
  const [motivo, setMotivo] = useState(socio?.motivo || socio?.observaciones || '');
  const [rutaNueva, setRutaNueva] = useState(socio?.ruta || '');
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const handleModificarRuta = async (e) => {
    e.preventDefault();
    if (!rutaNueva) {
      setError('Ingrese la nueva posición de ruta.');
      return;
    }

    setLoading(true);
    setError(null);
    try {
      await axios.post(`${API_URL}/socios/acomodar-ruta`, {
        cod_socio: socio.cod_mevep || socio.id,
        ruta_nueva: rutaNueva,
        tipo_pago: tipoPago,
        cobrador,
        motivo
      });
      if (onSuccess) onSuccess();
      onClose();
    } catch (err) {
      setError(err.response?.data?.error || 'Error al acomodar la ruta del socio');
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
            <Route size={22} /> Modificar / Acomodar Ruta
          </h3>
          <button className="close-btn" onClick={onClose} style={{ background: 'transparent', border: 'none', color: '#94a3b8', fontSize: '1.5rem', cursor: 'pointer' }}>×</button>
        </div>

        {/* Socio Info Card */}
        <div style={{ background: 'rgba(255,255,255,0.03)', padding: '0.8rem 1rem', borderRadius: '8px', marginBottom: '1.2rem', display: 'flex', justifyContent: 'space-between', flexWrap: 'wrap', gap: '0.5rem' }}>
          <div>
            <span style={{ fontSize: '0.75rem', color: '#94a3b8' }}>Socio</span>
            <div style={{ fontWeight: 'bold', color: '#fff' }}>{socio.apellido?.toUpperCase()}, {socio.nombre?.toUpperCase()}</div>
          </div>
          <div>
            <span style={{ fontSize: '0.75rem', color: '#94a3b8' }}>Código MEVEP</span>
            <div style={{ fontWeight: 'bold', color: '#93c5fd' }}>{socio.cod_mevep || socio.id}</div>
          </div>
        </div>

        {error && (
          <div style={{ background: 'rgba(239, 68, 68, 0.1)', border: '1px solid #ef4444', color: '#fca5a5', padding: '0.6rem 1rem', borderRadius: '6px', marginBottom: '1.2rem', fontSize: '0.85rem', display: 'flex', alignItems: 'center', gap: '6px' }}>
            <AlertCircle size={16} />
            {error}
          </div>
        )}

        <form onSubmit={handleModificarRuta}>
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem', marginBottom: '1.2rem' }}>
            <div>
              <label style={{ fontSize: '0.8rem', color: '#94a3b8', fontWeight: 'bold', marginBottom: '0.3rem', display: 'block' }}>Modo de Pago:</label>
              <select
                className="input-field"
                value={tipoPago}
                onChange={e => setTipoPago(e.target.value)}
                style={{ width: '100%', margin: 0, padding: '0.5rem', fontSize: '0.85rem' }}
              >
                <option value="VERDADERO">LOCAL</option>
                <option value="FALSO">COBRADOR</option>
              </select>
            </div>

            <div>
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

            <div>
              <label style={{ fontSize: '0.8rem', color: '#94a3b8', fontWeight: 'bold', marginBottom: '0.3rem', display: 'block' }}>Ruta Actual:</label>
              <input
                type="text"
                disabled
                className="input-field"
                value={socio.ruta || '—'}
                style={{ width: '100%', margin: 0, padding: '0.5rem', fontSize: '0.85rem', opacity: 0.7 }}
              />
            </div>

            <div>
              <label style={{ fontSize: '0.8rem', color: 'var(--primary, #3b82f6)', fontWeight: 'bold', marginBottom: '0.3rem', display: 'block' }}>Ruta Nueva (Posición):</label>
              <input
                type="number"
                required
                className="input-field"
                placeholder="Ej. 150"
                value={rutaNueva}
                onChange={e => setRutaNueva(e.target.value)}
                style={{ width: '100%', margin: 0, padding: '0.5rem', fontSize: '0.85rem', borderColor: 'var(--primary, #3b82f6)' }}
              />
            </div>

            <div style={{ gridColumn: 'span 2' }}>
              <label style={{ fontSize: '0.8rem', color: '#94a3b8', fontWeight: 'bold', marginBottom: '0.3rem', display: 'block' }}>Observaciones / Motivo:</label>
              <input
                type="text"
                className="input-field"
                placeholder="Observaciones de cobranza"
                value={motivo}
                onChange={e => setMotivo(e.target.value)}
                style={{ width: '100%', margin: 0, padding: '0.5rem', fontSize: '0.85rem' }}
              />
            </div>
          </div>

          <div style={{ display: 'flex', justifyContent: 'flex-end', gap: '0.8rem', paddingTop: '1rem', borderTop: '1px solid var(--border, #1e293b)' }}>
            <button type="button" onClick={onClose} className="btn btn-secondary" style={{ width: 'auto' }}>
              Cancelar
            </button>
            <button
              type="submit"
              disabled={loading || !rutaNueva}
              className="btn btn-primary"
              style={{ width: 'auto', display: 'flex', alignItems: 'center', gap: '6px' }}
            >
              <Save size={16} />
              {loading ? 'Guardando...' : 'MODIFICAR RUTA'}
            </button>
          </div>
        </form>

      </div>
    </div>
  );
};

export default AcomodarRutaModal;
