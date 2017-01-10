<?php
require 'includes.php';

class Docente {
    
    function __construct() {
        
    }

    function registerInstructor($uname, $email, $gender, $upass) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

// So funciona em PHP 5.5 ou mais recente, portanto usei uma lib que me permite usar esta função
        $hashed_password = password_hash($upass, PASSWORD_DEFAULT);

        $query = "INSERT INTO instructor(name,email,password, gender) VALUES('$uname','$email','$hashed_password', '$gender')";

        if (mysqli_query($conn, $query)) {
            $msg = "Registo feito com sucesso!";
            return $msg;
        } else {
            $msg = "Erro ao registar!";
            return $msg;
        }

        mysqli_close($conn);
    }
    
    function addInstructorCourse($instructor_id, $course_id, $section_id) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "INSERT INTO teaches(instructor_id,course_id,section_id) VALUES ('" . $instructor_id . "','" . $course_id . "','" . $section_id . "')";

        if (mysqli_query($conn, $query)) {
            $msg = "Registado com sucesso!";
            return $msg;
        } else {
            $msg = "Erro ao registar!";
            return $msg;
        }

        mysqli_close($conn);
    }
    
    function giveGrades($student_id, $course_id, $grade) {
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

}

/* end of class engsw.projeto_Docente */
?>