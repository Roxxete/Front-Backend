<?php
     if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require_once("db.php");

        $email = $_POST['email'];
        $emailantiguo = $_POST['emailantiguo'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $usuario = $_POST['usuario'];

        $query = "UPDATE usuarios SET nombre= '$nombre', apellidos = '$apellidos', usuario = '$usuario', email = '$email' WHERE email = '$emailantiguo'";

        $result = $mysql->query($query);

        if($result == true)
        {
            echo json_encode("El usuario se actualizo correctamente");
        }else
        {
            echo "Fallo";
        }


        $mysql -> close();
    }