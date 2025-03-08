<?php
include('../Cnx/conexion.php');

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreVendedor = $_POST['nombreVendedor'];
    $apellidoVendedor = $_POST['apellidoVendedor'];
    $cedulaVendedor = $_POST['cedulaVendedor'];
    $telefonoVendedor = $_POST['telefonoVendedor'];
    $direccionVendedor = $_POST['direccionVendedor'];
    $sexoVendedor = $_POST['sexoVendedor'];
    $emailVendedor = $_POST['emailVendedor'];
    $rolVendedor = $_POST['rolVendedor'];

    // Contraseña predeterminada
    $contraseñaUsuario = "123456"; // Puedes cambiarla por cualquier valor que prefieras

    // Preparar la consulta para insertar los datos del vendedor
    $queryVendedor = "INSERT INTO vendedor (Nombre, Apellido, N_Cedula, Telefono, Direccion, Sexo, Email, ID_Rol) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Preparar la sentencia para insertar vendedor
    $stmtVendedor = $conn->prepare($queryVendedor);
    $stmtVendedor->bind_param("sssssssi", $nombreVendedor, $apellidoVendedor, $cedulaVendedor, $telefonoVendedor, $direccionVendedor, $sexoVendedor, $emailVendedor, $rolVendedor);

    // Ejecutar la sentencia
    if ($stmtVendedor->execute()) {
        $idVendedor = $stmtVendedor->insert_id; // Obtener el ID del vendedor recién insertado

        // Crear el nombre de usuario basado en el primer nombre y primer apellido
        $nombreUsuario = strtok($nombreVendedor, " ") . " " . strtok($apellidoVendedor, " ");

        // Preparar la consulta para insertar el usuario en la tabla `usuarios`
        $queryUsuario = "INSERT INTO usuarios (Nombre_Usuario, Password, ID_Vendedor, estado_usuario) 
                         VALUES (?, ?, ?, ?)";

        // Preparar la sentencia para insertar usuario
        $estado_usuario = 1; // Definir el estado del usuario
        $stmtUsuario = $conn->prepare($queryUsuario);
        $stmtUsuario->bind_param("ssii", $nombreUsuario, $contraseñaUsuario, $idVendedor, $estado_usuario);

        // Ejecutar la sentencia para crear el usuario
        if ($stmtUsuario->execute()) {
            // Mostrar mensaje de éxito con alerta y redirigir
            echo "<script>
                    alert('Vendedor y usuario creados correctamente');
                    window.location.href = '../vendedor.php'; // Redirigir correctamente
                  </script>";
        } else {
            echo "<script>
                    alert('Error al crear el usuario: " . $stmtUsuario->error . "');
                    window.history.back();
                  </script>";
        }

        $stmtUsuario->close(); // Cerrar la sentencia del usuario
    } else {
        echo "<script>
                alert('Error al agregar el vendedor: " . $stmtVendedor->error . "');
                window.history.back();
              </script>";
    }

    // Cerrar la sentencia del vendedor
    $stmtVendedor->close();
}

// Cerrar la conexión
$conn->close();
?>
