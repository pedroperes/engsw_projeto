<?php
class Curso {

    function __construct() {
        
    }

    function createDegree($name, $code) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "INSERT INTO degree(name,code) VALUES('$name','$code')";

        if (mysqli_query($conn, $query)) {
            $msg = "Disciplina criada com sucesso!";
            return $msg;
        } else {
            $msg = "Erro ao registar!";
            return $msg;
        }

        mysqli_close($conn);
    }

}

/* end of class engsw.projeto_Curso */
?>