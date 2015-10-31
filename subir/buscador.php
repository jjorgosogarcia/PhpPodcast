<!DOCTYPE html>
<?php
require '../clases/AutoCarga.php';
$request = new Request();
$sesion = new Session();
$user = $sesion->get("user");
$categoria = $sesion->get("categorias");

$categoria2 = $request->post("categorias2");
$usuarioabuscar = $request->post("usuario");
$quien = $request->post("persona");
$canciones = new Utilidades();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="../estilos/estilosPaginas.css" rel="stylesheet">
    </head>
    <body>
        <header class="contenedorCabecera">
            <div class="cabecera">
                <nav>
                    <ul>
                        <li><a href="index.php">Subir</a></li>
                        <li><a class="actual">Canciones</a></li>
                        <li><a href="../login/phplogout.php">Logout</a></li>
                    </ul>
                </nav>
                <div class="separador"></div>
            </div>
        </header>   

        <form action="buscador.php" method="post">
            <fieldset id="subirCancion">
                <legend>Buscador de canciones</legend>
                <p>¿Que archivos quieres buscar?</p>
                <input class="rb" type="radio" name="persona" value="yo" checked >Mis canciones
                <input class="rb" type="radio" name="persona" value="otras">Otros usuarios
                <input type="text" class="oculto" name="usuario" value="" placeholder="Nombre del usuario" />
                <p> <label for="categoria">Seleccione la categoria que quiera buscar</label></p>
                <select name="categorias2">
                    <option value="pop">Pop</option>
                    <option value="rock">Rock</option>
                    <option value="hiphop">Hip Hop</option>
                    <option value="electronica">Electrónica</option>
                    <option value="jazz">Jazz</option>
                    <option value="blues">Blues</option>
                </select><br/><br/>
                <input type="submit" name="submit" />
            </fieldset>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            ?>
            <div id="tablaCanciones">
                <table class="tabla" >
                    <tr>
                        <td><b>Cancion</b></td>
                        <td><b>Categoría</b></td>
                        <td><b>Reproducir</b></td>
                    </tr>
                    <?php
                    if ($quien == "yo") {
                        $canciones->getCanciones($user, $categoria2, $canciones->getDirectorio($user . "/" . $categoria2), true);
                    } else {
                        $canciones->getCanciones($usuarioabuscar, $categoria2, $canciones->getDirectorio2($usuarioabuscar . "/" . $categoria2), false);
                    }
                    ?>
                </table>
            </div>     
            <?php
        }
        ?>
    </body>
</html>
