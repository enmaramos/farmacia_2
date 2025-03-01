<?php
include '../Cnx/conexion.php';

// Obtener el ID del proveedor
$proveedorId = $_POST['proveedorId'];

// Consultar los datos del proveedor
$sql = "SELECT * FROM proveedor WHERE ID_Proveedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $proveedorId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response = array(
        'ID_Proveedor' => $row['ID_Proveedor'],
        'Nombre' => $row['Nombre'],
        'Apellido' => $row['Apellido'],
        'Empresa_Laboratorio' => $row['Empresa_Laboratorio'],
        'Direccion' => $row['Direccion'],
        'Ciudad' => $row['Ciudad'],
        'Departamento' => $row['Departamento'],
        'Telefono' => $row['Telefono'],
        'Email' => $row['Email'],
        'RUC' => $row['RUC']
    );
    echo json_encode($response);
} else {
    echo json_encode(array('error' => 'Proveedor no encontrado'));
}

$stmt->close();
$conn->close();
?>
