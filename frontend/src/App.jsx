import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Sidebar from './components/Sidebar';
import Header from './components/Header';
import Login from './views/Login';
import UserManagement from './views/UserManagement';
import Profile from './views/Profile';
import LogViewer from './views/LogViewer';
import Patients from './views/Patients';
import Nomenclature from './views/Nomenclature';
import Appointments from './views/Appointments';
import WaitingList from './views/WaitingList';
import Prestadores from './views/Prestadores';
import Socios from './views/Socios';
import SociosDashboard from './views/SociosDashboard';
import Particulares from './views/Particulares';
import Mascotas from './views/Mascotas';
import InformesSocios from './views/InformesSocios';
import AcomodarRuta from './views/AcomodarRuta';
import Pagos from './views/Pagos';
import { API_URL } from './config';

function App() {
  // App main state
  const [user, setUser] = useState(null);
  const [view, setView] = useState('appointments'); // Default view
  const [sidebarCollapsed, setSidebarCollapsed] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
  const [checkingAuth, setCheckingAuth] = useState(true);

  // Global states for patient file activation
  const [selectedPatientId, setSelectedPatientId] = useState(null);
  const [patientInitialTab, setPatientInitialTab] = useState('info');
  const [patientOpenHcModal, setPatientOpenHcModal] = useState(false);
  const [activeTurnoId, setActiveTurnoId] = useState(null);
  const [isPatientModalOpen, setIsPatientModalOpen] = useState(false);
  const [waitingListRefresh, setWaitingListRefresh] = useState(0);
  const [preselectedOwner, setPreselectedOwner] = useState(null);

  useEffect(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const impToken = urlParams.get('impersonate_token');
    
    if (impToken) {
      localStorage.setItem('sulb_token', impToken);
      const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
      window.history.replaceState({ path: cleanUrl }, '', cleanUrl);
    }

    const token = localStorage.getItem('sulb_token');
    const savedUser = impToken ? null : localStorage.getItem('sulb_user');
    
    if (token) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
      // Verify token with backend
      axios.get(`${API_URL}/auth/me`)
        .then(res => {
          const userData = res.data.user;
          localStorage.setItem('sulb_user', JSON.stringify(userData));
          setUser(userData);
          // Set default view based on role
          if (userData.rol === 'superadmin' || userData.rol === 'admin') {
            setView('socios-dashboard');
          } else if (userData.rol === 'recepcion') {
            setView('socios-dashboard');
          } else if (userData.rol === 'cobrador') {
            setView('pagos');
          } else if (['profesional', 'veterinario', 'peluquero', 'traslado'].includes(userData.rol)) {
            setView('waiting-list');
          } else {
            setView('profile');
          }
        })
        .catch(err => {
          console.error('Invalid token', err);
          handleLogout();
        })
        .finally(() => {
          setCheckingAuth(false);
        });
    } else {
      setCheckingAuth(false);
    }
  }, []);

  const handleLogin = (userData) => {
    setUser(userData);
    if (userData.rol === 'superadmin' || userData.rol === 'admin') {
      setView('socios-dashboard');
    } else if (userData.rol === 'recepcion') {
      setView('socios-dashboard');
    } else if (userData.rol === 'cobrador') {
      setView('pagos');
    } else if (['profesional', 'veterinario', 'peluquero', 'traslado'].includes(userData.rol)) {
      setView('waiting-list');
    } else {
      setView('profile');
    }
  };

  const handleSelectPatientFromWaitingList = (patientId, tab = 'info', openHc = false, turnoId = null) => {
    setSelectedPatientId(patientId);
    setPatientInitialTab(tab);
    setPatientOpenHcModal(openHc);
    setActiveTurnoId(turnoId);
    if (view === 'waiting-list') {
      setIsPatientModalOpen(true);
    } else {
      setView('patients');
    }
  };

  const handleLogout = () => {
    localStorage.removeItem('sulb_token');
    localStorage.removeItem('sulb_user');
    delete axios.defaults.headers.common['Authorization'];
    setUser(null);
    setView('login');
  };

  if (checkingAuth) {
    return <div className="loading-screen">Cargando...</div>;
  }

  if (!user) {
    return <Login onLogin={handleLogin} />;
  }

  return (
    <div className={`dashboard-container ${sidebarCollapsed ? 'sidebar-collapsed' : ''}`}>
      <Sidebar 
        currentView={view} 
        setView={(v) => { setView(v); setMobileMenuOpen(false); }} 
        collapsed={sidebarCollapsed} 
        setCollapsed={setSidebarCollapsed} 
        mobileOpen={mobileMenuOpen}
        setMobileOpen={setMobileMenuOpen}
        user={user}
        onLogout={handleLogout}
      />
      <main className="main-content">
        <Header 
          user={user} 
          onMenuToggle={() => setMobileMenuOpen(!mobileMenuOpen)} 
          onLogout={handleLogout} 
          onViewProfile={() => { setView('profile'); setMobileMenuOpen(false); }}
        />
        <div className="body-content-wrapper">
          {view === 'appointments' ? (
            <Appointments user={user} />
          ) : view === 'waiting-list' ? (
            <>
              <WaitingList 
                user={user} 
                onSelectPatient={handleSelectPatientFromWaitingList}
                refreshTrigger={waitingListRefresh}
              />
              {isPatientModalOpen && (
                <div style={{ position: 'fixed', top: 0, left: 0, right: 0, bottom: 0, background: 'rgba(0,0,0,0.85)', zIndex: 9999, padding: window.innerWidth <= 768 ? '0' : '2rem', display: 'flex', justifyContent: 'center', alignItems: 'center', backdropFilter: 'blur(5px)' }}>
                  <div style={{ background: 'var(--bg)', width: '100%', height: '100%', maxWidth: '1200px', borderRadius: window.innerWidth <= 768 ? '0' : '12px', overflow: 'hidden', position: 'relative', border: '1px solid var(--border)' }}>
                    <Patients 
                      activePatientId={selectedPatientId} 
                      setActivePatientId={setSelectedPatientId}
                      initialTab={patientInitialTab}
                      openHcModalOnLoad={patientOpenHcModal}
                      setOpenHcModalOnLoad={setPatientOpenHcModal}
                      activeTurnoId={activeTurnoId}
                      setActiveTurnoId={setActiveTurnoId}
                      onReturnToWaitingList={() => { setIsPatientModalOpen(false); setWaitingListRefresh(prev => prev + 1); }}
                      onClose={() => { setIsPatientModalOpen(false); setWaitingListRefresh(prev => prev + 1); }}
                    />
                  </div>
                </div>
              )}
            </>
          ) : view === 'socios-dashboard' ? (
            <SociosDashboard
              currentUser={user}
              onNavigate={(action) => {
                if (action === 'list-socios') setView('socios');
                else if (action === 'new-socio') { setView('socios'); }
                else if (action === 'list-particulares') setView('particulares');
                else if (action === 'new-particular') setView('particulares');
                else if (action === 'list-mascotas') setView('mascotas');
                else if (action === 'new-mascota') setView('mascotas');
                else if (action === 'informes') setView('informes');
                else if (action === 'acomodar-ruta') setView('acomodar-ruta');
              }}
            />
          ) : view === 'informes' ? (
            <InformesSocios currentUser={user} onBack={() => setView('socios-dashboard')} />
          ) : view === 'acomodar-ruta' ? (
            <AcomodarRuta currentUser={user} onBack={() => setView('socios-dashboard')} />
          ) : view === 'pagos' ? (
            <Pagos currentUser={user} onBack={() => setView(
              ['admin','superadmin','recepcion'].includes(user?.rol) ? 'socios-dashboard' : 'profile'
            )} />
          ) : view === 'socios' ? (
            <Socios currentUser={user} onAddMascota={(type, id, label) => {
              setPreselectedOwner({ type, id, label });
              setView('mascotas');
            }} />
          ) : view === 'particulares' ? (
            <Particulares currentUser={user} onAddMascota={(type, id, label) => {
              setPreselectedOwner({ type, id, label });
              setView('mascotas');
            }} />
          ) : view === 'mascotas' ? (
            <Mascotas currentUser={user} initialOwner={preselectedOwner} clearInitialOwner={() => setPreselectedOwner(null)} />
          ) : view === 'patients' ? (
            <Patients 
              activePatientId={selectedPatientId} 
              setActivePatientId={setSelectedPatientId}
              initialTab={patientInitialTab}
              openHcModalOnLoad={patientOpenHcModal}
              setOpenHcModalOnLoad={setPatientOpenHcModal}
              activeTurnoId={activeTurnoId}
              setActiveTurnoId={setActiveTurnoId}
              onReturnToWaitingList={() => setView('waiting-list')}
            />
          ) : view === 'nomenclature' ? (
            <Nomenclature user={user} />
          ) : view === 'prestadores' ? (
            <Prestadores />
          ) : view === 'users' ? (
            <UserManagement />
          ) : view === 'profile' ? (
            <Profile user={user} />
          ) : view === 'logs' ? (
            <LogViewer />
          ) : (
            <Profile user={user} />
          )}
        </div>
      </main>
    </div>
  );
}

export default App;
