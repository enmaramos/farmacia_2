<?php
include('../pages/Cnx/conexion.php');

// Configurar la cabecera para devolver el resultado en formato JSON
header('Content-Type: application/json');  

// Obtener el estado seleccionado desde el filtro
$estadoFiltro = isset($_POST['estado']) ? $_POST['estado'] : 'todos';  // Valor por defecto es 'todos'

if ($estadoFiltro == 'activos') {
    // Obtener solo los vendedores activos
    $query = "SELECT * FROM vendedor WHERE Estado = 1";
    $result = $conn->query($query);
} elseif ($estadoFiltro == 'inactivos') {
    // Obtener solo los vendedores inactivos
    $queryInactivos = "SELECT * FROM vendedor WHERE Estado = 0";
    $result = $conn->query($queryInactivos);
} else {
    // Obtener todos los vendedores (activos e inactivos)
    $query = "SELECT * FROM vendedor";
    $result = $conn->query($query);
}

// Preparar los datos de los vendedores para la respuesta en formato JSON
$vendedores = [];
while ($row = $result->fetch_assoc()) {
    $vendedores[] = $row;
}

// Devolver los datos de los vendedores en formato JSON
echo json_encode($vendedores);

$conn->close();
?>
