<?php

$requestsConcat = $_POST['requestsConcat'];
$requests = $_POST['requests'];
$sector = $_POST['sector'];
$userCode = $_POST['userCode'];
$user = $_POST['user'];

$post = [
  'requestsConcat' => $requestsConcat,
  'requests' => json_encode($requests),
  'sector' => $sector,
  'userCode' => $userCode,
  'user' => $user
];

  // var_dump($post);

  $url = "http://52.22.17.129/app_avulso_backend/process.request.php";

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

