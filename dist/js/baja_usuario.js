$(document).ready(function() {
    $(document).on('click', '.bajaUsuarioBtn', function() {
        var userId = $(this).data('id'); // Obtener ID del usuario

        if (confirm('¿Estás seguro de que deseas dar de baja a este usuario?')) {
            $.ajax({
                type: 'POST',
                url: '../pages/Ctrl/baja_usuario.php', // Archivo PHP que maneja la baja
                data: { id_usuario: userId },
                success: function(response) {
                    alert(response); // Mostrar mensaje de respuesta
                    location.reload(); // Recargar la página para actualizar la tabla
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX: ", status, error);
                    alert("Hubo un error al intentar dar de baja al usuario.");
                }
            });
        }
    });
});