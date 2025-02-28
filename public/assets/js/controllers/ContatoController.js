$(document).ready(function () {
    iniciarMapa();
    localizar(lat, lon, $("#name").val(), enderecoCompleto(), true);
});
