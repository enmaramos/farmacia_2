$(document).ready(function() {
    // Función para buscar clientes cuando se escribe en el campo de búsqueda
    $('#buscarCliente').on('input', function() {
        var termino = $(this).val(); // Obtener el valor del campo de búsqueda
        
        if (termino.length >= 2) { // Comienza a buscar si hay al menos 2 caracteres
            $.ajax({
                url: '../pages/Ctrl/buscar_clientes.php', // El archivo PHP que consulta la base de datos
                type: 'GET',
                data: {termino: termino}, // Pasar el término de búsqueda
                success: function(data) {
                    var clientes = JSON.parse(data); // Convertir la respuesta JSON en un array de objetos
                    var listaResultados = $('#resultadosBusqueda');
                    listaResultados.empty(); // Limpiar los resultados previos

                    if (clientes.length > 0) {
                        // Recorrer todos los clientes y agregarlos a la lista
                        clientes.forEach(function(cliente) {
                            listaResultados.append(
                                '<a href="#" class="list-group-item list-group-item-action" data-id="'+ cliente.ID_Cliente +'" data-nombre="'+ cliente.Nombre +'" data-cedula="'+ cliente.Cedula +'" data-apellido="'+ cliente.Apellido +'">' +
                                cliente.Nombre + ' ' + cliente.Apellido + ' (' + cliente.Cedula + ')' +
                                '</a>'
                            );
                        });

                        // Mostrar la lista de resultados
                        listaResultados.show();
                    } else {
                        listaResultados.hide(); // Si no hay resultados, ocultar la lista
                    }
                }
            });
        } else {
            $('#resultadosBusqueda').hide(); // Ocultar la lista de resultados si no hay búsqueda
        }
    });

    // Función para seleccionar un cliente de la lista de resultados
    $(document).on('click', '#resultadosBusqueda a', function(e) {
        e.preventDefault();

        var idCliente = $(this).data('id');
        var nombre = $(this).data('nombre');
        var apellido = $(this).data('apellido');
        var cedula = $(this).data('cedula');

        // Rellenar los campos con los datos del cliente seleccionado
        $('#nombreCliente').val(nombre + ' ' + apellido);
        $('#cedulaCliente').val(cedula);

        // Ocultar los resultados de búsqueda
        $('#resultadosBusqueda').hide();
    });
});
