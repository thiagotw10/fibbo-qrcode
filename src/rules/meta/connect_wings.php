<?php

ini_set("display_errors",1);
ini_set("display_startup_erros",1);
error_reporting(E_ALL);
if(!($conexao=pg_connect ("host=54.146.81.145 dbname=moinhos port=5432 user=postgres password=3wings"))) {
   print "Não foi possível estabelecer uma conexão com o banco de dados."; 
}
if(!@($conexaoClosedTask=pg_connect ("host=54.146.81.145 dbname=colabore_closed_task port=5432 user=postgres password=3wings"))) {
   print "Não foi possível estabelecer uma conexão com o banco de dados.";
}


?>