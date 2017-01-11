<?php

class Sala {

    function __construct() {
        
    }

    function setRoom($selectRoom, $selectInstructor, $selectCourse, $day, $start_hour, $duration) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT id FROM instructor WHERE name='$selectInstructor'";
        $result = mysqli_query($conn, $query);
        $selectInstructor = $result->fetch_assoc();

        $query = "SELECT id FROM room WHERE number='$selectRoom'";
        $result = mysqli_query($conn, $query);
        $selectRoom = $result->fetch_assoc();

        $query = "SELECT id FROM course WHERE title='$selectCourse'";
        $result = mysqli_query($conn, $query);
        $selectCourse = $result->fetch_assoc();

        $query = "INSERT INTO class(course_id,room_id,instructor_id,day,start_hour, duration) VALUES "
                . "('" . $selectCourse['id'] . "','" . $selectRoom['id'] . "','" . $selectInstructor['id'] . "','" . $day . "','" . $start_hour . "','" . $duration . "')";

        if (mysqli_query($conn, $query)) {
            $msg = "Registado com sucesso!";
        } else {
            $msg = "Erro ao registar!";
        }

        mysqli_close($conn);
        
        return $msg;
    }

    function searchFreeRoom($room) {
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

}

/* end of class engsw.projeto_Sala */
?>