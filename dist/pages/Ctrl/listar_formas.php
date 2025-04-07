<?php
include('../pages/Cnx/conexion.php');

$sql = "SELECT ID_Forma_Farmaceutica, Forma_Farmaceutica FROM medicamento_forma_farmaceutica ORDER BY Forma_Farmaceutica ASC";
$result = $conn->query($sql);

$formas = [];
while ($row = $result->fetch_assoc()) {
    $formas[] = $row;
}

echo json_encode($formas);
?>
