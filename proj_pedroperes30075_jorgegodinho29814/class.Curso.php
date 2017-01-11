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
            $msg = "Curso criado com sucesso!";
        } else {
            $msg = "Erro ao registar!";
        }

        mysqli_close($conn);
        
        return $msg;
    }

}

/* end of class engsw.projeto_Curso */
?>