<?php
// Incluir la conexión a la base de datos
include('../Cnx/conexion.php');

// Verificar si se enviaron los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombreProveedor'];
    $apellido = $_POST['apellidoProveedor'];
    $empresaLaboratorio = $_POST['empresaLaboratorioProveedor'];
    $direccion = $_POST['direccionProveedor'];
    $ciudad = $_POST['ciudadProveedor'];
    $departamento = $_POST['departamentoProveedor'];
    $telefono = $_POST['telefonoProveedor'];
    $email = $_POST['emailProveedor'];
    $ruc = $_POST['rucProveedor'];

    // Insertar en la base de datos
    $sql = "INSERT INTO proveedor (Nombre, Apellido, Empresa_Laboratorio, Direccion, Ciudad, Departamento, Telefono, Email, RUC)
            VALUES ('$nombre', '$apellido', '$empresaLaboratorio', '$direccion', '$ciudad', '$departamento', '$telefono', '$email', '$ruc')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Proveedor agregado correctamente');
                window.location.href = '../proveedores.php';
              </script>";
    } else {
        echo "Error al guardar proveedor: " . $conn->error;
    }
}

$conn->close();
?>
