<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$user = $sesion->get("user");


if ($user == null) {
    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sube tu cancion</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link href="../estilos/estilosPaginas.css" rel="stylesheet">
    </head>
    <body>
        <header class="contenedorCabecera">
        <div class="cabecera">
            <nav>
                <ul>
                    <li><a class="actual">Subir</a></li>
                    <li><a href="buscador.php">Canciones</a></li>
                    <li><a href="../login/phplogout.php">Logout</a></li>
                </ul>
            </nav>
            <div class="separador"></div>
        </div>
        </header>

        <div id="contenedor">
            <div id="bienvenida">
                <h2>Bienvenido <?php echo $user; ?></h2>
            </div>
            <div id="subirCancion">
                <form action="subir.php" method="post"
                      enctype="multipart/form-data">
                    <fieldset id="subirCancion">
                        <legend>Sube tu canción</legend>
                        <input id="file" type="file" name="archivo"/><br/><br/>
                        <label for="privada">Privada</label>
                        <input type="checkbox" name="privada" value="si" /><br/><br/>
                        <label for="categoria">Seleccione la categoria del archivo</label>
                        <select name="categorias">
                            <option value="pop">Pop</option>
                            <option value="rock">Rock</option>
                            <option value="hiphop">Hip Hop</option>
                            <option value="electronica">Electrónica</option>
                            <option value="jazz">Jazz</option>
                            <option value="blues">Blues</option>
                        </select><br/><br/>
                        <input type="submit" />
                    </fieldset>
                </form>
            </div>  
        </div>
    </body>
</html>
