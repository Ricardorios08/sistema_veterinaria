import React, { useState } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import {
  ArrowLeft,
  FileText,
  Printer,
  Calendar,
  AlertCircle,
  X,
  FileDown,
  Loader2,
  BookOpen,
  MapPin,
  Map,
} from 'lucide-react';

const getSpanishMonth = (date) => {
  const months = [
    'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
    'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
  ];
  return months[date.getMonth()];
};

const InformesSocios = ({ currentUser, onBack }) => {
  // Report options
  const [desde, setDesde] = useState('');
  const [hasta, setHasta] = useState('');
  const [mesFac, setMesFac] = useState(getSpanishMonth(new Date()));
  const [anioFac, setAnioFac] = useState(String(new Date().getFullYear()));
  const [fechaFac, setFechaFac] = useState(new Date().toISOString().split('T')[0]);
  const [observaciones, setObservaciones] = useState('');

  // UI State
  const [loading, setLoading] = useState(false);
  const [pdfUrl, setPdfUrl] = useState(null);
  const [pdfTitle, setPdfTitle] = useState('');
  const [error, setError] = useState(null);

  // Fetch and show PDF in the modal viewer
  const fetchPdf = async (endpoint, params = {}, title = 'Informe') => {
    try {
      setLoading(true);
      setError(null);
      const token = localStorage.getItem('sulb_token');
      
      const response = await axios.get(`${API_URL}${endpoint}`, {
        params,
        responseType: 'blob',
        headers: {
          Authorization: `Bearer ${token}`
        }
      });

      const file = new Blob([response.data], { type: 'application/pdf' });
      const fileURL = URL.createObjectURL(file);
      setPdfUrl(fileURL);
      setPdfTitle(title);
    } catch (err) {
      console.error(err);
      setError('Ocurrió un error al generar el reporte PDF. Por favor, intente de nuevo.');
    } finally {
      setLoading(false);
    }
  };

  const handleCloseModal = () => {
    if (pdfUrl) {
      URL.revokeObjectURL(pdfUrl);
    }
    setPdfUrl(null);
    setPdfTitle('');
  };

  const handleFacturacionSubmit = (e) => {
    e.preventDefault();
    if (!desde || !hasta) {
      setError('Por favor, especifique el rango de rutas.');
      return;
    }
    fetchPdf(
      '/socios/informe/facturacion',
      { desde, hasta, mes_fac: mesFac, anio: anioFac, fecha_fac: fechaFac, observaciones },
      `Boletas de Facturación - Ruta ${desde} a ${hasta}`
    );
  };

  return (
    <div className="view-container">
      <div style={{ maxWidth: '1000px', margin: '0 auto', width: '100%' }}>
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
            Informes y Reportes de Socios
          </h1>
          <p style={{ margin: '0.25rem 0 0 0', color: 'var(--text-dim)', fontSize: '0.9rem' }}>
            Generación de planillas, padrones y boletas de cobranza en formato PDF.
          </p>
        </div>

        {error && (
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
              marginBottom: '2rem',
              fontSize: '0.875rem',
            }}
          >
            <AlertCircle size={18} style={{ flexShrink: 0 }} />
            <span>{error}</span>
          </div>
        )}

        <div style={{ display: 'grid', gridTemplateColumns: '1fr', gap: '2rem' }}>
          {/* Section 1: Standard Reports */}
          <div
            style={{
              background: 'rgba(255, 255, 255, 0.02)',
              border: '1px solid rgba(255, 255, 255, 0.08)',
              borderRadius: '16px',
              padding: '1.75rem',
            }}
          >
            <h2
              style={{
                margin: '0 0 1.25rem 0',
                fontSize: '1.1rem',
                fontWeight: 700,
                color: 'var(--text)',
                display: 'flex',
                alignItems: 'center',
                gap: '0.5rem',
              }}
            >
              <FileText size={18} style={{ color: '#fbbf24' }} />
              Listados Rápidos
            </h2>

            <div
              style={{
                display: 'grid',
                gridTemplateColumns: 'repeat(auto-fit, minmax(250px, 1fr))',
                gap: '1rem',
              }}
            >
              {/* Report 1 */}
              <button
                onClick={() => fetchPdf('/socios/informe/rutas', {}, 'Listado de Rutas de Control')}
                disabled={loading}
                style={{
                  all: 'unset',
                  cursor: 'pointer',
                  padding: '1.25rem',
                  background: 'rgba(255,255,255,0.03)',
                  border: '1px solid rgba(255,255,255,0.06)',
                  borderRadius: '12px',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '1rem',
                  transition: 'all 0.2s',
                  boxSizing: 'border-box',
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.background = 'rgba(255,255,255,0.06)';
                  e.currentTarget.style.borderColor = 'rgba(251, 191, 36, 0.4)';
                  e.currentTarget.style.transform = 'translateY(-2px)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.background = 'rgba(255,255,255,0.03)';
                  e.currentTarget.style.borderColor = 'rgba(255,255,255,0.06)';
                  e.currentTarget.style.transform = 'translateY(0)';
                }}
              >
                <div
                  style={{
                    width: '40px',
                    height: '40px',
                    borderRadius: '8px',
                    background: 'rgba(251, 191, 36, 0.1)',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    color: '#fbbf24',
                  }}
                >
                  <MapPin size={20} />
                </div>
                <div>
                  <div style={{ fontWeight: 600, fontSize: '0.9rem', color: 'var(--text)' }}>
                    Rutas de Control
                  </div>
                  <div style={{ fontSize: '0.75rem', color: 'var(--text-dim)', marginTop: '2px' }}>
                    Ordenado por ruta y socio.
                  </div>
                </div>
              </button>

              {/* Report 2 */}
              <button
                onClick={() => fetchPdf('/socios/informe/socios', {}, 'Listado de Socios')}
                disabled={loading}
                style={{
                  all: 'unset',
                  cursor: 'pointer',
                  padding: '1.25rem',
                  background: 'rgba(255,255,255,0.03)',
                  border: '1px solid rgba(255,255,255,0.06)',
                  borderRadius: '12px',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '1rem',
                  transition: 'all 0.2s',
                  boxSizing: 'border-box',
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.background = 'rgba(255,255,255,0.06)';
                  e.currentTarget.style.borderColor = 'rgba(251, 191, 36, 0.4)';
                  e.currentTarget.style.transform = 'translateY(-2px)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.background = 'rgba(255,255,255,0.03)';
                  e.currentTarget.style.borderColor = 'rgba(255,255,255,0.06)';
                  e.currentTarget.style.transform = 'translateY(0)';
                }}
              >
                <div
                  style={{
                    width: '40px',
                    height: '40px',
                    borderRadius: '8px',
                    background: 'rgba(251, 191, 36, 0.1)',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    color: '#fbbf24',
                  }}
                >
                  <BookOpen size={20} />
                </div>
                <div>
                  <div style={{ fontWeight: 600, fontSize: '0.9rem', color: 'var(--text)' }}>
                    Padrón de Socios
                  </div>
                  <div style={{ fontSize: '0.75rem', color: 'var(--text-dim)', marginTop: '2px' }}>
                    Ordenado correlativo por código de socio.
                  </div>
                </div>
              </button>

              {/* Report 3 */}
              <button
                onClick={() => fetchPdf('/socios/informe/local', {}, 'Listado Local')}
                disabled={loading}
                style={{
                  all: 'unset',
                  cursor: 'pointer',
                  padding: '1.25rem',
                  background: 'rgba(255,255,255,0.03)',
                  border: '1px solid rgba(255,255,255,0.06)',
                  borderRadius: '12px',
                  display: 'flex',
                  alignItems: 'center',
                  gap: '1rem',
                  transition: 'all 0.2s',
                  boxSizing: 'border-box',
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.background = 'rgba(255,255,255,0.06)';
                  e.currentTarget.style.borderColor = 'rgba(251, 191, 36, 0.4)';
                  e.currentTarget.style.transform = 'translateY(-2px)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.background = 'rgba(255,255,255,0.03)';
                  e.currentTarget.style.borderColor = 'rgba(255,255,255,0.06)';
                  e.currentTarget.style.transform = 'translateY(0)';
                }}
              >
                <div
                  style={{
                    width: '40px',
                    height: '40px',
                    borderRadius: '8px',
                    background: 'rgba(251, 191, 36, 0.1)',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    color: '#fbbf24',
                  }}
                >
                  <Map size={20} />
                </div>
                <div>
                  <div style={{ fontWeight: 600, fontSize: '0.9rem', color: 'var(--text)' }}>
                    Listado Local
                  </div>
                  <div style={{ fontSize: '0.75rem', color: 'var(--text-dim)', marginTop: '2px' }}>
                    Socios sin impresión cobro, por ruta.
                  </div>
                </div>
              </button>
            </div>
          </div>

          {/* Section 2: Billing / Boletas Form */}
          <div
            style={{
              background: 'rgba(255, 255, 255, 0.02)',
              border: '1px solid rgba(255, 255, 255, 0.08)',
              borderRadius: '16px',
              padding: '1.75rem',
            }}
          >
            <h2
              style={{
                margin: '0 0 1.25rem 0',
                fontSize: '1.1rem',
                fontWeight: 700,
                color: 'var(--text)',
                display: 'flex',
                alignItems: 'center',
                gap: '0.5rem',
              }}
            >
              <Printer size={18} style={{ color: '#fbbf24' }} />
              Facturación - Boletas de Cuotas
            </h2>

            <form onSubmit={handleFacturacionSubmit}>
              <div
                style={{
                  display: 'grid',
                  gridTemplateColumns: 'repeat(auto-fit, minmax(200px, 1fr))',
                  gap: '1rem',
                  marginBottom: '1.25rem',
                }}
              >
                {/* Desde */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem' }}>
                  <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                    Ruta Desde *
                  </label>
                  <input
                    type="number"
                    required
                    placeholder="Ej. 1"
                    value={desde}
                    onChange={(e) => setDesde(e.target.value)}
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

                {/* Hasta */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem' }}>
                  <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                    Ruta Hasta *
                  </label>
                  <input
                    type="number"
                    required
                    placeholder="Ej. 99"
                    value={hasta}
                    onChange={(e) => setHasta(e.target.value)}
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

                {/* Mes */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem' }}>
                  <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                    Mes Facturación *
                  </label>
                  <input
                    type="text"
                    required
                    placeholder="Ej. JUNIO"
                    value={mesFac}
                    onChange={(e) => setMesFac(e.target.value.toUpperCase())}
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

                {/* Año */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem' }}>
                  <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                    Año *
                  </label>
                  <input
                    type="number"
                    required
                    min="2000"
                    max="2099"
                    placeholder="Ej. 2026"
                    value={anioFac}
                    onChange={(e) => setAnioFac(e.target.value)}
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

                {/* Fecha */}
                <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem' }}>
                  <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                    Fecha Emisión *
                  </label>
                  <input
                    type="date"
                    required
                    value={fechaFac}
                    onChange={(e) => setFechaFac(e.target.value)}
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
              </div>

              {/* Observaciones */}
              <div style={{ display: 'flex', flexDirection: 'column', gap: '0.35rem', marginBottom: '1.5rem' }}>
                <label style={{ fontSize: '0.75rem', color: 'var(--text-dim)', fontWeight: 600, textTransform: 'uppercase' }}>
                  Observaciones Generales (Se imprimen en la boleta)
                </label>
                <input
                  type="text"
                  placeholder="Ej. Vencimiento el 10 de cada mes."
                  value={observaciones}
                  onChange={(e) => setObservaciones(e.target.value)}
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

              {/* Action Button */}
              <button
                type="submit"
                disabled={loading}
                style={{
                  background: 'linear-gradient(135deg, #d97706, #fbbf24)',
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
                  boxShadow: '0 4px 14px rgba(217, 119, 6, 0.3)',
                  transition: 'opacity 0.2s',
                }}
                onMouseEnter={(e) => (e.currentTarget.style.opacity = '0.9')}
                onMouseLeave={(e) => (e.currentTarget.style.opacity = '1')}
              >
                {loading ? (
                  <>
                    <Loader2 className="animate-spin" size={18} />
                    <span>Generando...</span>
                  </>
                ) : (
                  <>
                    <Printer size={18} />
                    <span>Generar Boletas PDF</span>
                  </>
                )}
              </button>
            </form>
          </div>
        </div>
      </div>

      {/* Global loading cover */}
      {loading && (
        <div
          style={{
            position: 'fixed',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: 'rgba(0,0,0,0.6)',
            zIndex: 99999,
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            flexDirection: 'column',
            gap: '1rem',
            backdropFilter: 'blur(3px)',
          }}
        >
          <Loader2 className="animate-spin" size={40} style={{ color: '#fbbf24' }} />
          <span style={{ color: '#fff', fontSize: '0.95rem', fontWeight: 600 }}>Generando reporte PDF...</span>
        </div>
      )}

      {/* PDF Modal Viewer (modalviewer) */}
      {pdfUrl && (
        <div
          style={{
            position: 'fixed',
            top: 0,
            left: 0,
            right: 0,
            bottom: 0,
            background: 'rgba(0, 0, 0, 0.85)',
            backdropFilter: 'blur(8px)',
            zIndex: 10000,
            display: 'flex',
            justifyContent: 'center',
            alignItems: 'center',
            padding: '1.5rem',
          }}
        >
          <div
            style={{
              background: '#0f172a',
              border: '1px solid rgba(255, 255, 255, 0.1)',
              borderRadius: '16px',
              width: '100%',
              height: '100%',
              maxWidth: '1100px',
              display: 'flex',
              flexDirection: 'column',
              overflow: 'hidden',
              boxShadow: '0 24px 60px -15px rgba(0,0,0,0.7)',
            }}
          >
            {/* Modal Header */}
            <div
              style={{
                padding: '1rem 1.5rem',
                borderBottom: '1px solid rgba(255, 255, 255, 0.08)',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'space-between',
              }}
            >
              <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem' }}>
                <FileText size={20} style={{ color: '#fbbf24' }} />
                <span style={{ fontWeight: 700, fontSize: '1.05rem', color: '#fff' }}>{pdfTitle}</span>
              </div>
              
              <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem' }}>
                <a
                  href={pdfUrl}
                  download={`${pdfTitle.replace(/\s+/g, '_')}.pdf`}
                  style={{
                    all: 'unset',
                    cursor: 'pointer',
                    display: 'flex',
                    alignItems: 'center',
                    gap: '0.4rem',
                    background: 'rgba(255,255,255,0.05)',
                    border: '1px solid rgba(255,255,255,0.1)',
                    borderRadius: '8px',
                    padding: '0.4rem 0.8rem',
                    fontSize: '0.78rem',
                    fontWeight: 600,
                    color: '#e2e8f0',
                    transition: 'all 0.2s',
                  }}
                  onMouseEnter={(e) => (e.currentTarget.style.background = 'rgba(255,255,255,0.1)')}
                  onMouseLeave={(e) => (e.currentTarget.style.background = 'rgba(255,255,255,0.05)')}
                >
                  <FileDown size={14} />
                  <span>Descargar</span>
                </a>
                
                <button
                  onClick={handleCloseModal}
                  style={{
                    all: 'unset',
                    cursor: 'pointer',
                    width: '32px',
                    height: '32px',
                    borderRadius: '8px',
                    background: 'rgba(255,255,255,0.05)',
                    border: '1px solid rgba(255,255,255,0.08)',
                    display: 'flex',
                    alignItems: 'center',
                    justifyContent: 'center',
                    color: 'var(--text-dim)',
                    transition: 'all 0.2s',
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.background = 'rgba(239, 68, 68, 0.15)';
                    e.currentTarget.style.color = '#ef4444';
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.background = 'rgba(255,255,255,0.05)';
                    e.currentTarget.style.color = 'var(--text-dim)';
                  }}
                >
                  <X size={16} />
                </button>
              </div>
            </div>

            {/* Modal Body / iframe */}
            <div style={{ flex: 1, background: '#1e293b', position: 'relative' }}>
              <iframe
                src={`${pdfUrl}#toolbar=1`}
                title={pdfTitle}
                style={{
                  width: '100%',
                  height: '100%',
                  border: 'none',
                }}
              />
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default InformesSocios;
