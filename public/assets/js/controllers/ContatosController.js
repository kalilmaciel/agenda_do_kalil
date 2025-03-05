function discar(nome, telefone, email) {
    try {
        $(".dropdown-trigger").dropdown("close");
    } catch (error) {}

    setTimeout(() => {
        Swal.fire({
            title: nome,
            html: `
                      <div>
                        O que deseja fazer?
                        <br><br>
                        <div style="display: flex; flex-direction: column;">
                          <button type="button" id="whatsapp" role="button" tabindex="0" class="btn-small redondo green">Conversar no Whatsapp</button>
                          <button type="button" id="ligar" role="button" tabindex="0" class="btn-small redondo blue">Ligar</button>
                          <button type="button" id="email" role="button" tabindex="0" class="btn-small redondo orange">Mandar um e-mail</button>
                        </div>
                      </div>
                    `,
            allowOutsideClick: true,
            allowEscapeKey: true,
            showConfirmButton: false,
            showDenyButton: false,
            didOpen: () => {
                document
                    .getElementById("whatsapp")
                    .addEventListener("click", () => {
                        abrirZap(telefone, "Olá " + nome);
                    });
                document
                    .getElementById("ligar")
                    .addEventListener("click", () => {
                        abrirLigacao(telefone);
                    });
                document
                    .getElementById("email")
                    .addEventListener("click", () => {
                        abrirEmail(nome, email);
                    });
            },
        });
    }, 500);
}

function centralizar(latitude, longitude, nome) {
    if (!$('#div_mapa').length){
        Aviso.fire({
            icon: "error",
            title: "Marque a opção 'Mostrar mapa' antes de ativar esta opção.",
        });
        return;
    }
    $("#latitude").val(latitude);
    $("#longitude").val(longitude);
    setTimeout(() => {
        localizar(
            latitude,
            longitude,
            nome,
            "Entre no contato para detalhar",
            true
        );
    }, 500);
}

function abrirMaps(latitude, longitude) {
    window.open(
        "https://maps.google.com.br/maps?q=" + latitude + "," + longitude,
        "_system"
    );
}
