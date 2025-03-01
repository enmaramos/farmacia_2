$(document).ready(function() {
    // Evento al hacer clic en el botón de baja (eliminar)
    $('.bajaProveedorBtn').click(function() {
        var proveedorId = $(this).data('id');  // Obtener el ID del proveedor

        // Confirmar si el usuario realmente desea eliminar al proveedor
        if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
            // Enviar la solicitud AJAX para marcar el proveedor como eliminado
            $.ajax({
                url: '../pages/Ctrl/baja_proveedor.php',  // El archivo PHP que maneja la eliminación
                method: 'POST',
                data: { proveedorId: proveedorId },
                success: function(response) {
                    // Manejo de la respuesta del servidor
                    var data = JSON.parse(response);
                    if (data.success) {
                        // Si la eliminación fue exitosa, actualizar la fila de la tabla
                        alert(data.success);
                        location.reload(); // Recargar la página para mostrar la tabla actualizada
                    } else {
                        alert('Hubo un error al eliminar el proveedor');
                    }
                },
                error: function() {
                    alert('Hubo un error al enviar la solicitud');
                }
            });
        }
    });
});
