<?php
include('../Cnx/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombreVendedor'];
    $cedula = $_POST['cedulaVendedor'];
    $telefono = $_POST['telefonoVendedor'];
    $direccion = $_POST['direccionVendedor'];
    $sexo = $_POST['sexoVendedor'];
    $correo = $_POST['emailVendedor']; // Correo es requerido en la tabla vendedor
    $contraseña = "123456"; // Contraseña predeterminada sin encriptar
    $idRol = 2; // Rol "Empleado"

    if (!empty($nombre) && !empty($cedula) && !empty($sexo) && !empty($correo)) {
        // Insertar el vendedor en la base de datos
        $query = "INSERT INTO vendedor (Nombre, N_Cedula, Telefono, Direccion, Sexo, Correo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssss", $nombre, $cedula, $telefono, $direccion, $sexo, $correo);

        if ($stmt->execute()) {
            $idVendedor = $stmt->insert_id; // Obtener el ID del vendedor insertado
            
            // Insertar usuario asociado al vendedor
            $queryUsuario = "INSERT INTO usuarios (Nombre_Usuario, Contraseña, Email, Telefono, ID_Vendedor, IdRol, estado_usuario) 
                             VALUES (?, ?, ?, ?, ?, ?, 1)";
            $stmtUsuario = $conn->prepare($queryUsuario);
            $stmtUsuario->bind_param("ssssii", $nombre, $contraseña, $correo, $telefono, $idVendedor, $idRol);

            if ($stmtUsuario->execute()) {
                echo "<script>alert('Vendedor y usuario creados correctamente'); window.location.href='../vendedor.php';</script>";
            } else {
                echo "<script>alert('Error al crear el usuario'); window.history.back();</script>";
            }

            $stmtUsuario->close();
        } else {
            echo "<script>alert('Error al agregar el vendedor'); window.history.back();</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Por favor, complete todos los campos obligatorios'); window.history.back();</script>";
    }
}

$conn->close();
?>
