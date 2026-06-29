import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import {
  ArrowLeft, CreditCard, BarChart2, Search, CheckCircle,
  XCircle, AlertCircle, Loader2, RefreshCw, Calendar,
  User, DollarSign, Smartphone, Banknote, Clock,
  ChevronDown, Zap,
} from 'lucide-react';

const MESES = [
  { val: '01', label: 'ENERO' },   { val: '02', label: 'FEBRERO' },
  { val: '03', label: 'MARZO' },   { val: '04', label: 'ABRIL' },
  { val: '05', label: 'MAYO' },    { val: '06', label: 'JUNIO' },
  { val: '07', label: 'JULIO' },   { val: '08', label: 'AGOSTO' },
  { val: '09', label: 'SEPTIEMBRE' }, { val: '10', label: 'OCTUBRE' },
  { val: '11', label: 'NOVIEMBRE' }, { val: '12', label: 'DICIEMBRE' },
];

const METODOS = ['EFECTIVO', 'TRANSFERENCIA', 'TARJETA', 'CHEQUE', 'OTRO'];

const now = new Date();
const MES_ACTUAL = String(now.getMonth() + 1).padStart(2, '0');
const ANIO_ACTUAL = String(now.getFullYear());
const HOY = now.toISOString().split('T')[0];

// ── Helpers de estilo ──────────────────────────────────────────────────────
const badge = (estado) => {
  if (estado === 'PAGADO')   return { bg: 'rgba(16,185,129,0.15)', color: '#10b981', label: 'PAGADO' };
  if (estado === 'PENDIENTE') return { bg: 'rgba(251,191,36,0.15)', color: '#fbbf24', label: 'PENDIENTE' };
  return { bg: 'rgba(100,116,139,0.15)', color: '#94a3b8', label: estado };
};

const inputStyle = {
  background: 'rgba(0,0,0,0.2)',
  border: '1px solid rgba(255,255,255,0.1)',
  borderRadius: '8px',
  padding: '0.6rem 0.8rem',
  color: 'var(--text)',
  fontSize: '0.875rem',
  width: '100%',
  boxSizing: 'border-box',
};

const cardStyle = {
  background: 'rgba(255,255,255,0.02)',
  border: '1px solid rgba(255,255,255,0.08)',
  borderRadius: '16px',
  padding: '1.75rem',
};

const labelStyle = {
  fontSize: '0.72rem', color: 'var(--text-dim)',
  fontWeight: 600, textTransform: 'uppercase', marginBottom: '0.3rem', display: 'block'
};

export default function Pagos({ currentUser, onBack }) {
  const isAdmin = ['admin', 'superadmin'].includes(currentUser?.rol);
  const isCobrador = currentUser?.rol === 'cobrador';

  // Tab activo
  const [tab, setTab] = useState(isAdmin ? 'generar' : 'barra');

  // ── Estado: Generar cuotas ───────────────────────────────────────────────
  const [genMes,  setGenMes]  = useState(MES_ACTUAL);
  const [genAnio, setGenAnio] = useState(ANIO_ACTUAL);
  const [genLoading, setGenLoading] = useState(false);
  const [genResult,  setGenResult]  = useState(null);

  // ── Estado: Código de barras ────────────────────────────────────────────
  const [barra,     setBarra]     = useState('');
  const [barFecha,  setBarFecha]  = useState(HOY);
  const [barMetodo, setBarMetodo] = useState('EFECTIVO');
  const [barLoading, setBarLoading] = useState(false);
  const [barResult,  setBarResult]  = useState(null);
  const [ultimos,    setUltimos]    = useState([]);
  const barraRef = useRef(null);

  // ── Estado: Consulta ────────────────────────────────────────────────────
  const [conMes,     setConMes]     = useState(MES_ACTUAL);
  const [conAnio,    setConAnio]    = useState(ANIO_ACTUAL);
  const [conSearch,  setConSearch]  = useState('');
  const [conLoading, setConLoading] = useState(false);
  const [conRows,    setConRows]    = useState([]);
  const [conError,   setConError]   = useState(null);

  // ── Estado: Pago manual (modal) ─────────────────────────────────────────
  const [manualOpen,  setManualOpen]  = useState(false);
  const [manualRow,   setManualRow]   = useState(null);
  const [manualMetodo, setManualMetodo] = useState('EFECTIVO');
  const [manualLoading, setManualLoading] = useState(false);

  const token = localStorage.getItem('sulb_token');
  const headers = { Authorization: `Bearer ${token}` };

  // Cargar últimos al montar
  useEffect(() => {
    cargarUltimos();
    if (tab === 'barra') barraRef.current?.focus();
  }, [tab]);

  // ── Cargar últimos pagos del día ─────────────────────────────────────────
  const cargarUltimos = async () => {
    try {
      const r = await axios.get(`${API_URL}/pagos/ultimos`, { headers, params: { limit: 15 } });
      setUltimos(r.data);
    } catch (_) {}
  };

  // ── Generar cuotas ───────────────────────────────────────────────────────
  const handleGenerar = async (e) => {
    e.preventDefault();
    if (!window.confirm(`¿Generar cuotas de ${MESES.find(m=>m.val===genMes)?.label} ${genAnio} para todos los socios activos?`)) return;
    setGenLoading(true);
    setGenResult(null);
    try {
      const r = await axios.post(`${API_URL}/pagos/generar-cuotas`, { mes: genMes, anio: genAnio }, { headers });
      setGenResult({ ok: true, ...r.data });
    } catch (err) {
      setGenResult({ ok: false, message: err.response?.data?.error || err.message });
    } finally {
      setGenLoading(false);
    }
  };

  // ── Registrar por barra ──────────────────────────────────────────────────
  const handleBarra = async (e) => {
    e.preventDefault();
    if (!barra.trim()) return;
    setBarLoading(true);
    setBarResult(null);
    try {
      const r = await axios.post(`${API_URL}/pagos/registrar-barra`, {
        cod_barra: barra.trim(), fecha_pago: barFecha, metodo_pago: barMetodo,
      }, { headers });
      setBarResult({ ok: true, result: r.data.result, ...r.data });
      setBarra('');
      cargarUltimos();
    } catch (err) {
      const data = err.response?.data;
      setBarResult({ ok: false, result: data?.result || 'ERROR', message: data?.error || data?.message || err.message });
    } finally {
      setBarLoading(false);
      setTimeout(() => barraRef.current?.focus(), 50);
    }
  };

  // ── Consulta de pagos ────────────────────────────────────────────────────
  const handleConsulta = async (e) => {
    e?.preventDefault();
    setConLoading(true);
    setConError(null);
    setConRows([]);
    try {
      const params = { mes: conMes, anio: conAnio };
      const r = await axios.get(`${API_URL}/pagos/resumen-cobrador`, { headers, params: { ...params, search: conSearch } });
      setConRows(r.data);
    } catch (err) {
      setConError(err.response?.data?.error || err.message);
    } finally {
      setConLoading(false);
    }
  };

  // ── Pago manual desde la tabla de consulta ───────────────────────────────
  const handlePagarManual = async () => {
    if (!manualRow) return;
    setManualLoading(true);
    try {
      await axios.post(`${API_URL}/pagos/pago-manual`, {
        socio_id:   manualRow.socio_id,
        mes:        conMes,
        anio:       conAnio,
        importe:    manualRow.importe,
        metodo_pago: manualMetodo,
        fecha_pago: HOY,
      }, { headers });
      setManualOpen(false);
      setManualRow(null);
      handleConsulta();
    } catch (err) {
      alert(err.response?.data?.error || err.message);
    } finally {
      setManualLoading(false);
    }
  };

  // ── Render ──────────────────────────────────────────────────────────────
  const tabs = [
    ...(isAdmin ? [{ id: 'generar', label: 'Generar Cuotas', icon: Zap }] : []),
    { id: 'barra',   label: 'Lector de Pagos', icon: BarChart2 },
    { id: 'consulta', label: 'Consulta',        icon: Search },
  ];

  return (
    <div className="view-container">
      <div style={{ maxWidth: '1100px', margin: '0 auto', width: '100%' }}>

        {/* Back */}
        <button onClick={onBack} style={{ all: 'unset', cursor: 'pointer', display: 'flex', alignItems: 'center', gap: '0.5rem', color: 'var(--text-dim)', fontSize: '0.85rem', marginBottom: '1.5rem' }}
          onMouseEnter={e => e.currentTarget.style.color='var(--text)'}
          onMouseLeave={e => e.currentTarget.style.color='var(--text-dim)'}>
          <ArrowLeft size={16} /><span>Volver</span>
        </button>

        {/* Header */}
        <div style={{ marginBottom: '2rem' }}>
          <h1 style={{ margin: 0, fontSize: '1.8rem', fontWeight: 800, color: 'var(--text)' }}>
            Módulo de Pagos
          </h1>
          <p style={{ margin: '0.25rem 0 0 0', color: 'var(--text-dim)', fontSize: '0.9rem' }}>
            Gestión de cuotas y cobros de socios
          </p>
        </div>

        {/* Tabs */}
        <div style={{ display: 'flex', gap: '0.5rem', marginBottom: '2rem', borderBottom: '1px solid rgba(255,255,255,0.08)', paddingBottom: '0' }}>
          {tabs.map(t => {
            const Icon = t.icon;
            const active = tab === t.id;
            return (
              <button key={t.id} onClick={() => setTab(t.id)} style={{
                all: 'unset', cursor: 'pointer', padding: '0.65rem 1.2rem',
                fontSize: '0.85rem', fontWeight: active ? 700 : 500,
                color: active ? '#fbbf24' : 'var(--text-dim)',
                borderBottom: active ? '2px solid #fbbf24' : '2px solid transparent',
                display: 'flex', alignItems: 'center', gap: '0.4rem',
                transition: 'all 0.2s',
              }}>
                <Icon size={15} />{t.label}
              </button>
            );
          })}
        </div>

        {/* ─── TAB: Generar Cuotas ────────────────────────────────────────── */}
        {tab === 'generar' && (
          <div style={cardStyle}>
            <h2 style={{ margin: '0 0 1.5rem 0', fontSize: '1.05rem', fontWeight: 700, color: 'var(--text)', display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
              <Zap size={18} style={{ color: '#fbbf24' }} />
              Generar Cuotas Masivo
            </h2>
            <p style={{ color: 'var(--text-dim)', fontSize: '0.85rem', marginBottom: '1.5rem' }}>
              Crea una cuota pendiente para cada socio activo del mes y año seleccionado.
              La operación es idempotente: no genera duplicados.
            </p>

            <form onSubmit={handleGenerar}>
              <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1rem', marginBottom: '1.5rem', maxWidth: '400px' }}>
                <div>
                  <label style={labelStyle}>Mes *</label>
                  <select value={genMes} onChange={e => setGenMes(e.target.value)} style={inputStyle}>
                    {MESES.map(m => <option key={m.val} value={m.val}>{m.label}</option>)}
                  </select>
                </div>
                <div>
                  <label style={labelStyle}>Año *</label>
                  <input type="number" min="2020" max="2099" value={genAnio}
                    onChange={e => setGenAnio(e.target.value)} style={inputStyle} />
                </div>
              </div>

              <button type="submit" disabled={genLoading} style={{
                background: 'linear-gradient(135deg,#d97706,#fbbf24)', color: '#fff',
                border: 'none', borderRadius: '10px', padding: '0.75rem 1.5rem',
                fontSize: '0.9rem', fontWeight: 700, cursor: 'pointer',
                display: 'flex', alignItems: 'center', gap: '0.5rem',
                boxShadow: '0 4px 14px rgba(217,119,6,0.3)',
              }}>
                {genLoading ? <><Loader2 className="animate-spin" size={18} /><span>Generando...</span></> : <><Zap size={18} /><span>Generar Cuotas</span></>}
              </button>
            </form>

            {genResult && (
              <div style={{
                marginTop: '1.5rem', padding: '1rem', borderRadius: '12px',
                background: genResult.ok ? 'rgba(16,185,129,0.1)' : 'rgba(239,68,68,0.1)',
                border: `1px solid ${genResult.ok ? 'rgba(16,185,129,0.2)' : 'rgba(239,68,68,0.2)'}`,
                color: genResult.ok ? '#10b981' : '#ef4444',
              }}>
                {genResult.ok ? (
                  <div>
                    <div style={{ fontWeight: 700, marginBottom: '0.25rem' }}>✓ {genResult.message}</div>
                    <div style={{ fontSize: '0.85rem', opacity: 0.85 }}>
                      {genResult.generados} cuotas generadas para {genResult.mes}/{genResult.anio}
                      {genResult.omitidos > 0 && ` · ${genResult.omitidos} omitidas (ya existían)`}
                    </div>
                  </div>
                ) : (
                  <div style={{ display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
                    <AlertCircle size={16} /><span>{genResult.message}</span>
                  </div>
                )}
              </div>
            )}
          </div>
        )}

        {/* ─── TAB: Lector de Barras ──────────────────────────────────────── */}
        {tab === 'barra' && (
          <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '1.5rem' }}>

            {/* Panel izquierdo: Ingreso */}
            <div style={cardStyle}>
              <h2 style={{ margin: '0 0 1.5rem 0', fontSize: '1.05rem', fontWeight: 700, color: 'var(--text)', display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
                <BarChart2 size={18} style={{ color: '#fbbf24' }} />
                Lector de Código de Barras
              </h2>

              <form onSubmit={handleBarra}>
                <div style={{ marginBottom: '1rem' }}>
                  <label style={labelStyle}>Código de Barras</label>
                  <input
                    ref={barraRef}
                    type="text"
                    placeholder="Escanear o escribir EAN-13..."
                    value={barra}
                    onChange={e => setBarra(e.target.value)}
                    autoFocus
                    style={{ ...inputStyle, fontSize: '1.1rem', padding: '0.75rem 1rem', letterSpacing: '0.05em' }}
                  />
                </div>

                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '0.75rem', marginBottom: '1.25rem' }}>
                  <div>
                    <label style={labelStyle}>Fecha de Pago</label>
                    <input type="date" value={barFecha} onChange={e => setBarFecha(e.target.value)} style={inputStyle} />
                  </div>
                  <div>
                    <label style={labelStyle}>Método de Pago</label>
                    <select value={barMetodo} onChange={e => setBarMetodo(e.target.value)} style={inputStyle}>
                      {METODOS.map(m => <option key={m} value={m}>{m}</option>)}
                    </select>
                  </div>
                </div>

                <button type="submit" disabled={barLoading || !barra.trim()} style={{
                  background: 'linear-gradient(135deg,#d97706,#fbbf24)', color: '#fff',
                  border: 'none', borderRadius: '10px', padding: '0.75rem 1.5rem',
                  fontSize: '0.9rem', fontWeight: 700, cursor: 'pointer', width: '100%',
                  display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '0.5rem',
                  opacity: (!barra.trim() ? 0.5 : 1),
                }}>
                  {barLoading ? <><Loader2 className="animate-spin" size={18} /><span>Procesando...</span></> : <><CheckCircle size={18} /><span>Registrar Pago</span></>}
                </button>
              </form>

              {/* Resultado de la barra */}
              {barResult && (
                <div style={{
                  marginTop: '1.25rem', padding: '1rem', borderRadius: '12px',
                  background: barResult.result === 'ACEPTADO' ? 'rgba(16,185,129,0.12)' :
                               barResult.result === 'YA_PAGADO' ? 'rgba(251,191,36,0.12)' :
                               'rgba(239,68,68,0.12)',
                  border: `1px solid ${barResult.result === 'ACEPTADO' ? 'rgba(16,185,129,0.25)' :
                               barResult.result === 'YA_PAGADO' ? 'rgba(251,191,36,0.25)' :
                               'rgba(239,68,68,0.25)'}`,
                }}>
                  <div style={{ display: 'flex', alignItems: 'center', gap: '0.6rem', marginBottom: barResult.result==='ACEPTADO' ? '0.5rem' : 0 }}>
                    {barResult.result === 'ACEPTADO' ? <CheckCircle size={20} style={{ color: '#10b981' }} /> :
                     barResult.result === 'YA_PAGADO' ? <AlertCircle size={20} style={{ color: '#fbbf24' }} /> :
                     <XCircle size={20} style={{ color: '#ef4444' }} />}
                    <span style={{
                      fontWeight: 700, fontSize: '1rem',
                      color: barResult.result === 'ACEPTADO' ? '#10b981' :
                             barResult.result === 'YA_PAGADO' ? '#fbbf24' : '#ef4444'
                    }}>
                      {barResult.result === 'ACEPTADO' ? 'PAGO ACEPTADO' :
                       barResult.result === 'YA_PAGADO' ? 'YA ESTABA PAGADO' : 'CÓDIGO INEXISTENTE'}
                    </span>
                  </div>
                  {barResult.result === 'ACEPTADO' && (
                    <div style={{ fontSize: '0.85rem', color: 'var(--text-dim)', paddingLeft: '1.6rem' }}>
                      <div>{barResult.socio?.apellido}, {barResult.socio?.nombre}</div>
                      <div>{barResult.mes_nombre || barResult.mes} {barResult.anio} — <strong>${parseFloat(barResult.importe||0).toFixed(2)}</strong></div>
                    </div>
                  )}
                  {(barResult.result !== 'ACEPTADO') && barResult.message && (
                    <div style={{ fontSize: '0.82rem', color: 'var(--text-dim)', paddingLeft: '1.6rem' }}>{barResult.message}</div>
                  )}
                </div>
              )}
            </div>

            {/* Panel derecho: últimos pagos del día */}
            <div style={cardStyle}>
              <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', marginBottom: '1.25rem' }}>
                <h2 style={{ margin: 0, fontSize: '1.05rem', fontWeight: 700, color: 'var(--text)', display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
                  <Clock size={18} style={{ color: '#fbbf24' }} />Últimos pagos del día
                </h2>
                <button onClick={cargarUltimos} style={{ all: 'unset', cursor: 'pointer', color: 'var(--text-dim)', display: 'flex', alignItems: 'center', gap: '0.3rem', fontSize: '0.78rem' }}>
                  <RefreshCw size={13} />Actualizar
                </button>
              </div>

              {ultimos.length === 0 ? (
                <p style={{ color: 'var(--text-dim)', fontSize: '0.85rem', textAlign: 'center', padding: '2rem 0' }}>
                  Sin pagos registrados hoy
                </p>
              ) : (
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.5rem', maxHeight: '380px', overflowY: 'auto' }}>
                  {ultimos.map(u => (
                    <div key={u.id} style={{
                      display: 'flex', justifyContent: 'space-between', alignItems: 'center',
                      padding: '0.65rem 0.75rem', borderRadius: '8px',
                      background: 'rgba(255,255,255,0.03)',
                      border: '1px solid rgba(255,255,255,0.05)',
                      fontSize: '0.82rem',
                    }}>
                      <div>
                        <div style={{ fontWeight: 600, color: 'var(--text)' }}>{u.socio}</div>
                        <div style={{ color: 'var(--text-dim)' }}>{u.mes_nombre} {u.anio} · {u.metodo_pago}</div>
                      </div>
                      <div style={{ textAlign: 'right' }}>
                        <div style={{ fontWeight: 700, color: '#10b981' }}>${parseFloat(u.importe||0).toFixed(2)}</div>
                        <div style={{ color: 'var(--text-dim)', fontSize: '0.75rem' }}>#{u.nro_boleta}</div>
                      </div>
                    </div>
                  ))}
                </div>
              )}
            </div>
          </div>
        )}

        {/* ─── TAB: Consulta ─────────────────────────────────────────────── */}
        {tab === 'consulta' && (
          <div style={cardStyle}>
            <h2 style={{ margin: '0 0 1.25rem 0', fontSize: '1.05rem', fontWeight: 700, color: 'var(--text)', display: 'flex', alignItems: 'center', gap: '0.5rem' }}>
              <Search size={18} style={{ color: '#fbbf24' }} />Consulta de Pagos
            </h2>

            <form onSubmit={handleConsulta}>
              <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr 2fr auto', gap: '0.75rem', alignItems: 'flex-end', marginBottom: '1.25rem' }}>
                <div>
                  <label style={labelStyle}>Mes</label>
                  <select value={conMes} onChange={e => setConMes(e.target.value)} style={inputStyle}>
                    {MESES.map(m => <option key={m.val} value={m.val}>{m.label}</option>)}
                  </select>
                </div>
                <div>
                  <label style={labelStyle}>Año</label>
                  <input type="number" min="2020" max="2099" value={conAnio}
                    onChange={e => setConAnio(e.target.value)} style={inputStyle} />
                </div>
                <div>
                  <label style={labelStyle}>Buscar socio</label>
                  <input type="text" placeholder="Nombre, apellido, domicilio..."
                    value={conSearch} onChange={e => setConSearch(e.target.value)} style={inputStyle} />
                </div>
                <button type="submit" disabled={conLoading} style={{
                  background: 'linear-gradient(135deg,#d97706,#fbbf24)', color: '#fff',
                  border: 'none', borderRadius: '8px', padding: '0.6rem 1.2rem',
                  fontSize: '0.875rem', fontWeight: 700, cursor: 'pointer', whiteSpace: 'nowrap',
                  display: 'flex', alignItems: 'center', gap: '0.4rem',
                }}>
                  {conLoading ? <Loader2 className="animate-spin" size={16} /> : <Search size={16} />}
                  Buscar
                </button>
              </div>
            </form>

            {conError && (
              <div style={{ padding: '0.75rem', background: 'rgba(239,68,68,0.1)', border: '1px solid rgba(239,68,68,0.2)', borderRadius: '8px', color: '#ef4444', fontSize: '0.85rem', marginBottom: '1rem' }}>
                {conError}
              </div>
            )}

            {conRows.length > 0 && (
              <>
                {/* Resumen */}
                <div style={{ display: 'flex', gap: '1rem', marginBottom: '1rem' }}>
                  {[
                    { label: 'Total', val: conRows.length, color: 'var(--text)' },
                    { label: 'Pagados', val: conRows.filter(r=>r.estado==='PAGADO').length, color: '#10b981' },
                    { label: 'Pendientes', val: conRows.filter(r=>r.estado==='PENDIENTE').length, color: '#fbbf24' },
                    { label: 'Recaudado', val: `$${conRows.filter(r=>r.estado==='PAGADO').reduce((s,r)=>s+r.importe,0).toFixed(2)}`, color: '#10b981' },
                  ].map(s => (
                    <div key={s.label} style={{ padding: '0.6rem 1rem', background: 'rgba(255,255,255,0.04)', borderRadius: '10px', border: '1px solid rgba(255,255,255,0.06)', flex: 1, textAlign: 'center' }}>
                      <div style={{ fontSize: '1.2rem', fontWeight: 800, color: s.color }}>{s.val}</div>
                      <div style={{ fontSize: '0.72rem', color: 'var(--text-dim)', textTransform: 'uppercase' }}>{s.label}</div>
                    </div>
                  ))}
                </div>

                {/* Tabla */}
                <div style={{ overflowX: 'auto' }}>
                  <table style={{ width: '100%', borderCollapse: 'collapse', fontSize: '0.82rem' }}>
                    <thead>
                      <tr style={{ borderBottom: '1px solid rgba(255,255,255,0.08)' }}>
                        {['#Boleta','Socio','Domicilio','Ruta','Importe','Estado','Método','Fecha Pago',''].map(h => (
                          <th key={h} style={{ padding: '0.5rem 0.75rem', textAlign: 'left', color: 'var(--text-dim)', fontWeight: 600, fontSize: '0.72rem', textTransform: 'uppercase', whiteSpace: 'nowrap' }}>{h}</th>
                        ))}
                      </tr>
                    </thead>
                    <tbody>
                      {conRows.map((r, i) => {
                        const b = badge(r.estado);
                        return (
                          <tr key={r.pago_id || i} style={{ borderBottom: '1px solid rgba(255,255,255,0.04)', transition: 'background 0.15s' }}
                            onMouseEnter={e => e.currentTarget.style.background='rgba(255,255,255,0.03)'}
                            onMouseLeave={e => e.currentTarget.style.background='transparent'}>
                            <td style={{ padding: '0.65rem 0.75rem', color: 'var(--text-dim)' }}>{r.nro_boleta}</td>
                            <td style={{ padding: '0.65rem 0.75rem' }}>
                              <div style={{ fontWeight: 600, color: 'var(--text)' }}>{r.apellido}, {r.nombre}</div>
                              <div style={{ color: 'var(--text-dim)', fontSize: '0.75rem' }}>{r.telefono}</div>
                            </td>
                            <td style={{ padding: '0.65rem 0.75rem', color: 'var(--text-dim)' }}>{r.domicilio}</td>
                            <td style={{ padding: '0.65rem 0.75rem', color: 'var(--text-dim)', fontWeight: 600 }}>{r.ruta || '—'}</td>
                            <td style={{ padding: '0.65rem 0.75rem', fontWeight: 700, color: 'var(--text)' }}>${r.importe?.toFixed(2)}</td>
                            <td style={{ padding: '0.65rem 0.75rem' }}>
                              <span style={{ background: b.bg, color: b.color, borderRadius: '6px', padding: '0.2rem 0.55rem', fontWeight: 600, fontSize: '0.72rem' }}>{b.label}</span>
                            </td>
                            <td style={{ padding: '0.65rem 0.75rem', color: 'var(--text-dim)' }}>{r.metodo_pago || '—'}</td>
                            <td style={{ padding: '0.65rem 0.75rem', color: 'var(--text-dim)' }}>{r.fecha_pago || '—'}</td>
                            <td style={{ padding: '0.65rem 0.75rem' }}>
                              {r.estado === 'PENDIENTE' && (
                                <button onClick={() => { setManualRow(r); setManualOpen(true); }} style={{
                                  all: 'unset', cursor: 'pointer', background: 'rgba(16,185,129,0.12)', color: '#10b981',
                                  border: '1px solid rgba(16,185,129,0.25)', borderRadius: '6px', padding: '0.25rem 0.6rem',
                                  fontSize: '0.75rem', fontWeight: 600,
                                }}>Cobrar</button>
                              )}
                            </td>
                          </tr>
                        );
                      })}
                    </tbody>
                  </table>
                </div>
              </>
            )}

            {!conLoading && conRows.length === 0 && !conError && (
              <p style={{ color: 'var(--text-dim)', textAlign: 'center', padding: '2.5rem 0', fontSize: '0.9rem' }}>
                Seleccioná un mes y año y presioná Buscar
              </p>
            )}
          </div>
        )}
      </div>

      {/* ─── Modal: Pago Manual ────────────────────────────────────────────── */}
      {manualOpen && manualRow && (
        <div style={{
          position: 'fixed', top: 0, left: 0, right: 0, bottom: 0,
          background: 'rgba(0,0,0,0.75)', backdropFilter: 'blur(8px)',
          zIndex: 10000, display: 'flex', alignItems: 'center', justifyContent: 'center', padding: '1rem',
        }}>
          <div style={{ background: '#0f172a', border: '1px solid rgba(255,255,255,0.1)', borderRadius: '16px', padding: '2rem', width: '100%', maxWidth: '440px' }}>
            <h3 style={{ margin: '0 0 0.5rem 0', color: 'var(--text)', fontWeight: 700 }}>Registrar Pago</h3>
            <p style={{ margin: '0 0 1.5rem 0', color: 'var(--text-dim)', fontSize: '0.85rem' }}>
              {manualRow.apellido}, {manualRow.nombre} — {MESES.find(m=>m.val===conMes)?.label} {conAnio}
            </p>

            <div style={{ marginBottom: '1.25rem' }}>
              <label style={labelStyle}>Importe</label>
              <div style={{ ...inputStyle, background: 'rgba(0,0,0,0.3)', color: '#fbbf24', fontWeight: 700 }}>
                ${manualRow.importe?.toFixed(2)}
              </div>
            </div>

            <div style={{ marginBottom: '1.5rem' }}>
              <label style={labelStyle}>Método de Pago</label>
              <select value={manualMetodo} onChange={e => setManualMetodo(e.target.value)} style={inputStyle}>
                {METODOS.map(m => <option key={m} value={m}>{m}</option>)}
              </select>
            </div>

            <div style={{ display: 'flex', gap: '0.75rem' }}>
              <button onClick={() => { setManualOpen(false); setManualRow(null); }} style={{
                all: 'unset', cursor: 'pointer', flex: 1, textAlign: 'center',
                padding: '0.7rem', background: 'rgba(255,255,255,0.06)',
                border: '1px solid rgba(255,255,255,0.1)', borderRadius: '8px',
                color: 'var(--text-dim)', fontWeight: 600, fontSize: '0.875rem',
              }}>Cancelar</button>
              <button onClick={handlePagarManual} disabled={manualLoading} style={{
                all: 'unset', cursor: 'pointer', flex: 1, textAlign: 'center',
                padding: '0.7rem', background: 'linear-gradient(135deg,#059669,#10b981)',
                borderRadius: '8px', color: '#fff', fontWeight: 700, fontSize: '0.875rem',
                display: 'flex', alignItems: 'center', justifyContent: 'center', gap: '0.5rem',
              }}>
                {manualLoading ? <Loader2 className="animate-spin" size={16} /> : <CheckCircle size={16} />}
                Confirmar Pago
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
