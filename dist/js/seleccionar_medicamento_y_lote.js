$(document).ready(function() {
    let dataTable = $('#tablaProducto').DataTable(); // Inicializa DataTable

    // Evento cuando se hace clic en el botón "Buscar Producto"
    $('#btnBuscarProducto').click(function() {
        $.ajax({
            url: '../pages/Ctrl/obtener_medicamento_y_lote.php', // Llamada para obtener los medicamentos
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Datos recibidos:", data);

                // Destruir la tabla antes de llenarla de nuevo
                dataTable.destroy();
                
                // Limpiar el tbody
                $('#tablaProducto tbody').empty();

                if (data.length === 0) {
                    alert('No se encontraron productos.');
                    return;
                }

                $.each(data, function(index, producto) {
                    // Ajustar la ruta de la imagen
                    var rutaImagen = '../../dist/assets/img/' + producto.Imagen;

                    var row = '<tr>' +
                        '<td><img src="' + rutaImagen + '" alt="' + producto.Nombre_Medicamento + '" class="img-fluid" style="width: 50px; height: auto;"></td>' +
                        '<td>' + producto.Nombre_Medicamento + '</td>' +
                        '<td>' + producto.LAB_o_MARCA + '</td>' +
                        '<td>' + producto.Descripcion_Medicamento + '</td>' +  // Descripción del medicamento
                        '<td><button class="btn btn-success seleccionarProducto" data-id="' + producto.ID_Medicamento + '">Seleccionar</button></td>' +
                        '</tr>';

                    // Agregar la fila a la tabla
                    $('#tablaProducto tbody').append(row);
                });

                // Volver a inicializar DataTable
                dataTable = $('#tablaProducto').DataTable();

                // Mostrar el modal de búsqueda de producto
                $('#modal_medicamento').modal('show'); // Ajuste a tu modal de búsqueda
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
                alert('Error al obtener los productos.');
            }
        });
    });

    // Cuando se hace clic en "Seleccionar" en la tabla de productos
    $('#tablaProducto tbody').on('click', '.seleccionarProducto', function () {
        let idMedicamento = $(this).data('id');

        $.ajax({
            url: '../pages/Ctrl/obtener_medicamento_y_lote.php', // Llamada para obtener detalles del medicamento y lote
            type: 'GET',
            data: { id: idMedicamento },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                // Rellenar los campos del formulario con los datos del medicamento
                $('#nombreMedicamento').val(data.Nombre_Medicamento);
                $('#marcaMedicamento').val(data.LAB_o_MARCA);
                $('#imagenMedicamento').attr('src', '../../dist/assets/img/' + data.Imagen);  // Imagen
                $('#descripcionMedicamento').val(data.Descripcion_Medicamento); // Descripción

                // Cerrar el modal de búsqueda
                $('#modal_medicamento').modal('hide');
                
                // Mostrar los datos del lote en los campos correspondientes
                $('#descripcionLote').val(data.Descripcion_Lote);
                $('#cantidadLote').val(data.Cantidad_Lote);
                $('#fechaFabricacion').val(data.Fecha_Fabricacion);
                $('#fechaCaducidad').val(data.Fecha_Caducidad_Lote);
                $('#fechaRecibido').val(data.Fecha_Recibido);
                $('#precioUnidad').val(data.Precio_Unidad);
                $('#precioTotalLote').val(data.Precio_Total_Lote);
                $('#stockMin').val(data.Stock_Min);
                $('#stockMax').val(data.Stock_Max);
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
                alert('Error al obtener los detalles del medicamento.');
            }
        });
    });
});
