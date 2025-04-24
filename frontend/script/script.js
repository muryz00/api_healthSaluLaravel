document.getElementById('testApi').addEventListener('click', async () => {
    const responseElement = document.getElementById('response');
    responseElement.textContent = 'Carregando...';

    const medico = {
        "nome": "Dr. Exemplo",
        "email": "dr.exemplo@clinica.com",
        "senha": "senhaSegura123",
        "cpf": "12345678901",
        "crm": "CRM/SP123456",
        "telefone": "11999999999",  // opcional
        "especialidade": "Cardiologia"  // opcional
    };

    try {
        console.log('Iniciando requisição...');
        
        const response = await axios.post(
            "http://127.0.0.1:8000/api/medicos/cadastrar", 
            medico,
            {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            }
        );

        responseElement.textContent = JSON.stringify(response.data, null, 2);
        console.log("Resposta recebida:", response.data);

    } catch (error) {
        console.error("Erro completo:", error);
        
        let errorMessage = `Erro: ${error.message}`;
        
        if (error.response) {
            // Se o servidor respondeu com um status de erro
            errorMessage += `\nStatus: ${error.response.status}`;
            
            if (error.response.data) {
                errorMessage += `\nErros: ${JSON.stringify(error.response.data, null, 2)}`;
            }
        }
        
        responseElement.textContent = errorMessage;
    }
});
