document.getElementById('searchCep').addEventListener('click', async () => {

    let cep = document.getElementById('cep').value;

    if (cep === '') {
        alert('Informe o CEP!')
        return;
    }

    async function searchCep(cep) {
        let url = `http://localhost:8000/public?searchCep.php=${cep}`;
        let ajax = new XMLHttpRequest();

        ajax.open('GET', url);

        return new Promise((resolve, reject) => {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        resolve(JSON.parse(ajax.responseText));
                    } else {
                        reject(new Error('Falha ao buscar o CEP'));
                    }
                }
            };
            ajax.send();
        });
    }

    let cepResponse = await searchCep(cep);

    if (cepResponse.status === 'success') {
        document.getElementById('rua').value = cepResponse.content.logradouro;
        document.getElementById('bairro').value = cepResponse.content.bairro;
        document.getElementById('cidade').value = cepResponse.content.localidade;
        document.getElementById('estado').value = cepResponse.content.uf;

        return;
    }

    alert(`Falha ao buscar o CEP`)
})

