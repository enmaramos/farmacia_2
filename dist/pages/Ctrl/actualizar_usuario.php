<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de tener el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del usuario desde la solicitud
    $id_usuario = $_POST['id_usuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $password_usuario = $_POST['password_usuario'];
    $vendedor_usuario = $_POST['vendedor_usuario'];
    $estado_usuario = $_POST['estado_usuario'];
    
    // Actualizar el usuario en la base de datos
    $sql = "UPDATE usuarios SET Nombre_Usuario=?, Password=?, ID_Vendedor=?, estado_usuario=? WHERE ID_Usuario=?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt->execute([$nombre_usuario, $password_usuario, $vendedor_usuario, $estado_usuario, $id_usuario])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Error al actualizar el usuario.']);
    }
    
    $stmt->close();
    $conn = null; // Cerrar la conexión
} else {
    echo json_encode(['error' => 'Método no permitido.']);
}
?>
