<?php

$request = $_POST['request'];
$sector = $_POST['sector'];

$curl= curl_init();
curl_setopt( $curl, CURLOPT_URL, "http://52.22.17.129/moinhos_farm/validate.request.rule.php?request=$request&sector=$sector" );
curl_setopt( $curl, CURLOPT_HEADER, false ); // para não retornar os Headers
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ); // para retornar na variável
$resultado = curl_exec( $curl );
curl_close( $curl );

echo $resultado;

?>