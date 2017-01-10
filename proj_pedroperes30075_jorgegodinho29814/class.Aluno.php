<?php
require 'includes.php';

class Aluno
{
    function __construct() {
        
    }
    
    function registerStudent($uname, $email, $gender, $upass) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

        $query = "INSERT INTO student(name,email,password, gender) VALUES('$uname','$email','$hashed_password', '$gender')";

        if (mysqli_query($conn, $query)) {
            $msg = "Registo feito com sucesso!";
            return $msg;
        } else {
            $msg = "Erro ao registar!";
            return $msg;
        }

        mysqli_close($conn);
    }

    function listStudents($name, $code) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM student";
        $result = mysqli_query($conn, $query);
        $array = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        mysqli_close($conn);

        return $array;
    }

} /* end of class engsw.projeto_Aluno */

?>