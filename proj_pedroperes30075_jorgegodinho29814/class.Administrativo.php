<?php
require 'includes.php';

class Administrativo {
    
    function __construct() {
        
    }
    
    function registerAdmin($uname, $email, $upass) {
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

        $query = "INSERT INTO admin(name,email,password) VALUES('$uname','$email','$hashed_password')";

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

/* end of class engsw.projeto_Administrativo */
?>