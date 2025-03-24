<?php
include '../Cnx/conexion.php';

// Verifica si se han recibido los datos del formulario
if (isset($_POST['userId'], $_POST['nombreUsuario'], $_POST['passwordUsuario'])) {
    $userId = $_POST['userId'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $passwordUsuario = $_POST['passwordUsuario'];

    // Escapar las cadenas para evitar SQL Injection
    $nombreUsuario = $conn->real_escape_string($nombreUsuario);
    $passwordUsuario = $conn->real_escape_string($passwordUsuario);

    // Preparar la consulta para actualizar los datos del usuario
    $sql = "UPDATE usuarios SET Nombre_Usuario = ?, Password = ? WHERE ID_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nombreUsuario, $passwordUsuario, $userId);

    if ($stmt->execute()) {
        echo json_encode(array('success' => 'Usuario actualizado correctamente.'));
    } else {
        echo json_encode(array('error' => 'Error al actualizar el usuario.'));
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array('error' => 'Faltan datos.'));
}


