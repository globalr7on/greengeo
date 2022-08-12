<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nova ORdem de Serviço para reciclagem</title>
</head>
<body>
    <h1>Olá</h1>
    <h3> Seja Bem-vindo na Greenbeat <strong> {{ $tipoB }} </strong></h3>
    <!-- <p>
        Sua empresa foi cadastrada como <strong> Destinador </strong> para os produtos ou sucatas de nossa empresa. Por gentileza complete o cadastro de seus dados e também informe os usuários autorizados ao uso do sistema , atribuindo as permissões de cada um .No caso de tramsportadoras os dados dos veículos da frota deverão ser informados .Para maiores informações , acesse nosso guia em www.guia.greenbeat.com.br
    </p> -->
    <p>
        Olá
        Sua empresa  <strong> {{ $tipoB }} </strong> receberá uma carga descrita na OS gerada por nós <strong>{{ $tipoA }} </strong>
        Esta carga será transportada pela empresa <strong> {{ $tipoC }} </strong> 
        Na OS constam as seguintes informações além da especificação da carga:
     
    </p>
    <ul>
        <li> * Data da coleta</li>
        <li> * Hora da coleta</li>
        <li> * Data prevista da entrega no Destino</li>
        <li> * Hora prevista da entrega no Destino </li>
        <li> * Motorista responsavel</li>
        <li> * Véiculo</li>
    </ul>
</body>
</html>