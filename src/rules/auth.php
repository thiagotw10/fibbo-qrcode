<?php

  $user = $_POST['user'];
  $password = $_POST['password'];

  if ($user == 'test' && $password == 'test'){
    echo true;
  }else{
    echo false;
  }

