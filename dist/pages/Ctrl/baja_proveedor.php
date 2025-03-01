<?php
include '../Cnx/conexion.php';  // Conexión a la base de datos

$proveedorId = $_POST['proveedorId'];  // Obtener el ID del proveedor a eliminar

// Actualizar el estado del proveedor a eliminado (estado = 0)
$sql = "UPDATE proveedor SET estado = 0 WHERE ID_Proveedor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $proveedorId);

if ($stmt->execute()) {
    echo json_encode(array('success' => 'Proveedor eliminado correctamente.'));
} else {
    echo json_encode(array('error' => 'Hubo un error al eliminar al proveedor.'));
}

$stmt->close();
$conn->close();
?>
