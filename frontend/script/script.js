document.getElementById('testApi').addEventListener('click', async () => {
    const responseElement = document.getElementById('response');
    responseElement.textContent = 'Carregando...';

    try {
    console.log('Iniciando requisição...');

    const response = await axios.post("http://127.0.0.1:8000/medico/cadastrar");
    console.log(response);

    if (!response.ok) {
            throw new Error(`Erro: ${response.status} - ${response.statusText}`);
        }

        const data = await response.json();
        responseElement.textContent = JSON.stringify(data, null, 2);
    
    
    /*const response = await fetch('http://127.0.0.1:8000/', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        });

        console.log(response)

        
        */
        console.log("test");
        
    } catch (error) {
         console.log(error)
        responseElement.textContent = `Erro ao buscar a API: ${error.message}`;
    }
});