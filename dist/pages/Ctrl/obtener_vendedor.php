<?php
include '../Cnx/conexion.php';

header("Content-Type: application/json");

if (!isset($_POST['vendedorId']) || empty($_POST['vendedorId'])) {
    echo json_encode(['error' => 'ID de vendedor no proporcionado']);
    exit;
}

$vendedorId = $_POST['vendedorId'];

// Debug: Mostrar el ID recibido
error_log("ID de vendedor recibido: " . $vendedorId);

$sql = "SELECT ID_Vendedor, Nombre, Apellido, N_Cedula, Telefono, Email, Direccion, Sexo, Estado, ID_Rol FROM vendedor WHERE ID_Vendedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vendedorId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    
    // Debug: Verificar si Apellido y Email existen en los datos recuperados
    error_log("Datos obtenidos: " . json_encode($data));
    
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Vendedor no encontrado']);
}

$stmt->close();
$conn->close();
?>
