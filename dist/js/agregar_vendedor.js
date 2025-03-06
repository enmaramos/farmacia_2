$(document).ready(function() {
    $('#tablaVendedores').DataTable();

    // Evento para el botón de agregar vendedor
    $('#agregarVendedor').on('click', function() {
        $('#modalAgregarVendedor').modal('show');
    });

    // Evento para manejar el envío del formulario de agregar vendedor
    $('#formAgregarVendedor').on('submit', function(e) {
        e.preventDefault();
        var datos = $(this).serialize();

        $.ajax({
            url: '../pages/Ctrl/agregar_vendedor.php',
            type: 'POST',
            data: datos,
            success: function(response) {
                if (response == 'success') {
                    alert('Vendedor agregado exitosamente');
                    location.reload();
                } else {
                    alert('Error al agregar vendedor');
                }
            }
        });
    });
});