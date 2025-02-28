var mapa;

var markersArray = [];

var polilinha = [];

var linha = false;

var timeout;

var editableLayers;

function iniciarMapa() {
    var lat = parseFloat($("#latitude").val());
    var lon = parseFloat($("#longitude").val());
    if (lat == 0.0 && lon == 0.0) {
        return;
    }

    mapa = L.map("div_mapa").setView([lat, lon], 13);

    L.tileLayer(
        "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoia2FsaWxtYWNpZWwiLCJhIjoiY2xmbW9renZ5MGR1bDNwcDlla3pheHZ4dSJ9._100ylBG6sJ-WlUeJgtdjQ",
        {
            attribution:
                '© <a href="https://www.mapbox.com/about/maps/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> <strong><a href="https://www.mapbox.com/map-feedback/" target="_blank">Improve this map</a></strong>',
            tileSize: 512,
            maxZoom: 18,
            zoomOffset: -1,
            id: "mapbox/streets-v11",
            accessToken:
                "pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
        }
    ).addTo(mapa);

    localizar(lat, lon, $("#name").val(), enderecoCompleto(), true);
}

function localizar(latitude, longitude, nome, endereco, centralizar) {
    if (latitude == 0 && longitude == 0) {
        Aviso.fire({
            icon: "error",
            title: "Coordenadas não especificadas.",
        });
        return;
    }

    var popup =
        "<b>" +
        nome +
        "</b><br><hr>" +
        "<p>" +
        "<b>Endereço: </b>" +
        endereco +
        "<br>" +
        "</p>";

    var icon = L.icon({
        iconUrl: assets + "assets/img/marker-mov.png",
        shadowUrl: assets + "assets/img/marker-shadow.png",
        iconSize: [25, 41], // size of the icon
        shadowSize: [41, 41], // size of the shadow
        iconAnchor: [12, 40], // point of the icon which will correspond to marker's location
        shadowAnchor: [10, 40], // the same for the shadow
        popupAnchor: [0, -46], // point from which the popup should open relative to the iconAnchor
    });

    var marker = L.marker([latitude, longitude], {
        icon: icon,
        draggable: true,
    })
        .addTo(mapa)
        .bindPopup(popup)
        .openPopup();

    marker.on("dragend", function (e) {
        $("#latitude").val(marker.getLatLng().lat);
        $("#longitude").val(marker.getLatLng().lng);
    });

    if (centralizar) {
        mapa.flyTo([latitude, longitude], 15);
    }

    marker.tipoPonto = "ponto";
    markersArray.push(marker);
}

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

function getLocalizacao() {
    carregando(true);
    const dados = {
        _token: _token,
        endereco: $("#endereco").val(),
        bairro: $("#bairro").val(),
        cidade: $("#cidade").val(),
        uf: $("#uf").val(),
        pais: "Brazil",
    };

    const url = base_url + "/api/localizacaoDireta";
    postDados(url, dados).then((data) => {
        carregando(false);
        if (data.data) {
            const end = data.data[0];
            $("#latitude").val(end.lat);
            $("#longitude").val(end.lon);
            iniciarMapa();
        } else {
            Aviso.fire({
                icon: "error",
                title: "Não foi possível obter coordenadas a partir deste endereco.",
            });
        }
    });
}

function enderecoCompleto() {
    return (
        $("#endereco").val() +
        ", " +
        $("#bairro").val() +
        ", " +
        $("#cidade").val() +
        ", " +
        $("#uf").val() +
        ", " +
        $("#cep").val() +
        ", Brasil"
    );
}

function getLocalizacaoReversa() {
    carregando(true);
    const dados = {
        _token: _token,
        latitude: $("#latitude").val(),
        longitude: $("#longitude").val(),
    };

    const url = base_url + "/api/localizacaoReversa";
    postDados(url, dados).then((data) => {
        carregando(false);
        if (data.data) {
            const end = data.data.address;
            $("#endereco").val(end.road);
            $("#bairro").val(end.suburb);
            $("#cidade").val(end.city);
            $("#uf").val(end.uf);
            $("#cep").val(end.postcode);
        } else {
            Aviso.fire({
                icon: "error",
                title: "Não foi possível obter um endereço a partir desta coordenadas.",
            });
        }
    });
}

$(document).ready(function () {
    iniciarMapa();
});
