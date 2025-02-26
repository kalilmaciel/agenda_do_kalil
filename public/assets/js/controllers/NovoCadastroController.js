
function copiarValorDigitado(){
    var input = document.getElementById("user_link").value;
    var link = document.getElementById("link_afiliado");

    link.href = "https://indiquesmb.com/"+input;
    link.innerHTML = "https://indiquesmb.com/"+input;
}

function mascaraPix(obj, evt){
    switch (document.getElementById("user_tipo_pix").value) {
        case '1':
            return mascara('(##) #####-####',obj,evt);
            break;
        case '2':
            return true;
            break;
        case '3':
            return mascara('###.###.###-##',obj,evt);
            break;
        case '4':
            return mascara('##.###.###/####-##',obj,evt);
            break;
        case '5':
            return true;
            break;
    }
}
