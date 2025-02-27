function getEndereco(obj) {
    const value = obj.value;
    const url = base_url + "/api/cep/" + value;
    getDados(url).then((data) => {
        $('#endereco').val(data.data.logradouro);
        $('#bairro').val(data.data.bairro);
        $('#cidade').val(data.data.localidade);
        $('#uf').val(data.data.uf);
        ativarComponentes();
    });
}
