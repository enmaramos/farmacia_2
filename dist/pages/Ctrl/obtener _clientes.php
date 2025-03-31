<?php
// Incluir la conexión a la base de datos
include '../Cnx/conexion.php';

// Establecer que el contenido sea JSON
header('Content-Type: application/json');

// Verificar si la conexión es exitosa
if ($conn->connect_error) {
    echo json_encode(['error' => 'Conexión fallida: ' . $conn->connect_error]);
    exit;
}

// Obtener todos los clientes activos
$sql = "SELECT * FROM clientes WHERE Estado = 1";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result) {
    $clientes = [];

    // Obtener todos los clientes y agregarlos al array
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }

    // Devolver los resultados en formato JSON
    echo json_encode($clientes);
} else {
    // Si hay un error en la consulta
    echo json_encode(['error' => 'Error en la consulta: ' . $conn->error]);
}

// Cerrar la conexión
$conn->close();
?>
