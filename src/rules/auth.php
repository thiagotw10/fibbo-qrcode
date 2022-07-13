<?php

  // $user = $_POST['user'];
  // $password = $_POST['password'];

  // if ($user == 'test' && $password == 'test'){
  //   echo true;
  // }else{
  //   echo false;
  // }

  include('../commons/connect.pg.php'); //$conexao
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  
  error_reporting(E_ALL);
  //Parametros para o include da autenticação
  $userDigitado	= $_POST['user'];
  //$user 			= $userDigitado.'@rhp.intranet';
  $user 			= $userDigitado.'@nthmv';
  $ldap_pass   	= $_POST['password'];
  
  if ($ldap_pass != "" and !empty($ldap_pass)) {
    //Validamos se usuário e senha estão corretos
  
    //include ('http://52.22.17.129/moinhos_farm/meta/connect_ldap.php'); // LDAP LOGIN USUÁRIO
    $acesso = 1;
    if($acesso == 1){//Positivo		
      //Inicia a sessão
      session_start();
      //Registra os dados do usuário na sessão	
      $_SESSION["USR_LOGIN"] = $user;	
      $_SESSION["USR_DIGITADO"] = $userDigitado;
      $gestor=0;
      
      echo true;
    }else{
      echo false;
      
    }
  } else {
    echo false;
  }
  ?>