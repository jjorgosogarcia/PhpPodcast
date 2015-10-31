<?php

class FileUpload {

    private $destino = "./", $nombre = "as", $tamaño = 1000000000000000, $parametro;
    private $error = false, $politica = self::RENOMBRAR; 
    private $privilegio=0;
    const CONSERVAR = 1, REEMPLAZAR = 2, RENOMBRAR = 3;

    private $arrayDeTipos = array(
        "mp3"=>1,
        "wav"=>1,
        "cda"=>1,
        "ogg"=>1
    );
    
    private $extension;
    
    function __construct($parametro) {
        //var_dump($_FILES[$parametro]);
        if (isset($_FILES[$parametro]) && $_FILES[$parametro]["name"] !== "") {
            $this->parametro = $parametro;
            $nombre = $_FILES[$this->parametro]["name"];
            $trozos = pathinfo($nombre); //array
            $extension = $trozos["extension"];
            $this->nombre = $trozos["filename"];
            $this->extension = $extension;
        } else {
            $this->error = true;
        }
    }

    public function getDestino() {
        return $this->destino;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTamaño() {
        return $this->tamaño;
    }

    public function getPolitica() {
        return $this->politica;
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setTamaño($tamaño) {
        $this->tamaño = $tamaño;
    }

    public function setPolitica($politica) {
        $this->politica = $politica;
    }

    public function upload() {
             $sesion = new Session();
             $user = $sesion->get("user");
             $directorio = $_POST['categorias'];
             
        if ($this->error) {
            return false;
        }
        if ($_FILES[$this->parametro]["error"] != UPLOAD_ERR_OK) {
            return false;
        }
        if ($_FILES[$this->parametro]["size"] > $this->tamaño) {
            return false;
        }

        if (!$this->isTipo($this->extension)) {
            return false;
        }

        if (!(is_dir($this->destino) && substr($this->destino, -1) === "/")) {
            return false;
        }

        if ($this->politica === self::CONSERVAR && file_exists($this->destino . $this->nombre . "." . $this->extension)) {
            return false;
        }
        $nombre = $this->nombre;
        if ($this->politica === self::RENOMBRAR && file_exists("../subir/".$user."/".$directorio ."/" . $this->nombre . "." . $this->extension)) {
            $nombre = $this->renombrar($nombre, $user, $directorio);
        }
        
        if(!self::directory($user, $directorio) ){
                return mkdir("../subir/".$user."/".$directorio) + move_uploaded_file($_FILES[$this->parametro]["tmp_name"],$user."./".$directorio ."/" . $nombre . "." . $this->extension);      
        }else{
                 return move_uploaded_file($_FILES[$this->parametro]["tmp_name"],$user."/".$directorio ."/". $nombre . "." . $this->extension);   
            }
        }

    private function renombrar($nombre, $user,$directorio) {
        $i = 1;
        while (file_exists("../subir/".$user."/".$directorio ."/". $nombre . "-" . $i . "." . $this->extension)) {
            $i++;
        }
        return $nombre . "-" . $i;
    }

    public function addTipo($tipo) {
        if (!$this->isTipo($tipo)) {
            $this->arrayDeTipos[$tipo] = 1;
            return true;
        }
        return false;
    }

    public function removeTipo($tipo) {
        if ($this->isTipo($tipo)) {
            unset($this->arrayDeTipos[$tipo]);
            return true;
        }
        return false;
    }

    public function isTipo($tipo) {
        return isset($this->arrayDeTipos[$tipo]);
    }
    
    private static function directory($user, $directorio){
        if(file_exists("../subir/".$user."/".$directorio)){
            return true;
        }else{
            return false;
        }
    }
    
     static function user($user){
        if(file_exists($user)){
            return true;
        }else{
            return false;
        }
    }
    
}
