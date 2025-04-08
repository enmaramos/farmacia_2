<?php
include('../pages/Cnx/conexion.php');

$data = json_decode(file_get_contents("php://input"), true);

$forma = trim($data['forma']);

if ($forma !== "") {
    $check = $conn->prepare("SELECT * FROM medicamento_forma_farmaceutica WHERE Forma_Farmaceutica = ?");
    $check->bind_param("s", $forma);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows === 0) {
        $insert = $conn->prepare("INSERT INTO medicamento_forma_farmaceutica (Forma_Farmaceutica) VALUES (?)");
        $insert->bind_param("s", $forma);
        $insert->execute();
        echo json_encode(["exito" => true]);
    } else {
        echo json_encode(["exito" => false, "mensaje" => "Ya existe"]);
    }
} else {
    echo json_encode(["exito" => false, "mensaje" => "Campo vacío"]);
}
?>
