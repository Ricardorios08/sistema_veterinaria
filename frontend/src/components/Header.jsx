import React, { useState, useRef, useEffect } from 'react';
import { Menu, UserCircle, LogOut, Settings } from 'lucide-react';

const Header = ({ user, onMenuToggle, onLogout, onViewProfile }) => {
    const [showSettings, setShowSettings] = useState(false);
    const dropdownRef = useRef(null);

    // Close dropdown when clicking outside
    useEffect(() => {
        const handleClickOutside = (event) => {
            if (dropdownRef.current && !dropdownRef.current.contains(event.target)) {
                setShowSettings(false);
            }
        };
        document.addEventListener('mousedown', handleClickOutside);
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, []);

    return (
        <header className="header" style={{ position: 'sticky', top: 0, zIndex: 200, display: 'flex', flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center' }}>
            <div style={{ display: 'flex', alignItems: 'center', gap: '1rem' }}>
                <button className="menu-toggle" onClick={onMenuToggle}>
                    <Menu size={24} />
                </button>
                <div className="header-title">Portal</div>
            </div>

            <div style={{ display: 'flex', alignItems: 'center', gap: '0.75rem', position: 'relative' }} ref={dropdownRef}>
                <div className="status-indicator" style={{ border: 'none', background: 'transparent', gap: '0.5rem', padding: '0' }}>
                    <UserCircle size={20} color="var(--primary)" />
                    <span style={{ fontWeight: 600, fontSize: '0.95rem' }}>{user?.nombre_usuario || 'Usuario'}</span>
                </div>
                
                <button 
                    onClick={() => setShowSettings(!showSettings)}
                    style={{ background: 'transparent', border: 'none', color: 'var(--text-dim)', cursor: 'pointer', padding: '0.5rem', display: 'flex', alignItems: 'center' }}
                >
                    <Settings size={20} />
                </button>

                {showSettings && (
                    <div style={{
                        position: 'absolute',
                        top: '100%',
                        right: 0,
                        marginTop: '0.5rem',
                        background: 'var(--card-bg)',
                        border: '1px solid var(--border)',
                        borderRadius: '8px',
                        boxShadow: '0 10px 25px -5px rgba(0, 0, 0, 0.5)',
                        minWidth: '180px',
                        overflow: 'hidden',
                        zIndex: 300
                    }}>
                        <button 
                            onClick={() => { setShowSettings(false); onViewProfile && onViewProfile(); }}
                            style={{ 
                                width: '100%', padding: '0.85rem 1rem', display: 'flex', alignItems: 'center', gap: '0.75rem', 
                                background: 'transparent', border: 'none', borderBottom: '1px solid var(--border)', color: 'var(--text)', cursor: 'pointer', textAlign: 'left',
                                fontSize: '0.9rem'
                            }}
                            onMouseOver={(e) => e.currentTarget.style.background = 'rgba(255,255,255,0.05)'}
                            onMouseOut={(e) => e.currentTarget.style.background = 'transparent'}
                        >
                            <UserCircle size={16} color="var(--primary)" />
                            Mi Perfil
                        </button>
                        <button 
                            onClick={() => { setShowSettings(false); onLogout(); }}
                            style={{ 
                                width: '100%', padding: '0.85rem 1rem', display: 'flex', alignItems: 'center', gap: '0.75rem', 
                                background: 'rgba(239, 68, 68, 0.05)', border: 'none', color: '#fca5a5', cursor: 'pointer', textAlign: 'left',
                                fontSize: '0.9rem'
                            }}
                            onMouseOver={(e) => e.currentTarget.style.background = 'rgba(239, 68, 68, 0.1)'}
                            onMouseOut={(e) => e.currentTarget.style.background = 'rgba(239, 68, 68, 0.05)'}
                        >
                            <LogOut size={16} />
                            Cerrar Sesión
                        </button>
                    </div>
                )}
            </div>
        </header>
    );
};

export default Header;
