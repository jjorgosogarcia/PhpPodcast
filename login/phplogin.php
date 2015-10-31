<?php
require '../clases/AutoCarga.php';

 $users = array(
     "juan" => "abc",
     "pepe" => "ghi",
     "perico" => "123"
 );
 
 $user = Request::post("user");
 $password = Request::post("password");
 $sesion = new Session();

 if(isset($users[$user])&& $users[$user]==$password){
     $sesion->set("user", $user);
     header("Location:../subir/index.php");
          if(!FileUpload::user($user)){
            return mkdir("../subir/".$user);
        }
 }else{
     $sesion->destroy();
     header("Location:login.php");
 }
 
