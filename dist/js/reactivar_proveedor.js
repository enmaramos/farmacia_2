$(document).on('click', '.reactivarProveedorBtn', function() {
    var idProveedor = $(this).data('id'); // Obtener el ID del proveedor desde el botón

    // Realizar la solicitud AJAX
    $.ajax({
        url: '../pages/Ctrl/reactivar_proveedor.php', // Ruta al archivo PHP de reactivación
        method: 'POST',
        data: { idProveedor: idProveedor }, // Enviar el ID del proveedor
        success: function(response) {
            if (response.includes('Proveedor reactivado correctamente')) {
                alert('Proveedor reactivado correctamente');
                location.reload(""); // Recargar la página para mostrar la tabla actualizada
            } else {
                alert(response); // Mostrar mensaje de error si hay uno
            }
        },
        error: function() {
            alert("Hubo un error al realizar la solicitud.");
        }
    });
});
