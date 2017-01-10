<?php
require 'includes.php';


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

        $query = "INSERT INTO class(course_id,room_id,instructor_id,day,start_hour, duration) VALUES "
                . "('" . $selectCourse . "','" . $selectRoom . "','" . $selectInstructor . "','" . $day . "','" . $start_hour . "','" . $duration . "')";

        if (mysqli_query($conn, $query)) {
            $msg = "Registado com sucesso!";
            return $msg;
        } else {
            $msg = "Erro ao registar!";
            return $msg;
        }

        mysqli_close($conn);
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