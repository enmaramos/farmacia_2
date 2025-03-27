<?php
include('../Cnx/conexion.php');

// Verificar si se recibió el ID del vendedor
if (isset($_POST['vendedorId']) && !empty($_POST['vendedorId'])) {
    $vendedorId = intval($_POST['vendedorId']);

    // Consulta para actualizar el estado del vendedor a activo (1)
    $sql = "UPDATE vendedor SET Estado = 1 WHERE ID_Vendedor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $vendedorId);
    
    if ($stmt->execute()) {
        echo json_encode(["success" => "Vendedor activado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al activar el vendedor"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "ID de vendedor no proporcionado"]);
}

$conn->close();
?>
