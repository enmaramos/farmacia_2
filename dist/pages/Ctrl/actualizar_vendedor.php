<?php
include '../Cnx/conexion.php';

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar si se recibieron todos los datos necesarios
    $requiredFields = ['idVendedor', 'editarNombreVendedor', 'editarCedulaVendedor', 'editarTelefonoVendedor', 'editarDireccionVendedor', 'editarSexoVendedor', 'editarCorreoVendedor'];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo json_encode(["error" => "Faltan datos obligatorios"]);
            exit;
        }
    }

    // Obtener datos del formulario
    $idVendedor = $_POST['idVendedor'];
    $nombre = $_POST['editarNombreVendedor'];
    $cedula = $_POST['editarCedulaVendedor'];
    $telefono = $_POST['editarTelefonoVendedor'];
    $direccion = $_POST['editarDireccionVendedor'];
    $sexo = $_POST['editarSexoVendedor'];
    $email = $_POST['editarCorreoVendedor'];

    // Actualizar el vendedor
    $sql = "UPDATE vendedor SET Nombre = ?, N_Cedula = ?, Telefono = ?, Direccion = ?, Sexo = ?, Correo = ? WHERE ID_Vendedor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre, $cedula, $telefono, $direccion, $sexo, $email, $idVendedor);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Vendedor actualizado correctamente"]);
    } else {
        echo json_encode(["error" => "Error al actualizar el vendedor"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Método no permitido"]);
}
?>
