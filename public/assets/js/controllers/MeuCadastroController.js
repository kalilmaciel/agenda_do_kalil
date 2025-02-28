function getEndereco(obj) {
    const value = obj.value;
    const url = base_url + "/api/cep/" + value;
    carregando(true);
    getDados(url).then((data) => {
        carregando(false);
        if (data.data.logradouro) {
            $("#endereco").val(data.data.logradouro);
            $("#bairro").val(data.data.bairro);
            $("#cidade").val(data.data.localidade);
            $("#uf").val(data.data.uf);
            ativarComponentes();
        } else {
            Aviso.fire({
                icon: "error",
                title: "CEP não encontrado.",
            });
        }
    });
}
