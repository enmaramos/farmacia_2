$(document).ready(function () {
    $(".VerProveedorBtn").click(function () {
        let proveedorId = $(this).data("id");

        $.ajax({
            url: "../pages/Ctrl/obtener_proveedor.php",
            type: "POST",
            data: { proveedorId: proveedorId },
            dataType: "json",
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    // Asignar los valores correctos a los inputs del modal
                    $("#Nombre").val(response.Nombre);
                    $("#Apellido").val(response.Apellido);
                    $("#Empresa_Laboratorio").val(response.Empresa_Laboratorio);
                    $("#Direccion").val(response.Direccion);
                    $("#Ciudad").val(response.Ciudad);
                    $("#Departamento").val(response.Departamento);
                    $("#Telefono").val(response.Telefono);
                    $("#Email").val(response.Email);
                    $("#RUC").val(response.RUC);
                }
            },
            error: function () {
                alert("Hubo un error al obtener los datos.");
            }
        });
    });
});