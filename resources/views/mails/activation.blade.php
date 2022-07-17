<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Ativação para acesso na greenbeat</title>
</head>
<body>
    <h3> Seja Bem-vindo na Greenbeat <strong> {{ $name }} </strong> | <strong>{{ $email }}</strong> agora pode entrar com seu CPF e a senha temporal criada para voce</h3>
    <ul>
       <p>Usuario: {{ $cpf }}</p>
       <p>Senha Temporal: <strong>{{ $password }}</strong></p>
    </ul>
</body>
</html>