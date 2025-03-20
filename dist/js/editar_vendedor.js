$(document).ready(function() {
    // Cargar los datos del vendedor en el modal
    $(".editarVendedorBtn").click(function() {
        var vendedorId = $(this).data("id");
        console.log("Vendedor ID enviado:", vendedorId);

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

                    // Verificar si Apellido y Email están en la respuesta
                    if (!response.Apellido || !response.Email) {
                        console.error("Error: No se recibió Apellido o Email.");
                    }

                    // Llenar el formulario del modal con los datos del vendedor
                    $("#idVendedor").val(response.ID_Vendedor);
                    $("#editarNombreVendedor").val(response.Nombre);
                    $("#editarApellidoVendedor").val(response.Apellido || "");  // Evitar valores nulos
                    $("#editarCedulaVendedor").val(response.N_Cedula);
                    $("#editarTelefonoVendedor").val(response.Telefono);
                    $("#editarDireccionVendedor").val(response.Direccion);
                    $("#editarSexoVendedor").val(response.Sexo);
                    $("#editarCorreoVendedor").val(response.Email || ""); // Evitar valores nulos
                    $("#editarRolVendedor").val(response.ID_Rol);

                    // Mostrar el modal de edición
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
});
