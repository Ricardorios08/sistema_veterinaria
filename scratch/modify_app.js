const fs = require('fs');
const path = require('path');

const appPath = path.join(__dirname, '../frontend/src/App.jsx');
let content = fs.readFileSync(appPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

// 1. Add imports
const oldImports = `import ObrasSociales from './views/ObrasSociales';
import WaitingList from './views/WaitingList';
import { API_URL } from './config';`;

const newImports = `import ObrasSociales from './views/ObrasSociales';
import WaitingList from './views/WaitingList';
import Prestadores from './views/Prestadores';
import { API_URL } from './config';`;

if (content.includes(oldImports)) {
    content = content.replace(oldImports, newImports);
    console.log("-> Replaced imports successfully.");
} else {
    console.error("-> COULD NOT find old imports exactly.");
}

// 2. Add route mapping in rendering
const oldRouteMap = `          ) : view === 'obras-sociales' ? (
            <ObrasSociales />
          ) : view === 'users' ? (`;

const newRouteMap = `          ) : view === 'obras-sociales' ? (
            <ObrasSociales />
          ) : view === 'prestadores' ? (
            <Prestadores />
          ) : view === 'users' ? (`;

if (content.includes(oldRouteMap)) {
    content = content.replace(oldRouteMap, newRouteMap);
    console.log("-> Replaced route mapping successfully.");
} else {
    console.error("-> COULD NOT find old route mapping exactly.");
}

fs.writeFileSync(appPath, content, 'utf8');
console.log("=== COMPLETED APP.JSX REPLACEMENTS ===");
