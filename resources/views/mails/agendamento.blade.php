<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>solicitação de Coleta</title>
</head>
<body>
  
    <h1>Olá {{ $transportadora }}</h1>
    <p>
    Gostaríamos de formalizar com a  <strong> {{ $transportadora }} </strong> o agendamento de coleta para OS com Codigo <strong> {{ $codigo }} </strong> a ser realizada no dia {{ $data_coleta }} 
    <li>tipo de Produto <strong> {{ $descricao_produto }}</strong></li>
    <li>Peso Total OS <strong> {{ $peso_total}}</strong></li>
    <li>Veículo ideal para coleta: <strong>{{ $acondicionamento }} </strong> </li>
    <br>
    <br>

    Atenciosamente,
    <li>
    <strong> {{  $gerador }} </strong>
    </li>
    <li>
    <strong> {{ $usuario_gerador }} </strong>
    </li>
    <li>
    <strong> {{ $telefono_gerador }} </strong>    
    </li>
    

    

</p>
    <p>
</body>
</html>