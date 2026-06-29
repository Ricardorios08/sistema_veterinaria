import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import {
  ArrowLeft,
  Search,
  Shuffle,
  Users,
  AlertCircle,
  CheckCircle,
  Loader2,
  MapPin,
  User,
  DollarSign,
  FileText,
} from 'lucide-react';

const AcomodarRuta = ({ currentUser, onBack }) => {
  // Search state
  const [searchQuery, setSearchQuery] = useState('');
  const [searchResults, setSearchResults] = useState([]);
  const [selectedSocio, setSelectedSocio] = useState(null);
  const [searching, setSearching] = useState(false);

  // Form inputs state
  const [rutaNueva, setRutaNueva] = useState('');
  const [cobrador, setCobrador] = useState('10');
  const [tipoPago, setTipoPago] = useState('FALSO'); // FALSO = COBRADOR, VERDADERO = LOCAL
  const [motivo, setMotivo] = useState('');

  // Dropdowns lists
  const [cobradores, setCobradores] = useState([]);

  // UI States
  const [loading, setLoading] = useState(false);
  const [successMsg, setSuccessMsg] = useState(null);
  const [errorMsg, setErrorMsg] = useState(null);

  // Fetch cobradores on mount
  useEffect(() => {
    const fetchCobradores = async () => {
      try {
        const response = await axios.get(`${API_URL}/socios/cobradores`);
        setCobradores(response.data);
      } catch (err) {
        console.error('Error fetching cobradores list', err);
      }
    };
    fetchCobradores();
  }, []);

  // Search logic
  const handleSearchChange = async (e) => {
    const query = e.target.value;
    setSearchQuery(query);

    if (query.trim().length < 2) {
      setSearchResults([]);
      return;
    }

    try {
      setSearching(true);
      const response = await axios.get(`${API_URL}/socios/legacy/search`, {
        params: { q: query }
      });
      setSearchResults(response.data);
    } catch (err) {
      console.error(err);
    } finally {
      setSearching(false);
    }
  };

  const handleSelectSocio = (socio) => {
    setSelectedSocio(socio);
    setSearchQuery('');
    setSearchResults([]);
    setErrorMsg(null);
    setSuccessMsg(null);

    // Autofill form inputs from current legacy values
    setRutaNueva('');
    setCobrador(socio.cobrador || '10');
    setTipoPago(socio.no_imprimir || 'FALSO');
    setMotivo(socio.motivo || '');
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!selectedSocio) {
      setErrorMsg('Seleccione un socio primero.');
      return;
    }
    if (!rutaNueva) {
      setErrorMsg('Por favor ingrese la ruta nueva.');
      return;
    }

    try {
      setLoading(true);
      setErrorMsg(null);
      setSuccessMsg(null);

      const payload = {
        cod_socio: selectedSocio.cod_socio,
        ruta_nueva: rutaNueva,
        tipo_pago: tipoPago,
        cobrador: cobrador,
        motivo: motivo,
      };

      await axios.post(`${API_URL}/socios/acomodar-ruta`, payload);
      
      setSuccessMsg(`¡Ruta acomodada con éxito! El socio ${selectedSocio.apellido}, ${selectedSocio.nombre} ahora se encuentra en la ruta ${rutaNueva}.`);
      
      // Update selected socio visual state
      setSelectedSocio({
        ...selectedSocio,
        ruta: rutaNueva,
        cobrador: cobrador,
        no_imprimir: tipoPago,
        motivo: motivo
      });
      setRutaNueva('');
    } catch (err) {
      console.error(err);
      setErrorMsg(err.response?.data?.error || 'Error al guardar la nueva ruta del socio.');
    } finally {
      setLoading(false);
    }
  };

  const getCobradorName = (code) => {
    const match = cobradores.find(c => c.cod_cobrador === code);
    if (match) return `${code} - ${match.nombre_cobrador}`;
    
    const localMap = {
      '0': 'LOCAL', '10': 'LOCAL', '11': 'DANIEL', '12': 'JORGE',
      '13': 'GUSTAVO', '14': 'RICARDO', '15': 'COB. 15', '16': 'COB. 16'
    };
    return localMap[code] || `Cobrador ${code}`;
  };

  return (
    <div className="view-container">
      <div style={{ maxWidth: '800px', margin: '0 auto', width: '100%' }}>
        {/* Back navigation */}
        <button
          onClick={onBack}
          style={{
            all: 'unset',
            cursor: 'pointer',
            display: 'flex',
            alignItems: 'center',
            gap: '0.5rem',
            color: 'var(--text-dim)',
            fontSize: '0.85rem',
            marginBottom: '1.5rem',
            transition: 'color 0.2s',
          }}
          onMouseEnter={(e) => (e.currentTarget.style.color = 'var(--text)')}
          onMouseLeave={(e) => (e.currentTarget.style.color = 'var(--text-dim)')}
        >
          <ArrowLeft size={16} />
          <span>Volver al Dashboard</span>
        </button>

        {/* Header */}
        <div style={{ marginBottom: '2.5rem' }}>
          <h1 style={{ margin: 0, fontSize: '1.8rem', fontWeight: 800, color: 'var(--text)' }}>
            Acomodar Socio en Ruta
          </h1>
          <p style={{ margin: '0.25rem 0 0 0', color: 'var(--text-dim)', fontSize: '0.9rem' }}>
            Cambiar la ruta de cobro de un socio y desplazar automáticamente los demás socios hacia adelante (+1).
          </p>
        </div>

        {errorMsg && (
          <div
            style={{
              display: 'flex',
              alignItems: 'center',
              gap: '0.75rem',
              padding: '1rem',
              background: 'rgba(239, 68, 68, 0.1)',
              border: '1px solid rgba(239, 68, 68, 0.2)',
              borderRadius: '12px',
              color: '#ef4444',
              marginBottom: '1.5rem',
              fontSize: '0.875rem',
            }}
          >
            <AlertCircle size={18} style={{ flexShrink: 0 }} />
            <span>{errorMsg}</span>
          </div>
        )}

        {successMsg && (
          <div
            style={{
              display: 'flex',
              alignItems: 'center',
              gap: '0.75rem',
              padding: '1rem',
              background: 'rgba(16, 185, 129, 0.1)',
              border: '1px solid rgba(16, 185, 129, 0.2)',
              borderRadius: '12px',
              color: '#10b981',
              marginBottom: '1.5rem',
              fontSize: '0.875rem',
            }}
          >
            <CheckCircle size={18} style={{ flexShrink: 0 }} />
            <span>{successMsg}</span>
          </div>
        )}

        {/* Step 1: Search member */}
        <div
          style={{
            background: 'rgba(255, 255, 255, 0.02)',
            border: '1px solid rgba(255, 255, 255, 0.08)',
            borderRadius: '16px',
            padding: '1.5rem',
            marginBottom: '1.5rem',
            position: 'relative',
          }}
        >
          <label style={{ display: 'block', fontSize: '0.8rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase', marginBottom: '0.5rem' }}>
            Buscar Socio en Base Legacy (Nombre, Código o Domicilio)
          </label>
          <div style={{ position: 'relative' }}>
            <Search
              size={18}
              style={{
                position: 'absolute',
                left: '12px',
                top: '50%',
                transform: 'translateY(-50%)',
                color: 'var(--text-dim)',
              }}
            />
            <input
              type="text"
              placeholder="Ej: Pérez o 1234..."
              value={searchQuery}
              onChange={handleSearchChange}
              style={{
                width: '100%',
                background: 'rgba(0,0,0,0.2)',
                border: '1px solid rgba(255,255,255,0.1)',
                borderRadius: '8px',
                padding: '0.65rem 0.75rem 0.65rem 2.5rem',
                color: 'var(--text)',
                fontSize: '0.9rem',
                boxSizing: 'border-box',
              }}
            />
            {searching && (
              <Loader2
                className="animate-spin"
                size={18}
                style={{
                  position: 'absolute',
                  right: '12px',
                  top: '50%',
                  transform: 'translateY(-50%)',
                  color: 'var(--text-dim)',
                }}
              />
            )}
          </div>

          {/* Autocomplete Dropdown */}
          {searchResults.length > 0 && (
            <div
              style={{
                position: 'absolute',
                top: 'calc(100% + 4px)',
                left: '1.5rem',
                right: '1.5rem',
                background: '#1e293b',
                border: '1px solid rgba(255,255,255,0.15)',
                borderRadius: '10px',
                maxHeight: '220px',
                overflowY: 'auto',
                zIndex: 10,
                boxShadow: '0 10px 25px -5px rgba(0,0,0,0.5)',
              }}
            >
              {searchResults.map((s) => (
                <button
                  key={s.cod_socio}
                  onClick={() => handleSelectSocio(s)}
                  style={{
                    all: 'unset',
                    display: 'block',
                    width: '100%',
                    padding: '0.75rem 1rem',
                    textAlign: 'left',
                    cursor: 'pointer',
                    borderBottom: '1px solid rgba(255,255,255,0.05)',
                    fontSize: '0.85rem',
                    boxSizing: 'border-box',
                    transition: 'background 0.15s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.background = 'rgba(255,255,255,0.05)')}
                  onMouseLeave={(e) => (e.currentTarget.style.background = 'transparent')}
                >
                  <div style={{ fontWeight: 700, color: '#fff' }}>
                    {s.apellido}, {s.nombre}
                  </div>
                  <div style={{ color: 'var(--text-dim)', fontSize: '0.75rem', marginTop: '2px', display: 'flex', gap: '1rem' }}>
                    <span>CÓDIGO: {s.cod_socio}</span>
                    <span>RUTA: {s.ruta || '—'}</span>
                    <span>DOMICILIO: {s.domicilio || '—'}</span>
                  </div>
                </button>
              ))}
            </div>
          )}
        </div>

        {/* Selected Socio detail & Action Form */}
        {selectedSocio ? (
          <form onSubmit={handleSubmit} style={{ display: 'flex', flexDirection: 'column', gap: '1.5rem' }}>
            
            {/* Socio details card */}
            <div
              style={{
                background: 'rgba(244, 63, 94, 0.03)',
                border: '1px solid rgba(244, 63, 94, 0.15)',
                borderRadius: '16px',
                padding: '1.5rem',
                display: 'grid',
                gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))',
                gap: '1.25rem',
              }}
            >
              <div style={{ gridColumn: '1 / -1', borderBottom: '1px solid rgba(244,63,94,0.1)', paddingBottom: '0.5rem', marginBottom: '0.25rem' }}>
                <span style={{ fontSize: '0.75rem', color: '#f43f5e', fontWeight: 700, textTransform: 'uppercase', letterSpacing: '0.05em' }}>
                  Socio Seleccionado
                </span>
                <h3 style={{ margin: '0.2rem 0 0 0', fontSize: '1.2rem', fontWeight: 850 }}>
                  {selectedSocio.apellido}, {selectedSocio.nombre}
                </h3>
              </div>

              {/* Data bits */}
              <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem' }}>
                <div style={{ width: '32px', height: '32px', borderRadius: '8px', background: 'rgba(255,255,255,0.04)', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#f43f5e' }}>
                  <User size={16} />
                </div>
                <div>
                  <div style={{ fontSize: '0.7rem', color: 'var(--text-dim)', textTransform: 'uppercase' }}>Cod. Socio</div>
                  <div style={{ fontSize: '0.85rem', fontWeight: 700 }}>{selectedSocio.cod_socio}</div>
                </div>
              </div>

              <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem' }}>
                <div style={{ width: '32px', height: '32px', borderRadius: '8px', background: 'rgba(255,255,255,0.04)', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#f43f5e' }}>
                  <MapPin size={16} />
                </div>
                <div>
                  <div style={{ fontSize: '0.7rem', color: 'var(--text-dim)', textTransform: 'uppercase' }}>Ruta Actual</div>
                  <div style={{ fontSize: '0.85rem', fontWeight: 700, color: '#f43f5e' }}>{selectedSocio.ruta || '—'}</div>
                </div>
              </div>

              <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem' }}>
                <div style={{ width: '32px', height: '32px', borderRadius: '8px', background: 'rgba(255,255,255,0.04)', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#f43f5e' }}>
                  <DollarSign size={16} />
                </div>
                <div>
                  <div style={{ fontSize: '0.7rem', color: 'var(--text-dim)', textTransform: 'uppercase' }}>Pago Actual</div>
                  <div style={{ fontSize: '0.85rem', fontWeight: 700 }}>
                    {selectedSocio.no_imprimir === 'VERDADERO' ? 'LOCAL' : 'COBRADOR'}
                  </div>
                </div>
              </div>

              <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem' }}>
                <div style={{ width: '32px', height: '32px', borderRadius: '8px', background: 'rgba(255,255,255,0.04)', display: 'flex', alignItems: 'center', justifyContent: 'center', color: '#f43f5e' }}>
                  <Users size={16} />
                </div>
                <div>
                  <div style={{ fontSize: '0.7rem', color: 'var(--text-dim)', textTransform: 'uppercase' }}>Cobrador Actual</div>
                  <div style={{ fontSize: '0.85rem', fontWeight: 700 }}>
                    {getCobradorName(selectedSocio.cobrador)}
                  </div>
                </div>
              </div>

              {selectedSocio.motivo && (
                <div style={{ gridColumn: '1 / -1', display: 'flex', alignItems: 'center', gap: '0.75rem', background: 'rgba(255,255,255,0.02)', padding: '0.5rem 0.75rem', borderRadius: '8px' }}>
                  <FileText size={14} style={{ color: 'var(--text-dim)' }} />
                  <span style={{ fontSize: '0.75rem', color: 'var(--text-dim)' }}>
                    <strong>Obs: </strong> {selectedSocio.motivo}
                  </span>
                </div>
              )}
            </div>

            {/* Action Form card */}
            <div
              style={{
                background: 'rgba(255, 255, 255, 0.02)',
                border: '1px solid rgba(255, 255, 255, 0.08)',
                borderRadius: '16px',
                padding: '1.75rem',
              }}
            >
              <h2 style={{ margin: '0 0 1.25rem 0', fontSize: '1.1rem', fontWeight: 700, display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
                <Shuffle size={18} style={{ color: '#f43f5e' }} />
                Nuevos Parámetros de Ruta
              </h2>

              <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(220px, 1fr))', gap: '1.25rem', marginBottom: '1.25rem' }}>
                {/* Ruta Nueva */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem' }}>
                  <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                    Ruta Nueva *
                  </label>
                  <input
                    type="number"
                    required
                    placeholder="Ej. 15"
                    value={rutaNueva}
                    onChange={(e) => setRutaNueva(e.target.value)}
                    style={{
                      background: 'rgba(0,0,0,0.2)',
                      border: '1px solid rgba(255,255,255,0.1)',
                      borderRadius: '8px',
                      padding: '0.6rem 0.8rem',
                      color: 'var(--text)',
                      fontSize: '0.875rem',
                    }}
                  />
                  <span style={{ fontSize: '0.7rem', color: 'var(--text-dim)' }}>
                    Desplazará socios con ruta ≥ a este número.
                  </span>
                </div>

                {/* Cobrador */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem' }}>
                  <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                    Cobrador Asignado
                  </label>
                  <select
                    value={cobrador}
                    onChange={(e) => setCobrador(e.target.value)}
                    style={{
                      background: 'rgba(0,0,0,0.2)',
                      border: '1px solid rgba(255,255,255,0.1)',
                      borderRadius: '8px',
                      padding: '0.6rem 0.8rem',
                      color: 'var(--text)',
                      fontSize: '0.875rem',
                      height: '38px',
                    }}
                  >
                    {cobradores.length > 0 ? (
                      cobradores.map(c => (
                        <option key={c.cod_cobrador} value={c.cod_cobrador} style={{ background: '#0f172a' }}>
                          {c.cod_cobrador} - {c.nombre_cobrador}
                        </option>
                      ))
                    ) : (
                      <>
                        <option value="10" style={{ background: '#0f172a' }}>10 - LOCAL</option>
                        <option value="11" style={{ background: '#0f172a' }}>11 - DANIEL</option>
                        <option value="12" style={{ background: '#0f172a' }}>12 - JORGE</option>
                        <option value="13" style={{ background: '#0f172a' }}>13 - GUSTAVO</option>
                        <option value="14" style={{ background: '#0f172a' }}>14 - RICARDO</option>
                      </>
                    )}
                  </select>
                </div>
              </div>

              {/* Modo de Pago */}
              <div style={{ display: 'flex', flexDirection: 'column', gap: '0.5rem', marginBottom: '1.25rem' }}>
                <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                  Modo de Pago
                </label>
                <div style={{ display: 'flex', gap: '1.5rem' }}>
                  <label style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', cursor: 'pointer', fontSize: '0.875rem' }}>
                    <input
                      type="radio"
                      name="tipoPago"
                      value="VERDADERO"
                      checked={tipoPago === 'VERDADERO'}
                      onChange={() => setTipoPago('VERDADERO')}
                      style={{ cursor: 'pointer', accentColor: '#f43f5e' }}
                    />
                    <span>LOCAL (No Imprimir Boleta)</span>
                  </label>
                  <label style={{ display: 'flex', alignItems: 'center', gap: '0.5rem', cursor: 'pointer', fontSize: '0.875rem' }}>
                    <input
                      type="radio"
                      name="tipoPago"
                      value="FALSO"
                      checked={tipoPago === 'FALSO'}
                      onChange={() => setTipoPago('FALSO')}
                      style={{ cursor: 'pointer', accentColor: '#f43f5e' }}
                    />
                    <span>COBRADOR (Imprimir Boleta)</span>
                  </label>
                </div>
              </div>

              {/* Observaciones/Motivo */}
              <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem', marginBottom: '1.75rem' }}>
                <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                  Observaciones / Motivo de Cambio
                </label>
                <input
                  type="text"
                  placeholder="Ej: Cambio de zona del cobrador..."
                  value={motivo}
                  onChange={(e) => setMotivo(e.target.value)}
                  style={{
                    background: 'rgba(0,0,0,0.2)',
                    border: '1px solid rgba(255,255,255,0.1)',
                    borderRadius: '8px',
                    padding: '0.6rem 0.8rem',
                    color: 'var(--text)',
                    fontSize: '0.875rem',
                  }}
                />
              </div>

              {/* Submit Button */}
              <button
                type="submit"
                disabled={loading}
                style={{
                  background: 'linear-gradient(135deg, #e11d48, #f43f5e)',
                  color: '#fff',
                  border: 'none',
                  borderRadius: '10px',
                  padding: '0.75rem 1.5rem',
                  fontSize: '0.9rem',
                  fontWeight: 700,
                  cursor: 'pointer',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '0.5rem',
                  boxShadow: '0 4px 14px rgba(225, 29, 72, 0.3)',
                  transition: 'opacity 0.2s',
                }}
                onMouseEnter={(e) => (e.currentTarget.style.opacity = '0.9')}
                onMouseLeave={(e) => (e.currentTarget.style.opacity = '1')}
              >
                {loading ? (
                  <>
                    <Loader2 className="animate-spin" size={18} />
                    <span>Guardando...</span>
                  </>
                ) : (
                  <>
                    <Shuffle size={18} />
                    <span>Acomodar Ruta</span>
                  </>
                )}
              </button>
            </div>
          </form>
        ) : (
          <div
            style={{
              padding: '3rem',
              background: 'rgba(255,255,255,0.01)',
              border: '1px dashed rgba(255,255,255,0.1)',
              borderRadius: '16px',
              textAlign: 'center',
              color: 'var(--text-dim)',
            }}
          >
            <Users size={32} style={{ margin: '0 auto 1rem auto', color: 'var(--text-dim)', opacity: 0.3 }} />
            <p style={{ margin: 0, fontSize: '0.9rem' }}>
              Por favor, buscá y seleccioná un socio legacy en el buscador de arriba para comenzar.
            </p>
          </div>
        )}
      </div>
    </div>
  );
};

export default AcomodarRuta;
