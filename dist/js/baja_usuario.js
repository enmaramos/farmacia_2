$(document).ready(function() {
    $(document).on('click', '.bajaUsuarioBtn', function() {
        var userId = $(this).data('id'); // Obtener ID del usuario

        if (confirm('¿Estás seguro de que deseas dar de baja a este usuario?')) {
            $.ajax({
                type: 'POST',
                url: '../pages/Ctrl/baja_usuario.php', // Ruta del archivo PHP
                data: { id_usuario: userId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Recargar la página
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en AJAX: ", status, error);
                    alert("Hubo un error al intentar dar de baja al usuario.");
                }
            });
        }
    });
});
