<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$user = $sesion->get("user");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../estilos/estiloLogin.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <?php
        if ($user == null) {
            ?>
            <form name="login" action="phplogin.php" method="POST">
                <div class="logo"></div>
                <div class="login-block">
                    <h1>Login</h1>
                    <input type="text" name="user" value="" placeholder="Username" id="user" />
                    <input type="password" name="password" value="" placeholder="Password" id="password" />
                    <input type="submit" value="Login" name="login"/>
                </div>
            </form>
            <?php
        } else {
            ?>  
            <a href="phplogout.php">logout</a>
            <?php
        }
        ?>
    </body>
</html>

