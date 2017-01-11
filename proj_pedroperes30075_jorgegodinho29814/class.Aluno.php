<?php

class Aluno {

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
        } else {
            $msg = "Erro ao registar!";
        }

        mysqli_close($conn);

        return $msg;
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

    function enrollDegree($student_id, $degree_id) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM degree WHERE name='$degree_id'";
        $result = mysqli_query($conn, $query);
        $userRow1 = $result->fetch_assoc();

        $query = "INSERT INTO student_degree (student_id, degree_id) VALUES (" . $student_id . ", " . $userRow1['id'] . ")";

        if (mysqli_query($conn, $query)) {
            $msg = "Registo feito com sucesso!";
        } else {
            $msg = "Erro ao registar!";
        }

        mysqli_close($conn);

        return $msg;
    }

    function enrollCourse($student_id, $course_id) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "SELECT * FROM course WHERE title='$course_id'";
        $result = mysqli_query($conn, $query);
        $userRow1 = $result->fetch_assoc();

        $query = "INSERT INTO student_course (student_id, course_id) VALUES (" . $student_id . ", " . $userRow1['id'] . ")";

        if (mysqli_query($conn, $query)) {
            $msg = "Registo feito com sucesso!";
        } else {
            $msg = "Erro ao registar!";
        }

        mysqli_close($conn);

        return $msg;
    }

    function updateStudent($nome, $gender, $email, $id) {
        $servername = "localhost";
        $username = "root";
        $password = "12345";
        $dbname = "engswproj";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $query = "UPDATE student SET name='$nome', gender='$gender', email='$email' WHERE id=" . $id;

        if (mysqli_query($conn, $query)) {
            $msg = "Registo feito com sucesso!";
        } else {
            $msg = "Erro ao registar!";
        }

        mysqli_close($conn);

        return $msg;
    }

}

/* end of class engsw.projeto_Aluno */
?>