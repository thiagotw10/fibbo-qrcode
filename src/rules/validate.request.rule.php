<?php

$request = $_POST['request'];

echo $request == 40268647 ? true : false;

// include('meta/connect_mv.php');  //$connMV

// $IP = $_SERVER["REMOTE_ADDR"];
  

// $farm_req 		= $_REQUEST['request'];	
// $farm_req_setor = $_REQUEST['sector'];	

// $a=0;
// $farm_req_ori = array();	

// //Trazendo os dados do atendimento
// if($farm_req!=''){
//   $TipoAtende = oci_parse($connMV, "
//   SELECT DISTINCT										      
//     SOLICITACAO,
//     CD_ATENDIMENTO 
//   FROM 
//     DBAHMV.WINGS_VI_FARMACIA
//   WHERE 
//     SOLICITACAO = $farm_req
//     AND CD_SETOR = $farm_req_setor 
  
//   ");
//   $return = oci_execute($TipoAtende);		
//   while ($rowmnt_tipoAtende = oci_fetch_array($TipoAtende, OCI_BOTH)) {    				
//       $CD_ATENDIMENTO = $rowmnt_tipoAtende['CD_ATENDIMENTO'];
//       $SOLICITACAO = $rowmnt_tipoAtende['SOLICITACAO'];
        
//       $farm_req_ori[] = array(									
//                   'farm_req_ori'	=> $rowmnt_tipoAtende['CD_ATENDIMENTO'],
//                     'solicitacao'			=> $SOLICITACAO ,
//                 );
//       $a=1;					
      
//   } 	
// }