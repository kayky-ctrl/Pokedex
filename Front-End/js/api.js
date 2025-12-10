const API_URL = 'http://localhost:8000/api';

async function authFetch(url, options = {}){
    const token = localStorage.getItem('user_token');

    // Função auxiliar para faazer requisições autinticadas
    if (!token){
        window.location.href = 'index.html'; //Redireciona se não tiver token
        return;
    }

    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${token}`,
        ...options.headers
    }

    const response = await fetch(`${API_URL}${url}`,{
        ...options,
        headers
    })

    if (response.status === 401){
        logout();
    }

    return response
}

function logout(){
    localStorage.removeItem('user_token');
    window.location.href = 'index.html';
}