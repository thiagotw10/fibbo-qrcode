<?php
$conexion = oci_connect("Wings", "Wings", "localhost/ORARAC.WORLD");  
if (!$conexion) {    
  $m = oci_error();    
  echo $m['message'], "n";    
  exit; 
} else {    
  echo "Conexión con éxito a Oracle!"; } 
?>