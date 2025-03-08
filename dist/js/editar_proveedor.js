$(document).ready(function() {
    if (!$.fn.DataTable.isDataTable("#proveedoresTable")) {
        var proveedoresTable = $('#proveedoresTable').DataTable({
            destroy: true,
            ajax: {
                url: '../pages/Ctrl/obtener_proveedor.php',
                dataSrc: ''
            },
            columns: [
                { data: 'ID_Proveedor' },
                { data: 'Nombre' },
                { data: 'Apellido' },
                { data: 'Empresa_Laboratorio' },
                { data: 'Telefono' },
                { data: 'Email' },
                { data: 'RUC' },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `<button class="editarProveedorBtn btn btn-warning" data-id="${row.ID_Proveedor}">Editar</button>`;
                    }
                }
            ],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            }
        });
    }

    $('#proveedoresTable tbody').on('click', '.editarProveedorBtn', function() {
        const proveedorId = $(this).data('id');
        console.log('Proveedor ID:', proveedorId);

        $.ajax({
            url: '../pages/Ctrl/obtener_proveedor.php',
            type: 'POST',
            data: { proveedorId: proveedorId },
            dataType: 'json',
            success: function(response) {
                $('#idProveedor').val(response.ID_Proveedor);
                $('#nombre_Proveedor').val(response.Nombre);
                $('#apellido_Proveedor').val(response.Apellido);
                $('#empresa_Laboratorio').val(response.Empresa_Laboratorio);
                $('#direccion_Proveedor').val(response.Direccion);
                $('#ciudad_Proveedor').val(response.Ciudad);
                $('#departamento_Proveedor').val(response.Departamento);
                $('#telefono_Proveedor').val(response.Telefono);
                $('#email_Proveedor').val(response.Email);
                $('#ruc_Proveedor').val(response.RUC);
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos del proveedor:', error);
                alert('Error al obtener los datos del proveedor');
            }
        });
    });

    $('#modalEditarProveedor form').on('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(this);
        $.ajax({
            url: '../pages/Ctrl/actualizar_proveedor.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const data = JSON.parse(response);  // Convertir respuesta JSON

                if (data.error) {
                    alert('Error al actualizar el proveedor: ' + data.error);
                } else if (data.success) {
                    alert('Proveedor actualizado correctamente');
                    // Si deseas redirigir después del éxito
                    window.location.href = '../pages/proveedores.php';
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al actualizar el proveedor:', error);
                alert('Error al actualizar el proveedor');
            }
        });
    });
});
