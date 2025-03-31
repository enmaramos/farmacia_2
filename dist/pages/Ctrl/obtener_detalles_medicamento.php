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
    DATE(m.Fecha_Vencimiento) AS Fecha_Vencimiento, -- Convertir a formato YYYY-MM-DD
    m.Requiere_Receta,
    GROUP_CONCAT(DISTINCT d.Dosis ORDER BY d.Dosis ASC SEPARATOR ', ') AS Dosis,
    GROUP_CONCAT(DISTINCT f.Forma_Farmaceutica ORDER BY f.Forma_Farmaceutica ASC SEPARATOR ', ') AS Forma_Farmaceutica,
    GROUP_CONCAT(DISTINCT CONCAT(p.Tipo_Presentacion, '|', p.Precio) ORDER BY p.Tipo_Presentacion ASC SEPARATOR ', ') AS Presentaciones
FROM medicamento m
LEFT JOIN medicamento_dosis d ON m.ID_Medicamento = d.ID_Medicamento
LEFT JOIN medicamento_forma_farmaceutica f ON m.ID_Medicamento = f.ID_Medicamento
LEFT JOIN medicamento_presentacion p ON m.ID_Medicamento = p.ID_Medicamento
WHERE m.ID_Medicamento = ?
GROUP BY m.ID_Medicamento
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $idMedicamento);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
    echo json_encode($producto);
} else {
    echo json_encode(['error' => 'No se encontraron datos para este medicamento']);
}

$stmt->close();
$conn->close();
?>
