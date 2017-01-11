<?php
require 'includes.php';

// Se tivermos sessão então vai para home.php
if (isset($_SESSION['userSession']) != "") {
    header("Location: home-admin.php");
} 

if (isset($_POST['btn-login'])) {
    // Tirar tags de HTML e PHP da string
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    // Tirar caracteres especiais usados em SQL
    $email = $DBcon->real_escape_string($email);
    $password = $DBcon->real_escape_string($password);

    $query = $DBcon->query("SELECT id, email, password FROM admin WHERE email='$email'");
    $row = $query->fetch_array();

    $count = $query->num_rows; // se email/password estiverem corretos retorna 1 linha

    if (password_verify($password, $row['password']) && $count == 1) {
        $_SESSION['userSession'] = $row['id']; // mete o id do utilizador em $_SESSION['userSession']
        header("Location: home-admin.php"); // Senão entra na página de admin
    } else { // Mensagem de erro
        $msg = "<div class='alert alert-danger'>
					<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Username ou Password invalidas!
				</div>";
    }
    $DBcon->close();
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="Projeto" content="">
        <meta name="Pedro Peres, Jorge Godinho" content="">
        <link rel="icon" href="../../favicon.ico">

        <title>Login</title>

        <!-- Bootstrap core CSS -->
        <link href="../bootstrap-3.3.7/docs/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../bootstrap-3.3.7/docs/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="signin.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../bootstrap-3.3.7/docs/assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="signin-form">
                <form class="form-signin" method="post" id="login-form">
                    <h2 class="form-signin-heading">Login</h2><hr />
                    <?php
                    if (isset($msg)) {
                        echo $msg;
                    }
                    ?>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email" required />
                        <span id="check-e"></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required />
                    </div>

                    <hr />
                    <div class="form-group">
                        <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
                            <span class="glyphicon glyphicon-log-in"></span> &nbsp; Login
                        </button> 
                        <a href="login-docente.php" class="btn btn-default" style="float:right;">Login Docente</a>
                        <a href="index.php" class="btn btn-default" style="float:right;">Login Aluno</a>
                    </div>  
                </form>
            </div>
        </div>
        <div class="col-sm-4"></div>
        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
        <script src="../bootstrap-3.3.7/docs/dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../bootstrap-3.3.7/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>