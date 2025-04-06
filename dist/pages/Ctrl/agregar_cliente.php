<?php
include('../Cnx/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombreCliente = $_POST['nombreCliente'];
    $apellidoCliente = $_POST['apellidoCliente'];
    $cedulaCliente = $_POST['cedulaCliente'];
    $generoCliente = $_POST['generoCliente'];
    $direccionCliente = $_POST['direccionCliente'];
    $telefonoCliente = str_replace("(+505) ", "", $_POST['telefonoCliente']);
    $emailCliente = $_POST['emailCliente'];
    $origen = $_POST['origen'];  // Obtener el origen del formulario

    // Verificar si la cédula ya existe
    $queryVerificarCedula = "SELECT ID_Cliente FROM clientes WHERE Cedula = ?";
    $stmtVerificarCedula = $conn->prepare($queryVerificarCedula);
    $stmtVerificarCedula->bind_param("s", $cedulaCliente);
    $stmtVerificarCedula->execute();
    $resultadoCedula = $stmtVerificarCedula->get_result();

    if ($resultadoCedula->num_rows > 0) {
        echo "<script>
                alert('La cédula ya está registrada.');
                window.history.back();
              </script>";
        $stmtVerificarCedula->close();
        $conn->close();
        exit();
    }
    $stmtVerificarCedula->close();

    // Verificar si el email ya existe
    $queryVerificarEmail = "SELECT ID_Cliente FROM clientes WHERE Email = ?";
    $stmtVerificarEmail = $conn->prepare($queryVerificarEmail);
    $stmtVerificarEmail->bind_param("s", $emailCliente);
    $stmtVerificarEmail->execute();
    $resultadoEmail = $stmtVerificarEmail->get_result();

    if ($resultadoEmail->num_rows > 0) {
        echo "<script>
                alert('El correo electrónico ya está registrado.');
                window.history.back();
              </script>";
        $stmtVerificarEmail->close();
        $conn->close();
        exit();
    }
    $stmtVerificarEmail->close();

    // Insertar nuevo cliente
    $queryCliente = "INSERT INTO clientes (Nombre, Apellido, Cedula, Genero, Direccion, Telefono, Email) 
                     VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtCliente = $conn->prepare($queryCliente);
    $stmtCliente->bind_param("sssssss", $nombreCliente, $apellidoCliente, $cedulaCliente, $generoCliente, $direccionCliente, $telefonoCliente, $emailCliente);

    if ($stmtCliente->execute()) {
        if ($origen == "facturacion.php") {
            echo "<script>
                    alert('Cliente agregado correctamente');
                    window.location.href = '../facturacion.php';  // Redirigir a caja.php
                  </script>";
        } else {
            echo "<script>
                    alert('Cliente agregado correctamente');
                    window.location.href = '../cliente.php';  // Redirigir a cliente.php
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error al agregar el cliente: " . $stmtCliente->error . "');
                window.history.back();
              </script>";
    }

    $stmtCliente->close();
}

$conn->close();
?>
