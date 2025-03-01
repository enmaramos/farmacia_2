$(document).ready(function() {
    $(document).on('click', '.reactivarUsuarioBtn', function() {
        var userId = $(this).data('id'); // Obtener ID del usuario
        
        if (!userId) {
            alert("Error: ID de usuario no válido.");
            return;
        }

        if (confirm('¿Estás seguro de que deseas reactivar a este usuario?')) {
            var $btn = $(this); // Guardar referencia al botón
            $btn.prop('disabled', true); // Deshabilitar el botón para evitar múltiples clics

            $.ajax({
                type: 'POST',
                url: '../pages/Ctrl/reactivar_usuario.php', // Ruta del archivo PHP
                data: { id_usuario: userId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        setTimeout(function() { // Esperar un poco antes de recargar
                            alert(response.message);
                            location.reload(); // Recargar la página después de cerrar el alert
                        }, 300);
                    } else {
                        alert("Error: " + response.message);
                        $btn.prop('disabled', false); // Habilitar el botón en caso de error
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en AJAX: ", status, error);
                    alert("Hubo un error al intentar reactivar al usuario.");
                    $btn.prop('disabled', false); // Habilitar el botón en caso de error
                }
            });
        }
    });
});
