<?php
include('../Cnx/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreVendedor = $_POST['nombreVendedor'];
    $apellidoVendedor = $_POST['apellidoVendedor'];
    $cedulaVendedor = $_POST['cedulaVendedor'];
    $telefonoVendedor = $_POST['telefonoVendedor'];
    $direccionVendedor = $_POST['direccionVendedor'];
    $sexoVendedor = $_POST['sexoVendedor'];
    $emailVendedor = $_POST['emailVendedor'];
    $rolVendedor = $_POST['rolVendedor'];

    $contraseñaUsuario = "123456"; // Contraseña por defecto

    // Verificar si el correo ya existe en la tabla 'vendedor'
    $queryVerificarCorreo = "SELECT COUNT(*) FROM vendedor WHERE Email = ?";
    $stmtVerificar = $conn->prepare($queryVerificarCorreo);
    $stmtVerificar->bind_param("s", $emailVendedor);
    $stmtVerificar->execute();
    $stmtVerificar->bind_result($existeCorreo);
    $stmtVerificar->fetch();
    $stmtVerificar->close();

    if ($existeCorreo > 0) {
        echo "<script>
                alert('Error: El correo ya está registrado. Por favor, ingrese un correo diferente.');
                window.history.back();
              </script>";
        exit();
    }

    // Insertar en la tabla 'vendedor'
    $queryVendedor = "INSERT INTO vendedor (Nombre, Apellido, N_Cedula, Telefono, Direccion, Sexo, Email, ID_Rol) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmtVendedor = $conn->prepare($queryVendedor);
    $stmtVendedor->bind_param("sssssssi", $nombreVendedor, $apellidoVendedor, $cedulaVendedor, $telefonoVendedor, $direccionVendedor, $sexoVendedor, $emailVendedor, $rolVendedor);

    if ($stmtVendedor->execute()) {
        $idVendedor = $stmtVendedor->insert_id;
        $nombreUsuario = strtok($nombreVendedor, " ") . " " . strtok($apellidoVendedor, " ");

        // Insertar en la tabla 'usuarios'
        $queryUsuario = "INSERT INTO usuarios (Nombre_Usuario, Password, ID_Vendedor, estado_usuario) 
                         VALUES (?, ?, ?, ?)";

        $estado_usuario = 1;
        $stmtUsuario = $conn->prepare($queryUsuario);
        $stmtUsuario->bind_param("ssii", $nombreUsuario, $contraseñaUsuario, $idVendedor, $estado_usuario);

        if ($stmtUsuario->execute()) {
            echo "<script>
                    alert('Vendedor y usuario creados correctamente');
                    window.location.href = '../vendedor.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al crear el usuario: " . $stmtUsuario->error . "');
                    window.history.back();
                  </script>";
        }

        $stmtUsuario->close();
    } else {
        echo "<script>
                alert('Error al agregar el vendedor: " . $stmtVendedor->error . "');
                window.history.back();
              </script>";
    }

    $stmtVendedor->close();
}

$conn->close();
?>
