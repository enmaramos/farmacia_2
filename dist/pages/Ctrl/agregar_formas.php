<?php
include('../pages/Cnx/conexion.php');

if (isset($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);

    // Verificar si ya existe
    $stmt = $conn->prepare("SELECT * FROM medicamento_forma_farmaceutica WHERE Forma_Farmaceutica = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Ya existe esa forma."]);
    } else {
        $insert = $conn->prepare("INSERT INTO medicamento_forma_farmaceutica (Forma_Farmaceutica) VALUES (?)");
        $insert->bind_param("s", $nombre);
        if ($insert->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al guardar."]);
        }
    }
}
?>
