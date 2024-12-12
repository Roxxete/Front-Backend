<?php
// Archivo: get_map_data.php
header('Content-Type: application/json');
require_once('database.php'); // Incluye la conexión a la base de datos

// Validar que se envíe el parámetro idcontaminante
if (!isset($_GET['idcontaminante'])) {
    echo json_encode(["error" => "No se proporcionó el id del contaminante"]);
    exit;
}

$idcontaminante = intval($_GET['idcontaminante']);

try {
    // Consulta para obtener los datos de la tabla medicion
    $query = "SELECT latitud, longitud, valor FROM medicion WHERE idcontaminante = :idcontaminante";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':idcontaminante', $idcontaminante, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener los resultados como un array asociativo
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Enviar los datos como respuesta JSON
    echo json_encode($data);
} catch (Exception $e) {
    // Enviar un error si algo falla
    echo json_encode(["error" => $e->getMessage()]);
}
?>