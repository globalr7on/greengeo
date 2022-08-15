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
        Sua empresa foi cadastrada como <strong>{{ $tipo }}</strong> para os produtos ou sucatas de nossa empresa. Por gentileza complete o cadastro.<br> Seus dados de acesso são: <br><br> CPF: <strong>{{ $cpf }} </strong> <br>Senha temporária: <strong>{{ $password  }}</strong> <br><br>Também informe os usuários autorizados ao uso do sistema, atribuindo as permissões de cada um. No caso de tramsportadoras os dados dos veículos da frota deverão ser informados. Para maiores informações, acesse nosso guia em www.guia.greenbeat.com.br
    </p>
    <p>
</body>
</html>