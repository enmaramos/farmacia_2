<?php
// Incluir la conexión a la base de datos
include('../Cnx/conexion.php');

// Verificar si se enviaron los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombreUsuario']; // Corregido
    $email = $_POST['emailUsuario']; // Corregido
    $password = $_POST['contraseñaUsuario']; // Corregido
    $telefono = $_POST['telefonoUsuario']; // Se agregó el campo teléfono
    $rol = $_POST['rolUsuario']; // Corregido

    // Manejo de la imagen
    $imagen = "";
    if (!empty($_FILES["imagenUsuario"]["name"])) {
        $directorio = "../uploads/"; // Carpeta donde se guardarán las imágenes
        $imagen = basename($_FILES["imagenUsuario"]["name"]);
        $rutaFinal = $directorio . $imagen;

        // Mover la imagen a la carpeta destino
        if (move_uploaded_file($_FILES["imagenUsuario"]["tmp_name"], $rutaFinal)) {
            echo "Imagen subida con éxito.";
        } else {
            echo "Error al subir la imagen.";
        }
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO usuarios (Nombre_Usuario, Email, Contraseña, Telefono, IdRol, Imagen)
            VALUES ('$nombre', '$email', '$password', '$telefono', '$rol', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Usuario agregado correctamente');
                window.location.href = '../usuarios.php';
              </script>";
    } else {
        echo "Error al guardar usuario: " . $conn->error;
    }
}

$conn->close();
?>
