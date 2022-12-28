<?php

include('meta/connect_mv.php'); 

$request 		= $_REQUEST['request'];	
$sector = $_REQUEST['sector'];	

$sql_validate_request = oci_parse($connMV, "
  SELECT DISTINCT										      
    SOLICITACAO,
    CD_ATENDIMENTO 
  FROM 
    DBAHMV.WINGS_VI_FARMACIA
  WHERE 
    SOLICITACAO = $request
    AND CD_SETOR = $sector 
");

$return = oci_execute($sql_validate_request);		
$rows_validate_request = oci_fetch_array($sql_validate_request, OCI_BOTH);

if ($rows_validate_request > 0){
  echo 1;
}else{
  echo 0;
}
