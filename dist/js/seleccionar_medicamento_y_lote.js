$(document).ready(function () {
    // Cuando se hace clic en el botón "Seleccionar"
    $('#tablaProducto tbody').on('click', '.seleccionarProducto', function () {
        let idMedicamento = $(this).data('id');

        $.ajax({
            url: '../pages/Ctrl/obtener_medicamento_y_lote.php', // Llamada a PHP para obtener los detalles del medicamento y lote
            type: 'GET',
            data: { id: idMedicamento },
            dataType: 'json',
            success: function (data) {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                // Rellenamos los campos del formulario con los datos recibidos
                $('#nombreProducto').val(data.Nombre_Medicamento);  // Nombre del medicamento
                $('#laboratorio').val(data.LAB_o_MARCA);            // Marca o laboratorio
                $('#imagenProducto').attr('src', '../../dist/assets/img/' + data.Imagen);  // Imagen del producto
                $('#descripcion').val(data.Descripcion_Medicamento); // Descripción

                // Mostrar los datos de la tabla Lote
                $('#descripcionLote').val(data.Descripcion_Lote);    // Descripción del Lote
                $('#cantidadLote').val(data.Cantidad_Lote);           // Cantidad del Lote
                $('#fechaFabricacion').val(data.Fecha_Fabricacion);  // Fecha de Fabricación
                $('#fechaCaducidad').val(data.Fecha_Caducidad_Lote); // Fecha de Caducidad
                $('#fechaRecibido').val(data.Fecha_Recibido);       // Fecha de Recibido
                $('#precioUnidad').val(data.Precio_Unidad);          // Precio por Unidad
                $('#precioTotalLote').val(data.Precio_Total_Lote);   // Precio Total del Lote
                $('#stockMin').val(data.Stock_Min);                  // Stock Mínimo
                $('#stockMax').val(data.Stock_Max);                  // Stock Máximo

                // Si tienes más campos de lote, los puedes agregar aquí siguiendo la misma estructura

                // Cerrar el modal después de seleccionar el producto
                $('#modalBusquedaProducto').modal('hide');
            },
            error: function (xhr, status, error) {
                console.log("Error en la solicitud AJAX:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
                alert('Error al obtener los detalles del medicamento.');
            }
        });
    });
});
