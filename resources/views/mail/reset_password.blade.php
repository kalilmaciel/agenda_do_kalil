<!DOCTYPE html>
<html>

<head>
    <title>Resetar Senha</title>
</head>

<body>
    <div style="width: 100%; background-color: #FFF; margin: 0; padding: 0; font-family: 'Roboto', sans-serif">
        <div
            style="width: 80%; max-width: 800px; margin: 20px auto; background-color: #fff; border: solid 1px #ff914d; border-radius: 10px; padding: 20px; height:90%">
            <img src="{{ asset('assets/img/login-logo.png') }}" alt="F.R.I.E.N.D.S"
                style="display: block; margin: 20px auto; width: 50%; max-width: 200px" />
            <h1 style="text-align: center; font-size: 16px">
                Olá, {{ $user->name }}!
            </h1>
            <br>
            <br>
            <p style="width: 100%; text-align: center">
                Clique no botão abaixo para ser direcionado à página de definição de uma nova senha. <br>
                Você tem até 60 minutos para efetuar a troca da sua senha.<br>
                Caso este prazo expire, faça uma nova solicitação de alteração de senha.<br><br>
                Caso não tenha solicitado a troca de senha, por favor, desconsidere este e-mail.
            </p>
            <br>
            <p style="width: 100%; text-align: center">
                <a href="{{ $resetUrl }}" target="_blank"
                    style="background-color: #ff914d; padding: 10px 20px; color: #FFF; border-radius: 5px ">
                    Definir uma nova senha
                </a>
            </p>

            <br>
            <p style="width: 100%; text-align: center">
                Um abraço da equipe {{ env('APP_NAME') }}.
            </p>
            <br>
            <p style="width: 100%; text-align: center">
                <small>Obs: sua experiência de uso do sistema pode variar dependendo <br>
                    da versão do seu aparelho/computador e configurações.</small>
            </p>
            <br>
            <p style="text-align: center">
                &copy; <?= date('Y') ?>. <a href="{{ env('APP_URL') }}" target="_blank">{{ env('APP_NAME') }}</a>
            </p>
        </div>

    </div>

</body>

</html>
