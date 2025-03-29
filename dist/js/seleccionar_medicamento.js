$(document).ready(function() {
    $('#tablaProducto tbody').on('click', '.seleccionarProducto', function() {
        let fila = $(this).closest('tr');

        // Obtener los datos de la fila seleccionada
        let imagen = fila.find('td:eq(0) img').attr('src');
        let nombre = fila.find('td:eq(1)').text();
        let laboratorio = fila.find('td:eq(2)').text();
        let dosisTexto = fila.find('td:eq(3)').text();
        let presentacionTexto = fila.find('td:eq(4)').text();
        let unidadTexto = fila.find('td:eq(5)').text();

        // Obtener precios desde los atributos de la fila
        let precioUnidad = fila.data('precio-unidad'); 
        let precioSobre = fila.data('precio-sobre');
        let precioCaja = fila.data('precio-caja');

        let vencimiento = ''; // Si está disponible en la BD
        let descripcion = ''; // Si está disponible en la BD
        let receta = 'No'; // Ajustar si este dato está disponible en la BD

        // Asignar valores a los campos de texto
        $('#laboratorio').val(laboratorio);
        $('#imagenProducto').attr('src', imagen);
        $('#vencimiento').val(vencimiento);
        $('#descripcion').val(descripcion);
        $('#requiereReceta').val(receta);

        // Función para llenar un select con múltiples opciones separadas correctamente
        function llenarSelect(selectId, valores, esPrecio = false) {
            let select = $(selectId);
            select.empty().append('<option selected>Seleccione una opción</option>');

            if (valores) {
                let opciones = valores.split(/[,\/]/); // Separar valores por comas o barras si existen
                opciones.forEach(function(opcion) {
                    opcion = opcion.trim();

                    // Si es el select de presentación, agregamos precios en cada opción
                    if (esPrecio) {
                        if (opcion.includes("Caja")) {
                            select.append(`<option value="Caja" data-precio="${precioCaja}">Caja (C$ ${precioCaja})</option>`);
                        } else if (opcion.includes("Sobre")) {
                            select.append(`<option value="Sobre" data-precio="${precioSobre}">Sobre (C$ ${precioSobre})</option>`);
                        } else if (opcion.includes("Unidad")) {
                            select.append(`<option value="Unidad" data-precio="${precioUnidad}">Unidad (C$ ${precioUnidad})</option>`);
                        }
                    } else {
                        select.append(`<option value="${opcion}">${opcion}</option>`);
                    }
                });
            }
        }

        // Llenar los selects con opciones separadas
        llenarSelect('#dosis', dosisTexto);
        llenarSelect('#presentacion', presentacionTexto, true); // Pasamos `true` para manejar precios
        llenarSelect('#unidad', unidadTexto);

        // Evento para cambiar el precio según la presentación seleccionada
        $('#presentacion').off('change').on('change', function() {
            let precioSeleccionado = $(this).find(':selected').data('precio');
            $('#precio').val(precioSeleccionado || '');
        });

        // Cerrar el modal
        $('#modalBusquedaProducto').modal('hide');
    });
});


