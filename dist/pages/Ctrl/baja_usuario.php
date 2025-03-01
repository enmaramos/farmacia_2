<?php
include '../Cnx/conexion.php'; // Asegúrate de que este archivo contiene la conexión correcta

header('Content-Type: application/json'); // Establecer el encabezado de respuesta JSON

$response = array(); // Crear un array para la respuesta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id_usuario'])) {
        $response['success'] = false;
        $response['message'] = "No se recibió el ID del usuario.";
        echo json_encode($response);
        exit;
    }

    $id_usuario = intval($_POST['id_usuario']); // Convertir a entero para mayor seguridad

    if ($id_usuario > 0) {
        $sql = "UPDATE usuarios SET estado_usuario = 0 WHERE ID_Usuario = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $response['success'] = false;
            $response['message'] = "Error en la preparación de la consulta: " . $conn->error;
        } else {
            $stmt->bind_param("i", $id_usuario);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = "Usuario dado de baja correctamente.";
            } else {
                $response['success'] = false;
                $response['message'] = "Error al ejecutar la consulta: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        $response['success'] = false;
        $response['message'] = "ID de usuario no válido.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Método de solicitud no válido.";
}

$conn->close();
echo json_encode($response); // Devolver respuesta JSON
?>
