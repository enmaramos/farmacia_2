$(document).ready(function() {
    var isRequestInProgress = false; // Flag para evitar múltiples solicitudes

    $(document).on('click', '.reactivarUsuarioBtn', function() {
        if (isRequestInProgress) return; // Evitar múltiples clics

        var userId = $(this).data('id'); // Obtener ID del usuario

        if (confirm('¿Estás seguro de que deseas reactivar a este usuario?')) {
            var $btn = $(this); // Referencia al botón para prevenir múltiples clics
            isRequestInProgress = true; // Establecer el flag como verdadero

            // Deshabilitar el botón para evitar clics repetidos
            $btn.prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: '../pages/Ctrl/reactivar_usuario.php', // Ruta del archivo PHP
                data: { id_usuario: userId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message); // Mostrar mensaje de éxito
                        location.reload(); // Recargar la página
                    } else {
                        alert("Error: " + response.message); // Mostrar mensaje de error
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en AJAX: ", status, error);
                    alert("Hubo un error al intentar reactivar al usuario.");
                },
                complete: function() {
                    $btn.prop('disabled', false); // Habilitar el botón nuevamente
                    isRequestInProgress = false; // Restaurar el flag para permitir futuras solicitudes
                }
            });
        }
    });
});
