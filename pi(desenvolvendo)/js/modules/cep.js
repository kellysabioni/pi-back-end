export function buscarCEP(cepDigitado, resultado) {
    const cep = cepDigitado.replace(/\D/g, '');
    const url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url)
        .then(response => {
            if (!response.ok) throw new Error('Erro ao buscar CEP');
            return response.json();
        })
        .then(data => {
            const res = document.getElementById(resultado);
            if (data.erro) {
               res.innerText = 'CEP não encontrado. ';
            } else {
                res.innerText = '';

                document.getElementById('rua').value = data.logradouro || '';
                document.getElementById('bairro').value = data.bairro || '';
                document.getElementById('cidade').value = data.localidade || '';
                document.getElementById('estado').value = data.uf || '';
            }
        })
        .catch(error => {
            document.getElementById(resultado).innerText = 'CEP inválido ou inexistente. Tente novamente ou preencha os campos manualmente';
            console.error(error);
        });

    }