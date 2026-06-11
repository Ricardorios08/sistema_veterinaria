const http = require('http');

function post(url, data) {
    return new Promise((resolve, reject) => {
        const bodyStr = JSON.stringify(data);
        const req = http.request(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Content-Length': Buffer.byteLength(bodyStr)
            }
        }, (res) => {
            let resData = '';
            res.on('data', chunk => { resData += chunk; });
            res.on('end', () => {
                try {
                    resolve({ status: res.statusCode, data: JSON.parse(resData) });
                } catch (e) {
                    resolve({ status: res.statusCode, data: resData });
                }
            });
        });
        req.on('error', reject);
        req.write(bodyStr);
        req.end();
    });
}

function get(url, token) {
    return new Promise((resolve, reject) => {
        const req = http.request(url, {
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`
            }
        }, (res) => {
            let resData = '';
            res.on('data', chunk => { resData += chunk; });
            res.on('end', () => {
                try {
                    resolve({ status: res.statusCode, data: JSON.parse(resData) });
                } catch (e) {
                    resolve({ status: res.statusCode, data: resData });
                }
            });
        });
        req.on('error', reject);
        req.end();
    });
}

async function test() {
    console.log("=== TESTING LIVE HTTP ENDPOINTS FOR USER 'recepcion' (NATIVE HTTP) ===");
    try {
        // 1. Login
        console.log("Logging in as 'recepcion'...");
        const loginRes = await post('http://localhost:3010/api/auth/login', {
            nombre_usuario: 'recepcion',
            password: '1234'
        });
        console.log("Login Status:", loginRes.status);
        if (loginRes.status !== 200) {
            console.error("Login failed!", loginRes.data);
            return;
        }

        const token = loginRes.data.token;
        console.log("Login successful! Token received:", token.substring(0, 20) + "...");
        console.log("User data from login:", loginRes.data.user);

        // 2. Fetch users
        console.log("\nFetching users list from /api/auth/users...");
        const usersRes = await get('http://localhost:3010/api/auth/users', token);
        console.log("Status code:", usersRes.status);
        console.log("Response data:", usersRes.data);

        // 3. Fetch patients
        console.log("\nFetching patients list from /api/pacientes...");
        const pacRes = await get('http://localhost:3010/api/pacientes', token);
        console.log("Status code:", pacRes.status);
        console.log("Patients length:", Array.isArray(pacRes.data) ? pacRes.data.length : pacRes.data);

    } catch (err) {
        console.error("HTTP request failed!", err.message);
    } finally {
        process.exit(0);
    }
}

test();
