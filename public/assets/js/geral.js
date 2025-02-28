var Aviso;

$(document).ready(function () {
    malditoIOS();
    criarToasts();
    ativarComponentes();
    carregando(false);
    Fancybox.bind();

    //Ajuste para a tela rolar pra cima sempre antes de imprimir
    window.onbeforeprint = async (event) => {
        window.scrollTo(0, 0);
    };

    $(".conteudo").animate({
        opacity: 1,
    });
});

$(window).on("beforeunload", function () {
    carregando(true);

    $(".conteudo").animate({
        opacity: 0,
    });
});

function carregando(mostrar) {
    if (mostrar) {
        if ($("#carregando").hasClass("hide")) {
            $("body").css("overflow", "hidden");
            $("#carregando").css("opacity", 0);
            $("#carregando").removeClass("hide");
            $("#carregando").animate(
                {
                    opacity: 1,
                },
                500
            );
        }
    } else {
        setTimeout(function () {
            $("body").css("overflow", "auto");
            $("#carregando").animate(
                {
                    opacity: 0,
                },
                500,
                function () {
                    $("#carregando").addClass("hide");
                }
            );
        }, 1000);
    }
}

function criarToasts() {
    Aviso = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
}

async function getDados(url) {
    const res = await fetch(url);
    const data = await res.json();
    return data;
}

async function postDados(url, dados) {
    if (!dados) {
        dados = {};
    }
    const request = new Request(url, {
        method: "POST",
        body: JSON.stringify(dados),
        cache: "default",
        headers: {
            "Content-Type": "application/json",
        },
    });

    const res = await fetch(request);
    const data = await res.json();
    return data;
}

async function postDadosAsync(url, dados) {
    if (!dados) {
        dados = {};
    }
    const request = new Request(url, {
        method: "POST",
        body: JSON.stringify(dados),
        cache: "default",
        mode: "cors",
        credentials: "omit",
        headers: {
            "Content-Type": "application/json",
        },
    });
    const res = await fetch(request);
    const data = await res.json();
    return data;
}

function malditoIOS() {
    var iOS =
        !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
    if (iOS) {
        //Força que os links da página sejam abertos na mesma janela
        var a = document.getElementsByTagName("a");
        for (var i = 0; i < a.length; i++) {
            a[i].onclick = function () {
                window.location = this.getAttribute("href");
                return false;
            };
        }

        document.querySelector("html").classList.add("is-ios");
    }
}

function ativarComponentes() {
    //M.AutoInit();

    if ($(".sidenav").length > 0) {
        $(".sidenav").each(function (ind, obj) {
            var nodragg = $(obj).data("nodragg");
            $("#" + obj.id).sidenav({
                draggable: !nodragg,
            });
        });
    }

    $(".scrollspy").scrollSpy();

    $(".dropdown-trigger").each(function (ind, obj) {
        var closeOnClick = $(obj).data("closeonclick");
        if (!closeOnClick) {
            closeOnClick = false;
        } else {
            closeOnClick = true;
        }
        var carregar = $(obj).data("carregar");
        if (!carregar) {
            carregar = "body";
        } else {
            carregar = null;
        }
        var cover = $(obj).data("cover");
        cover = cover ? cover : false;
        $(obj).dropdown({
            alignment: "right",
            coverTrigger: cover,
            closeOnClick: closeOnClick,
            isScrollable: true,
            container: carregar,
        });
    });

    if ($(".modal.open").length == 0) {
        $(".modal").modal({
            dismissible: false,
            onOpenEnd: function (el) {
                var element = $(el).find(".focus-first");
                focar(element);
                $(document).trigger("modalAbriu", el.id);
                console.log("modalAbriu", el.id);
                setTimeout(function () {
                    ativarComponentes();
                }, 100);

                $(
                    ".modal-header .modal-close > .fa-window-close, .modal-header .modal-close-not-default > .fa-window-close"
                ).addClass(
                    "animate__animated animate__heartBeat animate__infinite"
                );

                $("body").css("overflow", "hidden");
            },
            onCloseEnd: function (el) {
                $(document).trigger("modalFechou", el.id);
                console.log("modalFechou", el.id);

                $("body").css("overflow", "auto");
            },
        });
    }

    $(".tooltipped").tooltip();

    $(".collapsible").collapsible({
        onOpenEnd: function (el) {
            //Foco no primeiro elemento
            var focus = $(el).find(".focus-first");
            focar(focus);

            //Atualiza as abas internas
            var tabs = $(el).find(".tabs");
            if (tabs.length > 0) {
                $(".tabs").tabs("updateTabIndicator");
            }
        },
    });

    $(".collapsible.expandable").collapsible({
        accordion: false,
    });

    $(".tabs").tabs();

    $("select").formSelect();
    $("select[required]").css({
        display: "inline",
        height: 0,
        padding: 0,
        width: "100%",
    });

    ativarDatepicker();

    if ($(".timepicker").length > 0) {
        $(".timepicker").timepicker({
            i18n: {
                clear: "Limpar",
                cancel: "Cancelar",
                done: "Ok",
            },
            onCloseEnd: function () {
                $(document).trigger("timepickerFechou", this.el.id);
                console.log("timepickerFechou", this.el.id);
            },
            twelveHour: false,
            container: "body",
        });
    }

    M.updateTextFields();

    $(".materialize-textarea").each(function (index) {
        M.textareaAutoResize(this);
    });

    $(".ac").each(function (ind, obj) {
        var datasource = $(obj).data("ac");
        var onselect = $(obj).data("onselect");
        var onenter = $(obj).data("onenter");
        var msgvazio = $(obj).data("msgvazio");
        //Setando essa variável como 'false', fará com que o sistema faça a busca, mesmo que os resultados não sejam retornados
        // Tipo, se você digitar 'Joa' e não houver nenhum resultado, as proximas consultas serão ignoradas
        // Se setar como false, ele fará as outras consultas mesmo que as primeiras não tenham gerado resultado
        var preventBadQueries = $(obj).data("pbq");
        var naoesperar = $(obj).data("naoesperar");
        var parametrosextra = $(obj).data("parametrosextra");
        parametrosextra =
            parametrosextra == undefined || parametrosextra.length == 0
                ? {}
                : typeof parametrosextra == "object"
                ? parametrosextra
                : typeof parametrosextra == "string"
                ? { c: parametrosextra }
                : JSON.parse(parametrosextra);

        //Criando o helper para indicar o que fazer com o componente
        if (!document.getElementById(obj.id + "_helper")) {
            var helper = document.createElement("span");
            helper.id = obj.id + "_helper";
            helper.innerText = "Digite pelo menos 3 caracteres.";
            helper.className = "helper-text red-text";
            obj.parentNode.appendChild(helper);
        }

        if (!document.getElementById(obj.id + "_carregando")) {
            var carr = document.createElement("div");
            carr.id = obj.id + "_carregando";
            carr.className = "progress hide";
            var barra = document.createElement("div");
            barra.className = "indeterminate";
            carr.appendChild(barra);
            obj.parentNode.appendChild(carr);
        }

        $(obj).keyup((event) => {
            switch ($(obj).val().length) {
                case 0:
                case 1:
                    document.getElementById(obj.id + "_helper").innerText =
                        "Digite pelo menos 3 caracteres.";
                    break;
                case 2:
                    document.getElementById(obj.id + "_helper").innerText =
                        "Para buscar com 2 caracteres, pressione a barra de espaço.";
                    break;
                default:
                    document.getElementById(obj.id + "_helper").innerText = "";
                    break;
            }
        });

        if (onenter) {
            $(obj).keydown((event) => {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    eval(onenter);
                    return false;
                }
            });
        }
        $("#" + obj.id).devbridgeAutocomplete({
            minChars: 3,
            preventBadQueries: preventBadQueries
                ? preventBadQueries == "false"
                    ? false
                    : true
                : false,
            serviceUrl: datasource,
            paramName: "query",
            params: {
                params: function () {
                    var p = document.getElementById(obj.id).dataset
                        .parametrosextra;
                    return p;
                },
            },
            dataType: "json",
            noCache: true,
            autoSelectFirst: true,
            showNoSuggestionNotice: true,
            noSuggestionNotice: msgvazio
                ? msgvazio
                : "Nenhum resultado encontrado.",
            deferRequestBy: naoesperar
                ? naoesperar == "true"
                    ? 0
                    : 1000
                : 1000,
            onSelect: function (s) {
                $("#" + obj.id + "_id").val(s.data);
                if (onselect) {
                    eval(onselect);
                }
            },
            onHide: function (s) {
                if ($("#" + obj.id + "_id").val().length == 0) {
                    $("#" + obj.id).val("");
                }
            },
            transformResult: function (response) {
                return {
                    suggestions: $.map(response.data, function (dataItem) {
                        return {
                            value: dataItem.nome,
                            subvalue: dataItem.subnome
                                ? dataItem.subnome
                                : false,
                            data: dataItem.id,
                            imagem: dataItem.imagem,
                        };
                    }),
                };
            },
            formatResult: function (suggestion) {
                if (suggestion.imagem) {
                    let imagem = suggestion.imagem.includes("http")
                        ? suggestion.imagem
                        : base_imagens +
                          "empresa_" +
                          empresas_id +
                          "/t_" +
                          suggestion.imagem;
                    return (
                        '<div class="item-ac"><div class="img" style="background-image: url(' +
                        imagem +
                        ')" /><span> ' +
                        suggestion.value +
                        (suggestion.subvalue
                            ? "<br>" + suggestion.subvalue
                            : "") +
                        "</span></div>"
                    );
                } else {
                    return (
                        '<div class="item-ac"><span>' +
                        suggestion.value +
                        (suggestion.subvalue
                            ? "<br>" + suggestion.subvalue
                            : "") +
                        "</span></div>"
                    );
                }
            },
            onSearchStart: function (params) {
                $("#" + obj.id + "_carregando").removeClass("hide");
                $("#" + obj.id + "_helper").addClass("hide");
            },
            onSearchComplete: function (params) {
                $("#" + obj.id + "_carregando").addClass("hide");
                $("#" + obj.id + "_helper").removeClass("hide");
            },
        });
        $("#" + obj.id).attr("autocomplete", "off");
    });

    $(".no-enter-submit").keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $(".no-enter-submit-button").keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            Aviso.fire({
                icon: "error",
                title: "Utilize o botão de Salvar para confirmar as alterações.",
            });
            $(event.currentTarget)
                .find("button[type=submit]")
                .addClass("animate__animated animate__tada");
            setTimeout(() => {
                $(event.currentTarget)
                    .find("button[type=submit]")
                    .removeClass("animate__animated animate__tada");
            }, 1000);
            return false;
        }
    });

    $(".selectall").focus(() => {
        var save_this = $(this);
        window.setTimeout(() => {
            save_this.select();
        }, 100);
    });

    $("input.contador, textarea.contador").characterCounter();

    // $(".carousel.carousel-slider").carousel({
    //     fullWidth: true,
    //     indicators: true,
    //     duration: 200,
    // });

    $(".slider").slider();
}

function focar(obj, select) {
    if (typeof obj == "string") {
        //Pode mandar o obj com ou sem o #
        obj = obj.replace("#", "");
        const element = document.getElementById(obj);
        if (element) {
            const focusEvent = new Event("focus");
            element.dispatchEvent(focusEvent);
            // const clickEvent = new Event("click");
            // element.dispatchEvent(clickEvent);
            if (select) {
                setTimeout(() => {
                    document.getElementById(obj).select();
                }, 100);
            }
        }
    } else {
        if (obj) {
            if (obj.length > 0) {
                if (obj[0].type == "select-one") {
                    $(obj[0]).parent().find("input").trigger("click");
                } else {
                    $(obj[0]).focus();
                }
            }
        }
    }
}

function ativarDatepicker() {
    if ($(".datepicker").length > 0) {
        $(".datepicker").datepicker({
            i18n: {
                months: [
                    "Janeiro",
                    "Fevereiro",
                    "Março",
                    "Abril",
                    "Maio",
                    "Junho",
                    "Julho",
                    "Agosto",
                    "Setembro",
                    "Outubro",
                    "Novembro",
                    "Dezembro",
                ],
                monthsShort: [
                    "Jan",
                    "Fev",
                    "Mar",
                    "Abr",
                    "Mai",
                    "Jun",
                    "Jul",
                    "Ago",
                    "Set",
                    "Out",
                    "Nov",
                    "Dez",
                ],
                weekdays: [
                    "Domingo",
                    "Segunda",
                    "Terça",
                    "Quarta",
                    "Quinta",
                    "Sexta",
                    "Sábado",
                ],
                weekdaysShort: [
                    "Dom",
                    "Seg",
                    "Ter",
                    "Qua",
                    "Qui",
                    "Sex",
                    "Sáb",
                ],
                weekdaysAbbrev: ["D", "S", "T", "Q", "Q", "S", "S"],
                clear: "Cancelar",
                today: "Hoje",
                done: "Ok",
            },
            format: "dd/mm/yyyy",
            yearRange: 70,
            onOpen: function () {
                var instance = this.el.M_Datepicker;
                var data = this.el.value.split("/");
                var d = parseInt(data[0]);
                var m = parseInt(data[1]) - 1;
                var a = parseInt(data[2]);
                data = new Date(a, m, d);
                instance.setDate(data);
                $(document).trigger("datepickerAbriu", this.el.id);
                console.log("datepickerAbriu", this.el.id);
            },
            onClose: function () {
                $(document).trigger("datepickerFechou", this.el.id);
                console.log("datepickerFechou", this.el.id);
            },
            container: "body",
        });
    }
}

function aviso(texto, tipo, time) {
    Aviso.fire({
        title: texto,
        icon: tipo ? tipo : "success",
        timer: time ? time : 5000,
    });
}

function abrirZap(numero, texto) {
    if (!texto) {
        texto = "Olá";
    }
    var numero = numero.replace(/\D/g, "");
    if (numero.length > 10) {
        window.open(
            `https://api.whatsapp.com/send/?phone=55${numero}&text=${texto}`,
            "_system"
        );
    } else {
        aviso("Número inválido.", "error");
    }
}

function abrirLigacao(numero){
    window.location.href = `tel://${numero}`;
}

function abrirEmail(nome, email){
    window.open(`mailto:${email}?subject=Olá ${nome}&body=E aí, como vai?`);
}
