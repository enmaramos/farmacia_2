<?php
include('../Cnx/conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombreCliente = $_POST['nombreCliente'];
    $apellidoCliente = $_POST['apellidoCliente'];
    
    $generoCliente = $_POST['generoCliente'];
    $direccionCliente = $_POST['direccionCliente'];


    // Eliminar el prefijo (+505) del teléfono
    $telefonoCliente = str_replace("(+505) ", "", $_POST['telefonoCliente']);
    
    
    

    // Insertar en la tabla 'cliente'
    $queryCliente = "INSERT INTO clientes (Nombre, Apellido, Genero, Direccion, Telefono) 
                      VALUES (?, ?, ?, ?, ?)";
    $stmtCliente = $conn->prepare($queryCliente);
    $stmtCliente->bind_param("sssss", $nombreCliente, $apellidoCliente, $generoCliente, $direccionCliente, $telefonoCliente);

    if ($stmtCliente->execute()) {
        echo "<script>
                alert('Cliente agregado correctamente');
                window.location.href = '../cliente.php';
              </script>";
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
