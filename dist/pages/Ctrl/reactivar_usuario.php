<?php
include '../Cnx/conexion.php'; // Asegúrate de que este archivo contiene la conexión correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id_usuario'])) {
        echo json_encode(["success" => false, "message" => "No se recibió el ID del usuario."]);
        exit;
    }

    $id_usuario = intval($_POST['id_usuario']); // Convertir a entero para mayor seguridad

    if ($id_usuario > 0) {
        $sql = "UPDATE usuarios SET estado_usuario = 1 WHERE ID_Usuario = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            echo json_encode(["success" => false, "message" => "Error en la preparación de la consulta: " . $conn->error]);
            exit;
        }

        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Usuario reactivado correctamente."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al ejecutar la consulta: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "ID de usuario no válido."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método de solicitud no válido."]);
}

$conn->close();
