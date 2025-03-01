<?php
include '../Cnx/conexion.php';

// Obtener los datos del formulario
$idProveedor = $_POST['idProveedor'];
$nombreProveedor = $_POST['nombre_Proveedor'];
$apellidoProveedor = $_POST['apellido_Proveedor'];
$empresaLaboratorio = $_POST['empresa_Laboratorio'];
$direccionProveedor = $_POST['direccion_Proveedor'];
$ciudadProveedor = $_POST['ciudad_Proveedor'];
$departamentoProveedor = $_POST['departamento_Proveedor'];
$telefonoProveedor = $_POST['telefono_Proveedor'];
$emailProveedor = $_POST['email_Proveedor'];
$rucProveedor = $_POST['ruc_Proveedor'];

// Consulta para actualizar el proveedor
$sql = "UPDATE proveedor SET 
            Nombre = ?, 
            Apellido = ?, 
            Empresa_Laboratorio = ?, 
            Direccion = ?, 
            Ciudad = ?, 
            Departamento = ?, 
            Telefono = ?, 
            Email = ?, 
            RUC = ? 
        WHERE ID_Proveedor = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssssi", 
    $nombreProveedor, 
    $apellidoProveedor, 
    $empresaLaboratorio, 
    $direccionProveedor, 
    $ciudadProveedor, 
    $departamentoProveedor, 
    $telefonoProveedor, 
    $emailProveedor, 
    $rucProveedor, 
    $idProveedor
);

if ($stmt->execute()) {
    echo json_encode(array('success' => 'Proveedor actualizado correctamente'));
} else {
    echo json_encode(array('error' => 'Error al actualizar el proveedor'));
}

$stmt->close();
$conn->close();
?>
