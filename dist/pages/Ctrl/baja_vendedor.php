<?php
include '../Cnx/conexion.php'; // Incluir la conexión a la base de datos

header('Content-Type: application/json'); // Establecer el encabezado de respuesta JSON

$response = array(); // Crear un array para la respuesta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id_vendedor'])) {
        $response['success'] = false;
        $response['message'] = "No se recibió el ID del vendedor.";
        echo json_encode($response);
        exit;
    }

    $id_vendedor = intval($_POST['id_vendedor']); // Convertir a entero

    if ($id_vendedor > 0) {
        $sql = "UPDATE vendedores SET Estado = 0 WHERE ID_Vendedor = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $response['success'] = false;
            $response['message'] = "Error en la preparación de la consulta: " . $conn->error;
        } else {
            $stmt->bind_param("i", $id_vendedor);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Vendedor dado de baja correctamente.";
            } else {
                $response['success'] = false;
                $response['message'] = "Error al ejecutar la consulta: " . $stmt->error; // Más detalle del error
            }

            $stmt->close();
        }
    } else {
        $response['success'] = false;
        $response['message'] = "ID de vendedor no válido.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Método de solicitud no válido.";
}

$conn->close();
echo json_encode($response); // Devolver respuesta JSON
?>

