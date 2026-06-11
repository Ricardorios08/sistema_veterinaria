import React from 'react';
import { 
  ChevronRight, 
  PanelLeftClose, 
  PanelLeftOpen, 
  Users, 
  LogOut, 
  UserCircle,
  FileText,
  Calendar,
  Activity,
  Heart,
  Clock,
  Building
} from 'lucide-react';

import { API_URL } from '../config';

const Sidebar = ({ currentView, setView, collapsed, setCollapsed, mobileOpen, setMobileOpen, user, onLogout }) => {
  const isAdmin = user?.rol === 'admin';
  const isSuperAdmin = user?.rol === 'superadmin';
  const isProfesional = user?.rol === 'profesional';
  const isRecepcion = user?.rol === 'recepcion';
  const hasAccessToAppointments = isRecepcion || isProfesional;
  const hasAccessToWaitingList = isProfesional || isRecepcion;
  const hasAccessToPatients = isProfesional || isRecepcion;
  const hasAccessToNomenclature = isRecepcion || isProfesional;
  const hasAccessToObrasSociales = isRecepcion || isProfesional;
  const hasAccessToUsers = isAdmin || isSuperAdmin;

  const roles = user?.roles || (user?.rol ? [user.rol] : []);

  const handleRoleChange = async (newRole) => {
    try {
      const token = localStorage.getItem('sulb_token');
      const response = await fetch(`${API_URL}/auth/switch-role`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify({ rol: newRole })
      });
      if (!response.ok) {
        throw new Error('Error al cambiar de rol');
      }
      const data = await response.json();
      localStorage.setItem('sulb_token', data.token);
      localStorage.setItem('sulb_user', JSON.stringify(data.user));
      window.location.reload();
    } catch (e) {
      alert(e.message || 'Error al cambiar de rol');
    }
  };

  return (
    <aside className={`sidebar ${collapsed ? 'collapsed' : ''} ${mobileOpen ? 'mobile-open' : ''}`}>
      <div className="sidebar-header" style={{ display: 'flex', alignItems: 'center', justifyContent: collapsed ? 'center' : 'flex-start', padding: collapsed ? '10px 0' : '10px 15px', gap: '15px' }}>
        <button
          className="collapse-toggle"
          onClick={() => setCollapsed(!collapsed)}
          title={collapsed ? "Expandir" : "Colapsar"}
          style={{ flexShrink: 0 }}
        >
          {collapsed ? <PanelLeftOpen size={18} /> : <PanelLeftClose size={18} />}
        </button>
        {!collapsed && (
          <div style={{ display: 'flex', alignItems: 'center', gap: '10px' }}>
            <img src="/favicon.png" alt="Logo" style={{ width: '24px', height: '24px', objectFit: 'contain' }} />
            <span style={{ fontWeight: 'bold', fontSize: '1.1rem' }}>Portal</span>
          </div>
        )}
      </div>

      <nav className="sidebar-menu">
        {/* Agenda y Turnos (Admins y Recepción) */}
        {hasAccessToAppointments && (
          <div
            className={`menu-item appointments ${currentView === 'appointments' ? 'active' : ''}`}
            onClick={() => setView('appointments')}
            title={collapsed ? "Agenda" : ""}
          >
            <Calendar size={20} />
            {!collapsed && <span>Agenda / Turnos</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.5 }} />}
          </div>
        )}

        {/* Lista de Espera (Admins, Profesionales y Recepción) */}
        {hasAccessToWaitingList && (
          <div
            className={`menu-item waiting-list ${currentView === 'waiting-list' ? 'active' : ''}`}
            onClick={() => setView('waiting-list')}
            title={collapsed ? "Lista de Espera" : ""}
          >
            <Clock size={20} />
            {!collapsed && <span>Lista de Espera</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.5 }} />}
          </div>
        )}

        {/* Fichero de Pacientes (Admins, Profesionales y Recepción) */}
        {hasAccessToPatients && (
          <div
            className={`menu-item patients ${currentView === 'patients' ? 'active' : ''}`}
            onClick={() => setView('patients')}
            title={collapsed ? "Pacientes" : ""}
          >
            <Users size={20} />
            {!collapsed && <span>Pacientes</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.5 }} />}
          </div>
        )}

        {/* Nomenclador de Prácticas (Admins y Recepción) */}
        {hasAccessToNomenclature && (
          <div
            className={`menu-item nomenclature ${currentView === 'nomenclature' ? 'active' : ''}`}
            onClick={() => setView('nomenclature')}
            title={collapsed ? "Nomenclador" : ""}
          >
            <Activity size={20} />
            {!collapsed && <span>Nomenclador</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.5 }} />}
          </div>
        )}

        {/* Obras Sociales (Admins y Recepción) */}
        {hasAccessToObrasSociales && (
          <div
            className={`menu-item obras-sociales ${currentView === 'obras-sociales' ? 'active' : ''}`}
            onClick={() => setView('obras-sociales')}
            title={collapsed ? "Obras Sociales" : ""}
          >
            <Heart size={20} />
            {!collapsed && <span>Obras Sociales</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.5 }} />}
          </div>
        )}

        <div className="sidebar-separator" style={{ height: '1px', background: 'var(--border)', margin: '0.75rem 0' }}></div>

        {/* Gestión de Usuarios (Admins, Recepción y Superadmins) */}
        {hasAccessToUsers && (
          <div
            className={`menu-item users ${currentView === 'users' ? 'active' : ''}`}
            onClick={() => setView('users')}
            title={collapsed ? "Usuarios" : ""}
          >
            <Users size={20} style={{ opacity: 0.8 }} />
            {!collapsed && <span style={{ opacity: 0.9 }}>Gestión Usuarios</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.4 }} />}
          </div>
        )}

        {/* Instituciones (Superadmin únicamente) */}
        {isSuperAdmin && (
          <div
            className={`menu-item prestadores ${currentView === 'prestadores' ? 'active' : ''}`}
            onClick={() => setView('prestadores')}
            title={collapsed ? "Instituciones" : ""}
          >
            <Building size={20} style={{ opacity: 0.8 }} />
            {!collapsed && <span style={{ opacity: 0.9 }}>Instituciones</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.4 }} />}
          </div>
        )}

        {/* Auditoría del Sistema / Logs (Superadmin únicamente) */}
        {isSuperAdmin && (
          <div
            className={`menu-item logs ${currentView === 'logs' ? 'active' : ''}`}
            onClick={() => setView('logs')}
            title={collapsed ? "Auditoría" : ""}
          >
            <FileText size={20} style={{ opacity: 0.8 }} />
            {!collapsed && <span style={{ opacity: 0.9 }}>Auditoría Sistema</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.4 }} />}
          </div>
        )}


      </nav>

      {!collapsed && (
        <div style={{ padding: '1rem 1.5rem', borderTop: '1px solid var(--border)' }}>
          <p style={{ fontSize: '0.75rem', opacity: 0.6 }}>
            Usuario: <span style={{ fontWeight: 600 }}>{user?.nombre_usuario}</span>
          </p>
          {roles.length > 1 ? (
            <div style={{ marginTop: '5px' }}>
              <label style={{ fontSize: '0.6rem', opacity: 0.5, display: 'block', marginBottom: '2px' }}>Cambiar Rol Activo:</label>
              <select
                value={user?.rol}
                onChange={(e) => handleRoleChange(e.target.value)}
                style={{
                  width: '100%',
                  background: 'rgba(255,255,255,0.05)',
                  border: '1px solid var(--border)',
                  color: '#fff',
                  fontSize: '0.75rem',
                  padding: '2px 4px',
                  borderRadius: '4px',
                  cursor: 'pointer',
                  outline: 'none',
                  textTransform: 'capitalize'
                }}
              >
                {roles.map(r => (
                  <option key={r} value={r} style={{ background: '#18181b', color: '#fff' }}>
                    {r === 'superadmin' ? 'Super Admin' : r === 'profesional' ? 'Profesional' : r === 'recepcion' ? 'Recepción' : r === 'admin' ? 'Administrador' : 'Usuario'}
                  </option>
                ))}
              </select>
            </div>
          ) : (
            <p style={{ fontSize: '0.65rem', opacity: 0.5, marginTop: '2px' }}>
              Rol: <span style={{ textTransform: 'capitalize' }}>{user?.rol}</span>
            </p>
          )}
        </div>
      )}
    </aside>
  );
};

export default Sidebar;
