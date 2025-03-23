$(document).ready(function() {
    // Cargar los datos del vendedor en el modal de ver detalles
    $(".VerVendedorBtn").click(function() {
        var vendedorId = $(this).data("id");
        console.log("Vendedor ID enviado para ver:", vendedorId);

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

                    // Verificar si los datos están presentes
                    if(response.Nombre && response.Apellido && response.N_Cedula) {
                        // Llenar el modal con los datos del vendedor
                        $("#nombreVendedorVer").val(response.Nombre);
                        $("#apellidoVendedorVer").val(response.Apellido);
                        $("#cedulaVendedorVer").val(response.N_Cedula);
                        $("#telefonoVendedorVer").val(response.Telefono);
                        $("#direccionVendedorVer").val(response.Direccion || "No disponible");
                        $("#sexoVendedorVer").val(response.Sexo === 'H' ? 'Masculino' : 'Femenino');
                        $("#emailVendedorVer").val(response.Email);
                        $("#rolVendedorVer").val(response.ID_Rol == 1 ? 'Administrador' : 'Vendedor');
                    } else {
                        console.log("Datos incompletos recibidos:", response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Faltan algunos datos del vendedor.'
                        });
                    }

                    // Mostrar el modal de ver detalles
                    $("#modalVerVendedor").modal("show");
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
