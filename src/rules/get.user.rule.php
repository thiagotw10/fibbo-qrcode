<?php

include('meta/connect_mv.php'); 

$ConsultaNomeSolic = oci_parse($connMV, "SELECT NM_USUARIO FROM DBAHMV.WINGS_VI_USUARIOS WHERE CD_USUARIO = 'elder.pinto'");

  $return = oci_execute($ConsultaNomeSolic);
  while($rowNomeSolic = oci_fetch_array($ConsultaNomeSolic, OCI_BOTH)) {
    echo $nomesolic     = utf8_encode($rowNomeSolic['NM_USUARIO']); 
  }
