<?php
include('../pages/Cnx/conexion.php');

$query = "SELECT * FROM medicamento_forma_farmaceutica ORDER BY Forma_Farmaceutica ASC";
$res = $conn->query($query);

$formas = [];

while ($row = $res->fetch_assoc()) {
    $formas[] = $row;
}

echo json_encode($formas);
?>
