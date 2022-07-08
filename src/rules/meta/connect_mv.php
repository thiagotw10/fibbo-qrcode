<?php
/*$connMV =  oci_connect('Wings','Wings','PRD') or 
die('Erro: Favor Sair do navegador e entrar novamente no Portal.');
*/
//200.238.32.18
/*
$ora_user = "Wings";
$ora_senha = "Wings";
$character_set = 'UTF8';

$ora_bd = "(DESCRIPTION=
(ADDRESS_LIST=
(ADDRESS=(PROTOCOL=TCP)(HOST=200.238.32.17)(PORT=1521))
)
(CONNECT_DATA=
(SERVICE_NAME=ORARAC.WORLD)
)
)";
if ($connMV = oci_connect($ora_user,$ora_senha,$ora_bd, $character_set) ) {

}else {
echo "Erro na conexão com o Oracle.";
}
*/

$curl= curl_init();
   curl_setopt( $curl, CURLOPT_URL, 'http://52.22.17.129/moinhos_api/meta/connect_mv.php' );
   curl_setopt( $curl, CURLOPT_HEADER, false ); // para não retornar os Headers
   curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ); // para retornar na variável
   $resultado = curl_exec( $curl );
   curl_close( $curl );

   // Processe o resultado para formatar adequadamente
   // e/ou extrair apenas as partes desejadas.
   echo $resultado;

?>