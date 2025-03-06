<?php
include '../config/conexion.php';

if (isset($_POST['vendedorId'])) {
    $vendedorId = $_POST['vendedorId'];
    
    $query = "SELECT * FROM vendedor WHERE ID_Vendedor = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $vendedorId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $vendedor = $result->fetch_assoc();
        echo json_encode($vendedor);
    } else {
        echo json_encode(["error" => "No se encontró el vendedor."]);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "ID de vendedor no proporcionado."]);
}
