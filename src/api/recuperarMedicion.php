<?php
/**
 * @file recuperarmedicion.php
 * @brief Recupera la última medición almacenada en la base de datos.
 *
 * Este script recibe solicitudes GET para obtener la última medición registrada
 * en la tabla `medicion` de la base de datos. La información recuperada incluye
 * el ID, instante, longitud, latitud y el identificador del contaminante.
 *
 * @details
 * - Se conecta a la base de datos definida en `db.php`.
 * - Recupera el registro más reciente de la tabla `medicion`.
 * - Devuelve los datos en formato JSON si se encuentra un registro.
 * - Responde con un mensaje de error si no hay registros disponibles.
 *
 * @author [Tu Nombre]
 * @date [Fecha de creación]
 * @version 1.0
 *
 * @note Este script debe ser ejecutado en un servidor con acceso a `db.php`.
 *
 * @par Uso:
 * Realizar una solicitud HTTP GET al script sin parámetros adicionales.
 *
 * @par Respuestas posibles:
 * - **JSON:** Contiene los datos de la última medición en caso de éxito.
 * - **Texto "Fallo":** Indica que no se encontraron registros.
 *
 * @see db.php
 *
 * @par Ejemplo de respuesta exitosa (JSON):
 * ```json
 * {
 *   "id_medicion": "123",
 *   "instante": "2024-11-29 12:34:56",
 *   "longitud": "-58.3816",
 *   "latitud": "-34.6037",
 *   "id_contaminante": "CO2"
 * }
 * ```
 *
 * @par Ejemplo de respuesta fallida:
 * ```
 * Fallo
 * ```
 */

    //-------------------------------------------------------------------------------------------------------
    //          id:R --> recuperarmedicion() --> [id, instante, longitud, latitud, idcontaminante]
    //-------------------------------------------------------------------------------------------------------
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        require_once("db.php");

        $query = "SELECT * FROM medicion ORDER BY id_medicion DESC LIMIT 1";

        $result = $mysql->query($query);
        
        if($mysql->affected_rows > 0)
        {                                                                                               
            while($row = $result->fetch_assoc()) 
            {
                $array = $row;
            }

            echo json_encode($array);
        }else
        {
            echo "Fallo";
        }

        $result -> close();
        $mysql -> close();
    }