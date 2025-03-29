<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

include '../Cnx/conexion.php'; // Usamos tu conexión

error_reporting(E_ALL); // Muestra errores de PHP
ini_set('display_errors', 1); // Asegura que se impriman errores

if (isset($_GET['tipo'])) {
    $tipo = $_GET['tipo'];

    if ($tipo == "productos") {
        // Consulta para obtener los productos activos
        $sql = "SELECT ID_Medicamento, Nombre_Medicamento, LAB_o_MARCA, Dosis, Presentacion, Precio_Con_Impuesto, Requiere_Receta, Fecha_Vencimiento, Descripcion_Medicamento, Imagen FROM medicamento WHERE Estado = 1";
    } elseif ($tipo == "clientes") {
        // Consulta para obtener los clientes activos
        $sql = "SELECT ID_Cliente, CONCAT(Nombre, ' ', Apellido) AS Nombre_Completo, Telefono, Direccion FROM clientes WHERE Estado = 1";
    } else {
        // Si el parámetro tipo no es válido
        echo json_encode(["error" => "Tipo no válido"]);
        exit;
    }

    $resultado = $conn->query($sql);

    if (!$resultado) {
        // Si ocurre un error en la consulta
        echo json_encode(["error" => "Error en la consulta: " . mysqli_error($conn)]);
        exit;
    }

    if ($resultado->num_rows > 0) {
        // Si hay resultados, los convertimos a un array
        $datos = $resultado->fetch_all(MYSQLI_ASSOC);
        echo json_encode($datos);
    } else {
        // Si no hay resultados, retornamos un array vacío
        echo json_encode([]); 
    }
} else {
    // Si falta el parámetro 'tipo' en la URL
    echo json_encode(["error" => "Falta el parámetro 'tipo'"]);
}

$conn->close();
?>
