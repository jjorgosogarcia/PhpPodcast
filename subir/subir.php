<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$request = new Request();
$user = $sesion->get("user");


$usuario = Request::post("usuario");
$categoria = Request::post("categorias");
$privada = Request::post("privada");
$subir = new FileUpload("archivo");

if ($privada == "si") {
    $subir->setNombre("1_" . $user . "_" . $categoria . "_" . $subir->getNombre());
} else {
    $subir->setNombre("0_" . $user . "_" . $categoria . "_" . $subir->getNombre());
}

$subir->setPolitica(FileUpload::RENOMBRAR);
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

        <div class="contenedorSubido">
            <?php
            if ($subir->upload()) {
                echo 'Archivo subido con éxito<br/>'
                . 'En 5 segundos volverá a la página inicial<br/>'
                        . '<a href="index.php">Pincha para volver</a>';
            } else {
                echo 'Archivo no subido<br/>'
                . 'En 5 segundos volverá a la página inicial<br/>'
                        . '<a href="index.php">Pincha para volver</a>';
            }
                 header( "refresh:5; url=index.php" );
            ?>
        </div>
    </body>
</html>


