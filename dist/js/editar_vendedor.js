$(document).ready(function() {
    // Cargar los datos del vendedor en el modal
    $(".editarVendedorBtn").click(function() {
        var vendedorId = $(this).data("id");
        console.log("Vendedor ID:", vendedorId);

        $.ajax({
            url: "../pages/Ctrl/obtener_vendedor.php",
            type: "POST",
            data: { vendedorId: vendedorId },
            dataType: "json",
            success: function(response) {
                if (response.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error
                    });
                } else {
                    console.log("Datos recibidos:", response);

                    // Llenar el formulario del modal con los datos del vendedor
                    $("#idVendedor").val(response.ID_Vendedor);
                    $("#editarNombreVendedor").val(response.Nombre);
                    $("#editarCedulaVendedor").val(response.N_Cedula);
                    $("#editarTelefonoVendedor").val(response.Telefono);
                    $("#editarDireccionVendedor").val(response.Direccion);
                    $("#editarSexoVendedor").val(response.Sexo);
                    $("#editarCorreoVendedor").val(response.Correo);

                    // Mostrar el modal
                    $("#modalEditarVendedor").modal("show");
                }
            },
            error: function(xhr) {
                console.error("Error al obtener los datos:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al obtener los datos del vendedor.'
                });
            }
        });
    });

    // Actualizar el vendedor con AJAX
    $("#formEditarVendedor").submit(function(event) {
        event.preventDefault(); // Evita el recargo de la página

        var formData = $(this).serialize(); // Serializa los datos del formulario

        $.ajax({
            url: "../pages/Ctrl/actualizar_vendedor.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.success
                    }).then(() => {
                        location.reload(); // Recargar la página para ver los cambios
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.error
                    });
                }
            },
            error: function(xhr) {
                console.error("Error en la petición AJAX:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un problema al actualizar el vendedor.'
                });
            }
        });
    });
});
