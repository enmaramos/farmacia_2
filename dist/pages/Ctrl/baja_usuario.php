
<?php
include '../Cnx/conexion.php'; // Asegúrate de que este archivo contiene la conexión correcta

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['id_usuario'])) {
        die("No se recibió el ID del usuario.");
    }

    $id_usuario = intval($_POST['id_usuario']); // Convertir a entero para mayor seguridad

    if ($id_usuario > 0) {
        $sql = "UPDATE usuarios SET estado_usuario = 0 WHERE ID_Usuario = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $id_usuario);

        if ($stmt->execute()) {
            echo "Usuario dado de baja correctamente.";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "ID de usuario no válido.";
    }
} else {
    echo "Método de solicitud no válido.";
}

$conn->close();
?>
