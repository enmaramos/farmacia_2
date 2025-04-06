$(document).ready(function () {
    $('#clienteAleatorio').on('change', function () {
        if ($(this).is(':checked')) {
            // Se marcó el checkbox → buscar cliente aleatorio
            $.ajax({
                url: '../pages/Ctrl/clientes_chexbox.php',
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (!data.error) {
                        $('#nombreCliente').val(data.Nombre);
                        $('#cedulaCliente').val(data.Cedula);
                    } else {
                        alert(data.error);
                    }
                },
                error: function () {
                    alert('Error al obtener cliente aleatorio');
                }
            });
        } else {
            // Se desmarcó el checkbox → limpiar campos
            $('#nombreCliente').val('');
            $('#cedulaCliente').val('');
        }
    });
});