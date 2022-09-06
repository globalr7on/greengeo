<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>solicitação de Coleta</title>
</head>
<body>
  
    <h1>Olá {{ $transportadora  }}</h1>
    <p>
    Gostaríamos de formalizar com a  <strong> {{ $transportadora }} </strong> o agendamento de coleta a ser realizada no dia <strong> {{ $data_inicio_coleta }} </strong> até o dia <strong> {{ $data_final_coleta }} </strong>
    <li>Peso Total: <strong>{{ $peso_total }} </strong> </li>
    <li>Veículo ideal para coleta: <strong>{{ $acondicionamento }} </strong> </li>
    <br>
    <br>

    Atenciosamente,
    <li>
    <strong> {{  $gerador }} </strong>  
    </li>
    <li>
    <strong> {{ $usuario }} </strong>
    </li>
    <li>
    <strong> {{ $celular }} </strong>    
    </li>
    

    

</p>
    <p>
</body>
</html>