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
            const formCep = document.querySelectorAll('.formCep');
            
            if (data.erro) {
                res.innerText = 'CEP não encontrado. ';
                formCep.forEach(el => el.classList.remove('ativo'));
            } else {
                res.innerText = '';
                formCep.forEach(el => el.classList.add('ativo'));

                document.getElementById('rua').value = data.logradouro || '';
                document.getElementById('bairro').value = data.bairro || '';
                document.getElementById('cidade').value = data.localidade || '';
                document.getElementById('estado').value = data.uf || '';
            }
        })
        .catch(error => {
            document.getElementById(resultado).innerText = 'CEP inválido ou inexistente. Tente novamente.';
            document.querySelectorAll('.formCep').forEach(el => el.classList.remove('ativo'));
            console.error(error);
        });
}