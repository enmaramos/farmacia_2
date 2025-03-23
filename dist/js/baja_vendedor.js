$(document).ready(function() {
    $(document).on('click', '.bajaVendedorBtn', function() {
        var vendedorId = $(this).data('id'); // Obtener ID del vendedor

        if (confirm('¿Estás seguro de que deseas dar de baja a este vendedor?')) {
            $.ajax({
                type: 'POST',
                url: '../pages/Ctrl/baja_vendedor.php', // Ruta del archivo PHP
                data: { id_vendedor: vendedorId }, // Asegúrate de usar 'id_vendedor' aquí
                dataType: 'json',
                success: function(response) {
                    console.log(response); // Verifica la respuesta en la consola
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Recargar la página para reflejar el cambio
                    } else {
                        alert("Error: " + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en AJAX: ", status, error);
                    alert("Hubo un error al intentar dar de baja al vendedor.");
                }
            });
        }
    });
});
