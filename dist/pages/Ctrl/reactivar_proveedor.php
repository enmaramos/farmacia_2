<?php
// Incluir el archivo de conexión
include('../Cnx/conexion.php');

// Verificar que se ha recibido el ID del proveedor
if (isset($_POST['idProveedor'])) {
    $idProveedor = intval($_POST['idProveedor']); // Obtener el ID del proveedor

    // Consulta SQL para reactivar el proveedor (poner el estado a 1)
    $sql = "UPDATE proveedor SET estado = 1 WHERE ID_Proveedor = $idProveedor";

    if ($conn->query($sql) === TRUE) {
        echo "Proveedor reactivado correctamente"; // Mensaje de éxito
    } else {
        echo "Hubo un error al reactivar al proveedor: " . $conn->error; // Mensaje de error
    }
} else {
    echo "ID de proveedor no recibido";
}

// Cerrar la conexión
$conn->close();
?>
