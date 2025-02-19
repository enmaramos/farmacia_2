<?php
include '../Cnx/conexion.php';

// Obtener el ID del usuario
$userId = $_POST['userId'];

// Consultar los datos del usuario
$sql = "SELECT * FROM usuarios WHERE ID_Usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response = array(
        'ID_Usuario' => $row['ID_Usuario'],
        'Nombre_Usuario' => $row['Nombre_Usuario'],
        'Imagen' => $row['Imagen'],
        'Contraseña' => $row['Contraseña'],
        'Email' => $row['Email'],
        'Telefono' => $row['Telefono'],
        'ID_Vendedor' => $row['ID_Vendedor'],
        'IdRol' => $row['IdRol']
    );
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'Usuario no encontrado'));
}

$stmt->close();
$conn->close();
?>
