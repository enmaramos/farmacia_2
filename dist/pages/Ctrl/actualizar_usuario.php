<?php
header('Content-Type: application/json'); // Aseguramos que la respuesta sea JSON

include '../Cnx/conexion.php';

// Verifica que los datos necesarios lleguen por POST
if (!isset($_POST['idUsuario'], $_POST['nombre_Usuario'], $_POST['email_Usuario'], $_POST['contraseña_Usuario'], $_POST['telefono_Usuario'], $_POST['rol_Usuario'])) {
    echo json_encode(['success' => false, 'error' => 'Faltan datos en el formulario.']);
    exit;
}

// Obtener los datos del formulario
$userId = $_POST['idUsuario'];
$nombreUsuario = $_POST['nombre_Usuario'];
$emailUsuario = $_POST['email_Usuario'];
$contraseñaUsuario = $_POST['contraseña_Usuario'];
$telefonoUsuario = $_POST['telefono_Usuario'];
$rolUsuario = $_POST['rol_Usuario'];

// Respuesta por defecto
$response = array();

// Actualizar solo la imagen del usuario si se ha subido una nueva
if (isset($_FILES['imagenUsuario']) && $_FILES['imagenUsuario']['error'] === UPLOAD_ERR_OK) {
    $imagenUsuario = basename($_FILES['imagenUsuario']['name']);
    $targetDir = "../uploads/";
    $targetFile = $targetDir . $imagenUsuario;

    if (move_uploaded_file($_FILES['imagenUsuario']['tmp_name'], $targetFile)) {
        $sql = "UPDATE usuarios SET Imagen = ? WHERE ID_Usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $imagenUsuario, $userId);
        if (!$stmt->execute()) {
            $response['success'] = false;
            $response['error'] = 'Error al actualizar la imagen: ' . $stmt->error;
            echo json_encode($response);
            exit;
        }
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['error'] = 'Error al subir la imagen.';
        echo json_encode($response);
        exit;
    }
}

// Ahora actualizamos los demás campos (si han cambiado)
$sql = "UPDATE usuarios SET Nombre_Usuario = ?, Email = ?, Contraseña = ?, Telefono = ?, IdRol = ? WHERE ID_Usuario = ?";
$stmt = $conn->prepare($sql);

// Verificar si la consulta fue preparada correctamente
if (!$stmt) {
    $response['success'] = false;
    $response['error'] = 'Error en la preparación de la consulta: ' . $conn->error;
    echo json_encode($response);
    exit;
}

$stmt->bind_param("ssssii", $nombreUsuario, $emailUsuario, $contraseñaUsuario, $telefonoUsuario, $rolUsuario, $userId);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Verificar si se afectaron filas
    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['message'] = 'Usuario actualizado correctamente.';
    } else {
        // Si no se afectaron filas, podemos enviar un mensaje de éxito aunque no haya cambios
        $response['success'] = true;
        $response['message'] = 'Usuario actualizado correctamente, pero no hubo cambios en los datos.';
    }
} else {
    $response['success'] = false;
    $response['error'] = 'Error al actualizar los datos del usuario: ' . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();

// Enviar la respuesta como JSON
echo json_encode($response);
?>
