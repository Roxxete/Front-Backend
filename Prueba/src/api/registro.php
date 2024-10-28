<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        require_once('db.php');
        $email = $_POST['email'];
        $nombre= $_POST['nombre'];
        $apellidos= $_POST['apellidos'];
        $usuario= $_POST['usuario'];
        $contrasena= password_hash($_POST['contrasena'], PASSWORD_BCRYPT);

        $query="INSERT INTO usuarios (email, nombre, apellidos, usuario, contrasena) VALUES ('$email', '$nombre', '$apellidos', '$usuario', '$contrasena')";
        $result = $mysql -> query($query);
        if($result==true){
            echo json_encode("Usuario creado con exito");
        }
        else{
            echo json_encode("Error al crear el usuario");
        }
        $mysql->close();
    }