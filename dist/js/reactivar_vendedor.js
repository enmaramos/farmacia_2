// Activar vendedor (cambiar estado a 1)
$(document).on('click', '.activarVendedorBtn', function() {
    var vendedorId = $(this).data('id'); // Obtener el ID del vendedor

    // Mostrar un mensaje de confirmación antes de activar
    var confirmacion = confirm("¿Estás seguro de que deseas reactivar a este vendedor?");
    
    if (confirmacion) {
        // Realizar la petición AJAX para activar el vendedor
        $.ajax({
            url: '../pages/Ctrl/reactivar_vendedor.php', 
            method: 'POST', 
            data: { vendedorId: vendedorId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.success); // Mostrar mensaje de éxito
                    location.reload(); // Recargar la página para ver el cambio
                } else {
                    alert(response.error); // Mostrar mensaje de error
                }
            },
            error: function() {
                alert("Error en la solicitud. Inténtelo nuevamente.");
            }
        });
    } else {
        // Si el usuario cancela, no hacer nada
        alert("La reactivación fue cancelada.");
    }
});
