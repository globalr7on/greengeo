<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Ativação para acesso na greenbeat</title>
</head>
<body>
    <h1>Olá</h1>
    <h3> Seja Bem-vindo na Greenbeat <strong> {{ $name }} </strong> | <strong>{{ $email }}</h3>
    <p>
        Voce foi Cadastrado como <strong>{{ $funcao }}</strong> pela empresa {{ $transportadora }}  Por gentileza complete o cadastro para poder ter acesso as ordems de serviços atribuído ao seu usuário<br> Seus dados de acesso são: <br><br> CPF: <strong>{{ $cpf }} </strong> <br>Senha temporária: <strong>{{ $password  }}</strong> <br><br> acesse nosso guia em www.guia.greenbeat.com.br
    </p>
    <p>
</body>
</html>