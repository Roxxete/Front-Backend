<?php	
    //-------------------------------------------------------------------------------------------------------
    //          nombre:text--> guardarcontaminante()
    //-------------------------------------------------------------------------------------------------------

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require_once("db.php");

        $ozono = $_POST['ozono'];
        $temperatura = $_POST['temperatura'];

        $query = "INSERT INTO medicion (ozono,temperatura) VALUES ('$ozono','$temperatura')";

        $result = $mysql->query($query);

        if($result == true)
        {
            echo json_encode("El contaminante se creo coreectamente");
        }else
        {
            echo json_encode("Error");
        }

        $mysql->close();
    }