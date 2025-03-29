<?php
include('../Cnx/conexion.php');

// Obtener el ID del producto
$idProducto = $_GET['idProducto'];

// Consulta SQL para obtener los detalles del producto
$query = "
SELECT 
    m.ID_Medicamento,
    m.Nombre_Medicamento,
    m.LAB_o_MARCA,
    m.Dosis,
    m.Precio_Con_Impuesto,
    m.Descripcion_Medicamento
FROM medicamento m
WHERE m.ID_Medicamento = $idProducto;
";

$result = $conn->query($query);

// Verifica si hubo un error con la consulta SQL
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

// Verifica si la consulta devuelve resultados
if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    echo json_encode($producto);
} else {
    echo json_encode([]);
}

$conn->close();
?>
