<?php
require '../clases/AutoCarga.php';
$sesion = new Session();
$user = $sesion->get("user");
$categoria = Request::get("categoria2");
$cancion = Request::get("cancion");
$privilegio = Request::get("privilegio");
$cancionBorrar = $privilegio. $user."_".$categoria."_".$cancion;

$util = new Utilidades();
$util->borrarCancion($user,$categoria,$cancionBorrar);

header('Location:buscador.php');