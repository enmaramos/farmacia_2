<?php
include '../Cnx/conexion.php';  // Asegúrate de que esta conexión sea la correcta

// Verifica si se ha enviado el ID del usuario
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];

    // Consulta para obtener los datos del usuario por su ID
    $sql = "SELECT * FROM usuarios WHERE ID_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Si el usuario existe, devolvemos los datos
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = array(
            'ID_Usuario' => $row['ID_Usuario'],
            'Nombre_Usuario' => $row['Nombre_Usuario'],
            'Imagen' => $row['Imagen'],
            'Password' => $row['Password'], // Agregado porque se usa en el modal
            'ID_Vendedor' => $row['ID_Vendedor'],
            'estado_usuario' => $row['estado_usuario'],
            'Fecha_Creacion' => $row['Fecha_Creacion'],
            'Ultimo_Acceso' => $row['Ultimo_Acceso']
        );
        echo json_encode($response);  // Devuelve los datos en formato JSON
    } else {
        echo json_encode(array('error' => 'Usuario no encontrado'));  // Si no se encuentra, devuelve un error
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(array('error' => 'No se recibió el userId.'));
}
?>
