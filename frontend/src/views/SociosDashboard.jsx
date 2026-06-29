import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { API_URL } from '../config';
import {
  Search,
  Users,
  ChevronRight,
  TrendingUp,
  ClipboardList,
  Stethoscope,
  FileText,
  Shuffle,
} from 'lucide-react';

/* ─── Stats mini-card ─────────────────────────────────────── */
const StatChip = ({ label, value, color }) => (
  <div style={{
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    padding: '1rem 1.5rem',
    background: 'rgba(255,255,255,0.04)',
    border: `1px solid ${color}33`,
    borderRadius: '12px',
    minWidth: '120px',
    flex: 1,
  }}>
    <span style={{ fontSize: '1.75rem', fontWeight: 800, color, lineHeight: 1 }}>
      {value === null ? '…' : value?.toLocaleString('es-AR')}
    </span>
    <span style={{ fontSize: '0.72rem', color: 'var(--text-dim)', marginTop: '4px', textTransform: 'uppercase', letterSpacing: '0.06em' }}>
      {label}
    </span>
  </div>
);

/* ─── Action card ────────────────────────────────────────── */
const ActionCard = ({ icon: Icon, title, description, color, gradient, onClick, badge }) => (
  <button
    onClick={onClick}
    style={{
      all: 'unset',
      cursor: 'pointer',
      display: 'flex',
      flexDirection: 'column',
      gap: '1rem',
      padding: '1.5rem',
      background: 'rgba(255,255,255,0.03)',
      border: `1px solid rgba(255,255,255,0.08)`,
      borderRadius: '16px',
      transition: 'all 0.25s cubic-bezier(0.4,0,0.2,1)',
      position: 'relative',
      overflow: 'hidden',
      textAlign: 'left',
      width: '100%',
      boxSizing: 'border-box',
    }}
    onMouseEnter={e => {
      e.currentTarget.style.background = `${color}10`;
      e.currentTarget.style.borderColor = `${color}55`;
      e.currentTarget.style.transform = 'translateY(-4px)';
      e.currentTarget.style.boxShadow = `0 16px 40px -12px ${color}30`;
    }}
    onMouseLeave={e => {
      e.currentTarget.style.background = 'rgba(255,255,255,0.03)';
      e.currentTarget.style.borderColor = 'rgba(255,255,255,0.08)';
      e.currentTarget.style.transform = 'translateY(0)';
      e.currentTarget.style.boxShadow = 'none';
    }}
  >
    {/* Glow orb */}
    <div style={{
      position: 'absolute',
      top: '-30px',
      right: '-30px',
      width: '100px',
      height: '100px',
      background: gradient,
      borderRadius: '50%',
      filter: 'blur(40px)',
      opacity: 0.25,
      pointerEvents: 'none',
    }} />

    {/* Icon */}
    <div style={{
      width: '48px',
      height: '48px',
      borderRadius: '12px',
      background: gradient,
      display: 'flex',
      alignItems: 'center',
      justifyContent: 'center',
      flexShrink: 0,
      boxShadow: `0 4px 14px ${color}40`,
    }}>
      <Icon size={22} color="#fff" />
    </div>

    {/* Content */}
    <div style={{ flex: 1 }}>
      <div style={{
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        marginBottom: '4px',
      }}>
        <span style={{ fontWeight: 700, fontSize: '1rem', color: 'var(--text)' }}>{title}</span>
        {badge !== undefined && (
          <span style={{
            background: `${color}22`,
            color,
            border: `1px solid ${color}44`,
            borderRadius: '20px',
            padding: '2px 8px',
            fontSize: '0.72rem',
            fontWeight: 700,
          }}>{badge}</span>
        )}
      </div>
      <p style={{ fontSize: '0.82rem', color: 'var(--text-dim)', margin: 0, lineHeight: 1.5 }}>
        {description}
      </p>
    </div>

    {/* Arrow */}
    <ChevronRight size={16} style={{ position: 'absolute', bottom: '1.5rem', right: '1.5rem', color, opacity: 0.6 }} />
  </button>
);

/* ─── Main Dashboard ─────────────────────────────────────── */
const SociosDashboard = ({ currentUser, onNavigate }) => {
  const [stats, setStats] = useState({ socios: null, mascotas: null, particulares: null });

  useEffect(() => {
    const fetchStats = async () => {
      try {
        const [r1, r2, r3] = await Promise.allSettled([
          axios.get(`${API_URL}/socios`, { params: { page: 1, limit: 1 } }),
          axios.get(`${API_URL}/mascotas`, { params: { page: 1, limit: 1 } }),
          axios.get(`${API_URL}/particulares`, { params: { page: 1, limit: 1 } }),
        ]);
        setStats({
          socios: r1.status === 'fulfilled' ? r1.value.data.total : '—',
          mascotas: r2.status === 'fulfilled' ? r2.value.data.total : '—',
          particulares: r3.status === 'fulfilled' ? r3.value.data.total : '—',
        });
      } catch (_) { /* silencioso */ }
    };
    fetchStats();
  }, []);

  const cards = [
    {
      icon: Search,
      title: 'Buscar / Listar Socios',
      description: 'Consultar, registrar, editar y gestionar socios existentes en el padrón.',
      color: '#38bdf8',
      gradient: 'linear-gradient(135deg,#0284c7,#38bdf8)',
      action: 'list-socios',
      badge: stats.socios,
      show: true,
    },
    {
      icon: ClipboardList,
      title: 'Buscar / Listar Particulares',
      description: 'Consultar, registrar y gestionar clientes particulares registrados.',
      color: '#a78bfa',
      gradient: 'linear-gradient(135deg,#7c3aed,#a78bfa)',
      action: 'list-particulares',
      badge: stats.particulares,
      show: true,
    },
    {
      icon: Stethoscope,
      title: 'Buscar / Listar Mascotas',
      description: 'Consultar fichas, registrar y ver el historial clínico de cada mascota.',
      color: '#34d399',
      gradient: 'linear-gradient(135deg,#059669,#34d399)',
      action: 'list-mascotas',
      badge: stats.mascotas,
      show: true,
    },
    {
      icon: FileText,
      title: 'Informes y Reportes',
      description: 'Generar listados de rutas, socios, locales y boletas de facturación en PDF.',
      color: '#fbbf24',
      gradient: 'linear-gradient(135deg,#d97706,#fbbf24)',
      action: 'informes',
      show: true,
    },
    {
      icon: Shuffle,
      title: 'Acomodar Ruta',
      description: 'Reordenar la secuencia de cobro de un socio dentro de una ruta.',
      color: '#f43f5e',
      gradient: 'linear-gradient(135deg,#e11d48,#f43f5e)',
      action: 'acomodar-ruta',
      show: true,
    },
  ].filter(c => c.show);

  return (
    <div className="view-container">
      <div style={{ maxWidth: '1100px', margin: '0 auto', width: '100%' }}>

        {/* Header hero */}
        <div style={{ marginBottom: '2.5rem' }}>
          <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem', marginBottom: '0.5rem' }}>
            <div style={{
              width: '42px', height: '42px', borderRadius: '12px',
              background: 'linear-gradient(135deg,#0284c7,#38bdf8)',
              display: 'flex', alignItems: 'center', justifyContent: 'center',
              boxShadow: '0 4px 14px rgba(56,189,248,0.35)',
            }}>
              <Users size={20} color="#fff" />
            </div>
            <div>
              <h1 style={{ margin: 0, fontSize: '1.6rem', fontWeight: 800, lineHeight: 1.2 }}>
                Gestión de Socios
              </h1>
              <p style={{ margin: 0, color: 'var(--text-dim)', fontSize: '0.85rem' }}>
                Administración de socios, particulares y mascotas
              </p>
            </div>
          </div>
        </div>

        {/* Stats chips */}
        <div style={{
          display: 'flex',
          gap: '1rem',
          flexWrap: 'wrap',
          marginBottom: '2.5rem',
          padding: '1.25rem',
          background: 'rgba(255,255,255,0.02)',
          border: '1px solid rgba(255,255,255,0.07)',
          borderRadius: '16px',
        }}>
          <StatChip label="Socios" value={stats.socios} color="#38bdf8" />
          <StatChip label="Particulares" value={stats.particulares} color="#a78bfa" />
          <StatChip label="Mascotas" value={stats.mascotas} color="#34d399" />
          <div style={{
            flex: 2,
            minWidth: '200px',
            display: 'flex',
            alignItems: 'center',
            gap: '0.6rem',
            padding: '0 1rem',
            color: 'var(--text-dim)',
            fontSize: '0.8rem',
            borderLeft: '1px solid rgba(255,255,255,0.07)',
          }}>
            <TrendingUp size={16} style={{ color: '#34d399', flexShrink: 0 }} />
            <span>Seleccioná una acción para comenzar a trabajar con el módulo de socios.</span>
          </div>
        </div>

        {/* Section title */}
        <div style={{
          display: 'flex',
          alignItems: 'center',
          gap: '0.5rem',
          marginBottom: '1.25rem',
        }}>
          <div style={{ width: '3px', height: '18px', background: '#38bdf8', borderRadius: '2px' }} />
          <span style={{ fontWeight: 700, fontSize: '0.85rem', color: 'var(--text-dim)', textTransform: 'uppercase', letterSpacing: '0.08em' }}>
            Acciones disponibles
          </span>
        </div>

        {/* Cards grid */}
        <div style={{
          display: 'grid',
          gridTemplateColumns: 'repeat(auto-fill, minmax(300px, 1fr))',
          gap: '1rem',
        }}>
          {cards.map(card => (
            <ActionCard
              key={card.action}
              icon={card.icon}
              title={card.title}
              description={card.description}
              color={card.color}
              gradient={card.gradient}
              badge={card.badge}
              onClick={() => onNavigate(card.action)}
            />
          ))}
        </div>
      </div>
    </div>
  );
};

export default SociosDashboard;
