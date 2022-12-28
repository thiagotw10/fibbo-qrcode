<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
$acesso = 0;

//$ldap_server 	= "rhpdc1.rhp.intranet";
$ldap_server 	= "200.238.32.17";
$ldap_porta 	= "389";


$ldapcon = true//ldap_connect($ldap_server, $ldap_porta) 
or die("Não foi possível autenticar seu usuário. Por favor retorne em instantes!");

if ($ldapcon){
	// binding to ldap server
	//$ldapbind = ldap_bind($ldapconn, $user, $ldap_pass);
	$bind = true; //ldap_bind($ldapcon, $user, $ldap_pass);
	// verify binding
	if ($bind) {
		//echo "LDAP bind successful…";
		$acesso = 1;
	} else {
		//echo "LDAP bind failed…";
		$acesso = 0;
	}

}

?>