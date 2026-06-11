const fs = require('fs');
const path = require('path');

const sidebarPath = path.join(__dirname, '../frontend/src/components/Sidebar.jsx');
let content = fs.readFileSync(sidebarPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

// 1. Add Building to imports
const oldImports = `  Heart,
  Clock
} from 'lucide-react';`;

const newImports = `  Heart,
  Clock,
  Building
} from 'lucide-react';`;

if (content.includes(oldImports)) {
    content = content.replace(oldImports, newImports);
    console.log("-> Replaced imports successfully.");
} else {
    console.error("-> COULD NOT find old imports exactly.");
}

// 2. Add Prestadores navigation item
const oldNavItem = `        {/* Auditoría del Sistema / Logs (Superadmin únicamente) */}
        {isSuperAdmin && (
          <div
            className={\`menu-item logs \${currentView === 'logs' ? 'active' : ''}\`}
            onClick={() => setView('logs')}
            title={collapsed ? "Auditoría" : ""}
          >
            <FileText size={20} style={{ opacity: 0.8 }} />
            {!collapsed && <span style={{ opacity: 0.9 }}>Auditoría Sistema</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.4 }} />}
          </div>
        )}`;

const newNavItem = `        {/* Instituciones (Superadmin únicamente) */}
        {isSuperAdmin && (
          <div
            className={\`menu-item prestadores \${currentView === 'prestadores' ? 'active' : ''}\`}
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
            className={\`menu-item logs \${currentView === 'logs' ? 'active' : ''}\`}
            onClick={() => setView('logs')}
            title={collapsed ? "Auditoría" : ""}
          >
            <FileText size={20} style={{ opacity: 0.8 }} />
            {!collapsed && <span style={{ opacity: 0.9 }}>Auditoría Sistema</span>}
            {!collapsed && <ChevronRight size={16} style={{ marginLeft: 'auto', opacity: 0.4 }} />}
          </div>
        )}`;

if (content.includes(oldNavItem)) {
    content = content.replace(oldNavItem, newNavItem);
    console.log("-> Replaced nav item successfully.");
} else {
    console.error("-> COULD NOT find old nav item exactly.");
}

fs.writeFileSync(sidebarPath, content, 'utf8');
console.log("=== COMPLETED SIDEBAR.JSX REPLACEMENTS ===");
