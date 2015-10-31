<?php

class Utilidades {

    function __construct() {
        
    }

    function getDirectorio($dir) {
        $archivos = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($archivo = readdir($dh)) !== false) {
                    if (substr($archivo, 0, 2) == "1_" || substr($archivo, 0, 2) == "0_") {
                        $archivos[] = $archivo;
                    }
                }
                closedir($dh);
            }
        }
        return $archivos;
    }

    function getDirectorio2($dir) {
        $archivos = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($archivo = readdir($dh)) !== false) {
                    if (substr($archivo, 0, 2) == "0_") {
                        $archivos[] = $archivo;
                    }
                }
                closedir($dh);
            }
        }
        return $archivos;
    }

    function getNombre($cadena) {
        $pos = strrpos($cadena, "_");
        $cad = substr($cadena, $pos + 1, strlen($cadena) - 4);
        return $cad;
    }

    function getPrivilegio($cadena) {
        $pos = strrpos($cadena, "_");
        $cad = substr($cadena, 0, 2);
        return $cad;
    }

    function getCategoria($cadena) {
        $longitud = strlen($cadena);
        $pos1 = strpos($cadena, "_");
        $pos2 = strrpos($cadena, "_");
        $pos3 = $longitud - $pos2;
        $cad = substr($cadena, $pos1 + 1, -$pos3);
        return $cad;
    }

    function getCanciones($user, $categoria2, $directorio, $sem) {
        $canciones = new Utilidades();
        foreach ($directorio as $key => $value) {
            if ($value != "." && $value != "..") {
                echo "<tr><td>"
                . $canciones->getNombre($value) . "</td><td>"
                . $categoria2 . "</td><td>";
                if ($sem == true) {
                    echo "<audio src='" . $user . "/" . $categoria2 . "/" . $value . "' controls type='audio/mp3'></audio> <a href='phpdelete.php?usuario=" . $user . "&categoria2=" . $categoria2 . "&cancion=" . $canciones->getNombre($value) . "&privilegio=" . $canciones->getPrivilegio($value) . "'><img src='../imagenes/cancel.png'/></a></td></tr>";
                } else {
                    echo "<audio src='" . $user . "/" . $categoria2 . "/" . $value . "' controls type='audio/mp3'></audio></td></tr>";
                }
            }
        }
    }

    function borrarCancion($user, $categoria2, $cancion) {
        $canciones = new Utilidades();
        foreach ($canciones->getDirectorio($user . "/" . $categoria2) as $key => $value) {
            if ($value != "." && $value != ".." && $value == $cancion) {
                unlink($user . "/" . $categoria2 . "/" . $value);
            }
        }
    }

}
