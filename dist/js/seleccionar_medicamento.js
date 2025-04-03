$(document).ready(function() {
    $('#tablaProducto tbody').on('click', '.seleccionarProducto', function() {
        let idMedicamento = $(this).data('id');

        $.ajax({
            url: '../pages/Ctrl/obtener_detalles_medicamento.php',
            type: 'GET',
            data: { id: idMedicamento },
            dataType: 'json',
            success: function(data) {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                // Asignar valores a los campos del formulario
                $('#nombreProducto').val(data.Nombre_Medicamento); // Mostrar el nombre del producto
                $('#laboratorio').val(data.LAB_o_MARCA); // Laboratorio no editable
                $('#imagenProducto').attr('src', '../../dist/assets/img/' + data.Imagen); // Mostrar la imagen del producto
                $('#descripcion').val(data.Descripcion_Medicamento); // Descripción no editable
                $('#requiereReceta').val(data.Requiere_Receta ? 'Sí' : 'No'); // Requiere receta no editable

                // Verificar si requiere receta y aplicar estilo de advertencia
                if (data.Requiere_Receta) {
                    $('#requiereReceta').addClass('requiere-receta-advertencia');
                } else {
                    $('#requiereReceta').removeClass('requiere-receta-advertencia');
                }

                // Mostrar la fecha de vencimiento (tomando la primera fecha de caducidad)
                if (data.Fecha_Caducidad_Lote) {
                    let fechaVencimiento = data.Fecha_Caducidad_Lote.split(',')[0].trim(); // Tomar la primera fecha
                    $('#vencimiento').val(formatFecha(fechaVencimiento)); // Formatear y mostrar la fecha
                } else {
                    $('#vencimiento').val(''); // No mostrar fecha si no existe
                }

                // Llenar el select de Dosis
                llenarSelect('#dosis', data.Dosis);

                // Llenar el select de Forma Farmacéutica en "Unidad"
                llenarSelect('#unidad', data.Forma_Farmaceutica);

                // Llenar el select de Presentación con Tipo_Presentacion
                let presentaciones = data.Presentaciones.split(', ');
                let presentacionSelect = $('#presentacion');
                presentacionSelect.empty().append('<option selected>Seleccione Presentación</option>');

                presentaciones.forEach(function(presentacion) {
                    let partes = presentacion.split('|');
                    if (partes.length === 2) {
                        let tipo = partes[0].trim();
                        let precio = partes[1].trim();
                        presentacionSelect.append(`<option value="${tipo}" data-precio="${precio}">${tipo}</option>`);
                    }
                });

                // Evento para actualizar el precio según la presentación seleccionada
                $('#presentacion').off('change').on('change', function() {
                    let precioSeleccionado = $(this).find(':selected').data('precio');
                    $('#precio').val(precioSeleccionado || ''); // Precio no editable
                });

                // Cerrar el modal
                $('#modalBusquedaProducto').modal('hide');
            },
            error: function(xhr, status, error) {
                console.log("Error en la solicitud AJAX:", status, error);
                console.log("Respuesta del servidor:", xhr.responseText);
                alert('Error al obtener los detalles del medicamento.');
            }
        });
    });

    // Función para llenar un select con múltiples opciones separadas
    function llenarSelect(selectId, valores) {
        let select = $(selectId);
        select.empty().append('<option selected>Seleccione una opción</option>');

        if (valores) {
            valores.split(/[,\/]/).forEach(function(opcion) {
                select.append(`<option value="${opcion.trim()}">${opcion.trim()}</option>`);
            });
        }
    }

    // Función para formatear la fecha en formato DD/MM/YYYY
    function formatFecha(fecha) {
        let fechaObj = new Date(fecha);
        let dia = String(fechaObj.getDate()).padStart(2, '0');
        let mes = String(fechaObj.getMonth() + 1).padStart(2, '0');
        let año = fechaObj.getFullYear();
        return dia + '/' + mes + '/' + año;
    }
});
