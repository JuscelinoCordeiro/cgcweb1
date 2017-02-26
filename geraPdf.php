<?php

    require_once './controle/classes/dompdf/dompdf/dompdf_config.inc.php';

    $str = '<html> 
<head>
<meta charset="UTF-8">
<title>teste de PDF</title>
<style>
* { font-family: sans-serif; }
</style>
</head>
 
<body>
 
<header>
    <h1>Atenção, isso é apenas um teste</h1>
    <p>Estou dando um exemplo pra vc CLEYTON, sobre como utilizar a dompdf. 
    Meu nome é <b>Juscelino </b> E trabalho no <em>Exército Brasileiro</em> 
    Minha foto segue abaixo:
    </p>
    
    <p style="text-align:center">
        <img src="/home/apolo/Imagens/eu_pb.jpg">
    </p>
</header>
 
</body>
 
</html>';

    $domPdf = new DOMPDF();

    $domPdf->load_html('
<!doctype html>        
<html> 
<head>
<meta charset="UTF-8">
<title>teste de PDF</title>
<style>
* { font-family: sans-serif; }
</style>
</head>
 
<body>
 
<header>
    <h1>Atenção, isso é apenas um teste</h1>
    <p>Estou dando um exemplo pra vc CLEYTON, sobre como utilizar a dompdf. 
    Meu nome é <b>Juscelino </b> E trabalho no Exército Brasileiro. 
    Minha foto segue abaixo:
    </p>
    
    <p style="text-align:center">
        <img src="/home/apolo/Imagens/eu_pb.jpg">
    </p>
</header>
 
</body>
 
</html>');

    $domPdf->render();

    $domPdf->stream("saida.pdf", array("Attachment" => false)
    );
?>

