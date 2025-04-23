document.getElementById('testApi').addEventListener('click', async () => {
    const responseElement = document.getElementById('response');
    responseElement.textContent = 'Carregando...';

    try {
        const response = await fetch('http://http://127.0.0.1:8000/Controllers/api/MedicoController.php', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        if (!response.ok) {
            throw new Error(`Erro: ${response.status} - ${response.statusText}`);
        }

        const data = await response.json();
        responseElement.textContent = JSON.stringify(data, null, 2);
    } catch (error) {
        responseElement.textContent = `Erro ao buscar a API: ${error.message}`;
    }
});