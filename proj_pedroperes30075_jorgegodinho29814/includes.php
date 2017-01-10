<?php

session_start();
require 'lib/nusoap.php';
require 'dbconnect.php';
// Libraria que me permite usar a função password_verify/hash em versões anteriores a PHP 5.5
require 'password_compat-master/lib/password.php';
?>
