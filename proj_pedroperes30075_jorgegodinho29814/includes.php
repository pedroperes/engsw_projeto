<?php
session_start();
require_once 'lib/nusoap.php';
require_once 'dbconnect.php';
// Libraria que me permite usar a função password_verify/hash em versões anteriores a PHP 5.5
require_once 'password_compat-master/lib/password.php';


require_once 'class.Administrativo.php';
require_once 'class.Aluno.php';
require_once 'class.Curso.php';
require_once 'class.Disciplina.php';
require_once 'class.Docente.php';
require_once 'class.Sala.php';



?>
