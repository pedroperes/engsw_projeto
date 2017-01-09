<?php

session_start();
require 'lib/nusoap.php';
require 'password_compat-master/lib/password.php';

// WEB SERVICE ADMIN //

$namespace = "http://localhost/engsw/proj_pedroperes30075_jorgegodinho29814/ws2.php";
$server = new nusoap_server();


$server->configureWSDL('ws2wsdl', 'urn:ws2wsdl');
$server->wsdl->schemaTargetNamespace = $namespace;

$server->register(
        'updateInstructor', // method name
        array('nome' => 'xsd:string', // input parameters
    'gender' => 'xsd:string',
    'email' => 'xsd:string',
    'id' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws2wsdl', // namespace
        'urn:ws2wsdl#updateInstructor', // soapaction
        'rpc', // style
        'encoded', // use
        'Atualizar docente'                        // documentation
);

$server->register(
        'giveGrades', // method name
        array('student_id' => 'xsd:string', // input parameters
    'course_id' => 'xsd:string',
    'grade' => 'xsd:string'), // input parameters
        array('return' => 'xsd:string'), // output parameters
        'urn:ws2wsdl', // namespace
        'urn:ws2wsdl#giveGrades', // soapaction
        'rpc', // style
        'encoded', // use
        'Lançar nota'                        // documentation
);

$server->register(
    'searchFreeRoom',                             // method name
    array('room'=>'xsd:string'),                           // input parameters
    array('result' => 'tns:query'),                     // output parameters
    'urn:ws2wsdl',                                   // namespace
    'urn:ws2wsdl#listRoom',                      // soapaction
    'rpc',                                              // style
    'encoded',                                          // use
    'Lista todas as salas livres'                      // documentation
);

// ------------------------------------------------------------------------- //

//LANCAR NOTAS EM BAIXO
function giveGrades($student_id, $course_id, $grade)
{
     $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $query = "INSERT into grade (student_id, course_id, grade, date) VALUES (" . $student_id . ", " . $course_id . ", " . $grade . ", curdate());";
    
    if (mysqli_query($conn, $query)) {
        $msg = "Registo feito com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function updateInstructor($nome, $gender, $email, $id) {
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "UPDATE instructor SET name='$nome', gender='$gender', email='$email' WHERE id=" . $id;

    if (mysqli_query($conn, $query)) {
        $msg = "Registo feito com sucesso!";
        return $msg;
    } else {
        $msg = "Erro ao registar!";
        return $msg;
    }

    mysqli_close($conn);
}

function searchFreeRoom($room)
{
    $servername = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "engswproj";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $query = "SELECT * FROM room r WHERE NOT EXISTS(SELECT * FROM class c WHERE r.id = c.room_id);";
    $result = mysqli_query($conn, $query);
    
    $array = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }
    
    mysqli_close($conn);
    
    return $array;
}

// Use the request to (try to) invoke the service -  XAMMP !!!!
if (!isset($HTTP_RAW_POST_DATA))
    $HTTP_RAW_POST_DATA = file_get_contents('php://input');
$server->service($HTTP_RAW_POST_DATA);
?>