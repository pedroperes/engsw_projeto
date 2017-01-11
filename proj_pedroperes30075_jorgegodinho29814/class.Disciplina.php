<?php

class Disciplina {

    function __construct() {
        
    }

    function createCourse($title, $ects, $selectDegree, $description) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT id FROM degree WHERE name='$selectDegree'";
        $result = mysqli_query($conn, $query);
        $userRow = $result->fetch_assoc();

        $query = "INSERT INTO course (title, ects, degree_id, description) VALUES ('$title'," . $ects . "," . $userRow['id'] . ", '$description')";

        if (mysqli_query($conn, $query)) {
            $msg = "Disciplina criada com sucesso!";
        } else {
            $msg = "Erro ao registar!";
        }

        mysqli_close($conn);

        return $msg;
    }

}

/* end of class engsw.projeto_Disciplina */
?>