<?php
    /**
     * @file guardarcontaminante.php
     * @brief Guarda una medición de contaminante en la base de datos.
     *
     * Este script maneja solicitudes POST para registrar una nueva medición 
     * en la tabla `medicion`. Los datos de entrada incluyen valores para ozono 
     * y temperatura.
     *
     * @details
     * - Los datos son enviados mediante una solicitud HTTP POST.
     * - La información se inserta en la tabla `medicion` utilizando una consulta SQL.
     * - Devuelve un mensaje JSON indicando el éxito o fallo de la operación.
     */

    // Verifica si el método de solicitud es POST.
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // Incluye el archivo de conexión a la base de datos.
        require_once("db.php");

        // Obtiene los valores enviados a través del método POST.
        $ozono = $_POST['ozono']; // Nivel de ozono enviado por el cliente.
        $temperatura = $_POST['temperatura']; // Temperatura enviada por el cliente.

        // Prepara la consulta SQL para insertar los datos en la tabla `medicion`.
        $query = "INSERT INTO medicion (ozono,temperatura) VALUES ('$ozono','$temperatura')";

        // Ejecuta la consulta y almacena el resultado.
        $result = $mysql->query($query);

        // Verifica si la inserción fue exitosa.
        if($result == true)
        {
            // Devuelve un mensaje JSON indicando éxito.
            echo json_encode("El contaminante se creó correctamente");
        }
        else
        {
            // Devuelve un mensaje JSON indicando error.
            echo json_encode("Error");
        }

        // Cierra la conexión a la base de datos.
        $mysql->close();
    }
?>
