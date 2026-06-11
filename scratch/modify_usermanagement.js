const fs = require('fs');
const path = require('path');

const userManPath = path.join(__dirname, '../frontend/src/views/UserManagement.jsx');
let content = fs.readFileSync(userManPath, 'utf8');

// Normalize line endings
content = content.replace(/\r\n/g, '\n');

// 1. Add states at the top
const oldStates = `    const [users, setUsers] = useState([]);
    const [nombre_usuario, setNombreUsuario] = useState('');
    const [password, setPassword] = useState('');
    const [rol, setRol] = useState('usuario');
    const [tipoProfesionalId, setTipoProfesionalId] = useState('');
    const [matricula, setMatricula] = useState('');`;

const newStates = `    const [users, setUsers] = useState([]);
    const [nombre_usuario, setNombreUsuario] = useState('');
    const [password, setPassword] = useState('');
    const [rol, setRol] = useState('usuario');
    const [tipoProfesionalId, setTipoProfesionalId] = useState('');
    const [matricula, setMatricula] = useState('');
    
    // Prestadores states
    const [prestadores, setPrestadores] = useState([]);
    const [prestadorId, setPrestadorId] = useState('');
    const [editPrestadorId, setEditPrestadorId] = useState('');`;

if (content.includes(oldStates)) {
    content = content.replace(oldStates, newStates);
    console.log("-> Replaced states successfully.");
} else {
    console.error("-> COULD NOT find old states exactly.");
}

// 2. Fetch prestadores inside useEffect
const oldEffect = `    useEffect(() => {
        const userStr = localStorage.getItem('nomade_user');
        if (userStr) {
            try { setCurrentUser(JSON.parse(userStr)); } catch(e){}
        }
        fetchUsers();
        fetchProfessionalTypes();
    }, []);`;

const newEffect = `    const fetchPrestadores = async () => {
        try {
            const token = localStorage.getItem('nomade_token');
            const response = await axios.get(\`\${API_URL}/prestadores\`, {
                headers: { Authorization: \`Bearer \${token}\` }
            });
            setPrestadores(response.data);
        } catch (e) {
            console.error('Error fetching prestadores:', e);
        }
    };

    useEffect(() => {
        const userStr = localStorage.getItem('nomade_user');
        if (userStr) {
            try { 
                const parsed = JSON.parse(userStr);
                setCurrentUser(parsed); 
                if (parsed.rol === 'superadmin') {
                    fetchPrestadores();
                }
            } catch(e){}
        }
        fetchUsers();
        fetchProfessionalTypes();
    }, []);`;

if (content.includes(oldEffect)) {
    content = content.replace(oldEffect, newEffect);
    console.log("-> Replaced useEffect successfully.");
} else {
    console.error("-> COULD NOT find old useEffect exactly.");
}

// 3. handleCreateUser payload
const oldCreate = `            await axios.post(\`\${API_URL}/auth/users\`, { 
                nombre_usuario, 
                password, 
                rol,
                tipo_profesional_id: rol === 'profesional' && tipoProfesionalId ? parseInt(tipoProfesionalId) : null,
                matricula: rol === 'profesional' ? matricula : null
            });
            setMessage({ type: 'success', text: 'Usuario creado con éxito' });
            setNombreUsuario('');
            setPassword('');
            setRol('usuario');
            setTipoProfesionalId('');
            setMatricula('');`;

const newCreate = `            await axios.post(\`\${API_URL}/auth/users\`, { 
                nombre_usuario, 
                password, 
                rol,
                tipo_profesional_id: rol === 'profesional' && tipoProfesionalId ? parseInt(tipoProfesionalId) : null,
                matricula: rol === 'profesional' ? matricula : null,
                prestador_id: currentUser?.rol === 'superadmin' && prestadorId ? parseInt(prestadorId) : null
            });
            setMessage({ type: 'success', text: 'Usuario creado con éxito' });
            setNombreUsuario('');
            setPassword('');
            setRol('usuario');
            setTipoProfesionalId('');
            setMatricula('');
            setPrestadorId('');`;

if (content.includes(oldCreate)) {
    content = content.replace(oldCreate, newCreate);
    console.log("-> Replaced handleCreateUser successfully.");
} else {
    console.error("-> COULD NOT find old handleCreateUser exactly.");
}

// 4. handleStartEdit
const oldStartEdit = `    const handleStartEdit = (u) => {
        setEditingUserId(u.id);
        setEditRol(u.rol);
        setEditPassword('');
        setEditTipoProfesionalId(u.tipo_profesional_id || '');
        setEditMatricula(u.matricula || '');
    };`;

const newStartEdit = `    const handleStartEdit = (u) => {
        setEditingUserId(u.id);
        setEditRol(u.rol);
        setEditPassword('');
        setEditTipoProfesionalId(u.tipo_profesional_id || '');
        setEditMatricula(u.matricula || '');
        setEditPrestadorId(u.prestador_id || '');
    };`;

if (content.includes(oldStartEdit)) {
    content = content.replace(oldStartEdit, newStartEdit);
    console.log("-> Replaced handleStartEdit successfully.");
} else {
    console.error("-> COULD NOT find old handleStartEdit exactly.");
}

// 5. handleSaveEdit payload
const oldSaveEdit = `            await axios.put(\`\${API_URL}/auth/users/\${id}\`, {
                password: editPassword || undefined,
                rol: editRol,
                tipo_profesional_id: editRol === 'profesional' && editTipoProfesionalId ? parseInt(editTipoProfesionalId) : null,
                matricula: editRol === 'profesional' ? editMatricula : null
            });`;

const newSaveEdit = `            await axios.put(\`\${API_URL}/auth/users/\${id}\`, {
                password: editPassword || undefined,
                rol: editRol,
                tipo_profesional_id: editRol === 'profesional' && editTipoProfesionalId ? parseInt(editTipoProfesionalId) : null,
                matricula: editRol === 'profesional' ? editMatricula : null,
                prestador_id: currentUser?.rol === 'superadmin' && editPrestadorId ? parseInt(editPrestadorId) : null
            });`;

if (content.includes(oldSaveEdit)) {
    content = content.replace(oldSaveEdit, newSaveEdit);
    console.log("-> Replaced handleSaveEdit successfully.");
} else {
    console.error("-> COULD NOT find old handleSaveEdit exactly.");
}

// 6. Form rendering dropdown
const oldFormGroup = `                    <div className="form-group" style={{ marginBottom: 0 }}>
                        <label>Rol</label>
                        <select 
                            className="input-field"
                            value={rol} 
                            onChange={(e) => setRol(e.target.value)}
                        >
                            <option value="usuario">Usuario Estándar</option>
                            <option value="profesional">Profesional de la Salud</option>
                            <option value="municipalidad">Municipalidad</option>
                            <option value="admin">Administrador</option>
                            <option value="superadmin">Super Administrador</option>
                        </select>
                    </div>`;

const newFormGroup = `                    <div className="form-group" style={{ marginBottom: 0 }}>
                        <label>Rol</label>
                        <select 
                            className="input-field"
                            value={rol} 
                            onChange={(e) => setRol(e.target.value)}
                        >
                            <option value="usuario">Usuario Estándar</option>
                            <option value="profesional">Profesional de la Salud</option>
                            <option value="municipalidad">Municipalidad</option>
                            <option value="admin">Administrador</option>
                            <option value="superadmin">Super Administrador</option>
                        </select>
                    </div>

                    {currentUser?.rol === 'superadmin' && (
                        <div className="form-group" style={{ marginBottom: 0 }}>
                            <label>Consultorio / Institución</label>
                            <select 
                                className="input-field"
                                value={prestadorId}
                                onChange={(e) => setPrestadorId(e.target.value)}
                                required
                            >
                                <option value="">Seleccionar consultorio...</option>
                                {prestadores.map(p => (
                                    <option key={p.id} value={p.id}>{p.nombre}</option>
                                ))}
                            </select>
                        </div>
                    )}`;

if (content.includes(oldFormGroup)) {
    content = content.replace(oldFormGroup, newFormGroup);
    console.log("-> Replaced form dropdown successfully.");
} else {
    console.error("-> COULD NOT find old form dropdown exactly.");
}

// 7. Table Header
const oldTableHeader = `                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Rol</th>
                                <th>Especialidad / Matrícula</th>
                                <th style={{ textAlign: 'center' }}>Acciones</th>
                            </tr>
                        </thead>`;

const newTableHeader = `                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Rol</th>
                                {currentUser?.rol === 'superadmin' && <th>Consultorio / Institución</th>}
                                <th>Especialidad / Matrícula</th>
                                <th style={{ textAlign: 'center' }}>Acciones</th>
                            </tr>
                        </thead>`;

if (content.includes(oldTableHeader)) {
    content = content.replace(oldTableHeader, newTableHeader);
    console.log("-> Replaced table header successfully.");
} else {
    console.error("-> COULD NOT find old table header exactly.");
}

// 8. Table Row cells for view mode and edit mode
// Wait, we can replace the entire table row body or map loops if needed, but let's do a very clean injection!
// Let's see if we can do the row injection in cells.
// In the map loop:
// We can inject right after `</td>` of the Rol:
const oldRoleTd = `                                        {editingUserId === u.id && (
                                            <div style={{ marginTop: '0.5rem' }}>
                                                <input 
                                                    type="password" 
                                                    placeholder="Nueva contraseña (opcional)" 
                                                    className="input-field"
                                                    value={editPassword}
                                                    onChange={(e) => setEditPassword(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                />
                                            </div>
                                        )}
                                    </td>`;

const newRoleTd = `                                        {editingUserId === u.id && (
                                            <div style={{ marginTop: '0.5rem' }}>
                                                <input 
                                                    type="password" 
                                                    placeholder="Nueva contraseña (opcional)" 
                                                    className="input-field"
                                                    value={editPassword}
                                                    onChange={(e) => setEditPassword(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto', fontSize: '0.8rem' }}
                                                />
                                            </div>
                                        )}
                                    </td>
                                    
                                    {currentUser?.rol === 'superadmin' && (
                                        <td>
                                            {editingUserId === u.id ? (
                                                <select 
                                                    className="input-field"
                                                    value={editPrestadorId}
                                                    onChange={(e) => setEditPrestadorId(e.target.value)}
                                                    style={{ padding: '0.2rem', minHeight: 'auto' }}
                                                >
                                                    <option value="">Seleccionar consultorio...</option>
                                                    {prestadores.map(p => (
                                                        <option key={p.id} value={p.id}>{p.nombre}</option>
                                                    ))}
                                                </select>
                                            ) : (
                                                <span style={{ fontSize: '0.85rem', color: 'var(--text-dim)' }}>
                                                    {u.prestador_nombre || 'Sin vincular'}
                                                </span>
                                            )}
                                        </td>
                                    )}`;

if (content.includes(oldRoleTd)) {
    content = content.replace(oldRoleTd, newRoleTd);
    console.log("-> Replaced table row cells successfully.");
} else {
    console.error("-> COULD NOT find old table row cells exactly.");
}

fs.writeFileSync(userManPath, content, 'utf8');
console.log("=== COMPLETED USERMANAGEMENT.JSX REPLACEMENTS ===");
