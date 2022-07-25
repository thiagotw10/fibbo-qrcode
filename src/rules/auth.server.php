<?php

$user = $_POST['user'];
$password = $_POST['password'];

$post = [
  'user' => $user,
  'password' => $password,
];

  $url = "http://52.22.17.129/app_avulso_backend/auth.php";

  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  @curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

  // execute!
  $response = curl_exec($ch);

  // close the connection, release resources used
  curl_close($ch);

  // do anything you want with your response
  //var_dump($response);

  echo $response;
  return true;

