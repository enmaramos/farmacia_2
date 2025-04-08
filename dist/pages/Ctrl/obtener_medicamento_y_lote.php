<?php
include('../Cnx/conexion.php');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'ID de medicamento no proporcionado']);
    exit;
}

$idMedicamento = intval($_GET['id']);

$query = "
SELECT 
    m.ID_Medicamento,
    m.Nombre_Medicamento,
    m.LAB_o_MARCA,
    m.Imagen,
    m.Descripcion_Medicamento,
    l.Descripcion_Lote,             -- Descripción del Lote
    l.Cantidad_Lote,               -- Cantidad del Lote
    l.Fecha_Fabricacion,           -- Fecha de Fabricación
    l.Fecha_Caducidad_Lote,        -- Fecha de Caducidad
    l.Fecha_Recibido,              -- Fecha de Recibido
    l.Precio_Unidad,               -- Precio por Unidad
    l.Precio_Total_Lote,           -- Precio Total del Lote
    l.Stock_Min,                   -- Stock Mínimo
    l.Stock_Max                    -- Stock Máximo

    FROM medicamento m
LEFT JOIN lote l ON m.ID_Medicamento = l.ID_Medicamento
WHERE m.ID_Medicamento = ?
LIMIT 1
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idMedicamento);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    echo json_encode($producto);  // Se devuelve el JSON con los datos de medicamento y lote
} else {
    echo json_encode(['error' => 'No se encontraron datos para este medicamento']);
}

$stmt->close();
$conn->close();
?>
