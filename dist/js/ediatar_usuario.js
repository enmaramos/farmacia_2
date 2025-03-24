$(document).ready(function () {
    // Cuando se hace clic en el botón Editar
    $('#modalEditarUsuario').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget); // El botón que abrió el modal
        var userId = button.data('id'); // Obtener el ID del usuario

        // Hacer la solicitud AJAX al archivo obtener_usuario.php
        $.ajax({
            url: '../Cnx/obtener_usuario.php',
            type: 'POST',
            data: { userId: userId },
            dataType: 'json',
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    // Rellenar los campos del modal con la información del usuario
                    $('#nombreUsuarioEditar').val(response.Nombre_Usuario);
                    $('#passwordUsuarioEditar').val(response.Password);
                    $('#imagenUsuarioEditar').attr('src', response.Imagen ? "../../dist/pages/uploads/" + response.Imagen : "../../dist/pages/uploads/default.jpg");
                    $('#modalEditarUsuario').data('id', response.ID_Usuario);  // Guardar el ID del usuario
                }
            },
            error: function () {
                alert("Hubo un error al obtener los datos del usuario.");
            }
        });
    });

    // Acción para actualizar el usuario
    $(document).on('click', '#btnActualizarUsuario', function () {
        var userId = $('#modalEditarUsuario').data('id');  // Obtener el ID del usuario
        var nombreUsuario = $('#nombreUsuarioEditar').val();
        var passwordUsuario = $('#passwordUsuarioEditar').val();

        // Enviar los datos mediante AJAX para actualizar el usuario
        $.ajax({
            url: '../Cnx/actualizar_usuario.php',
            type: 'POST',
            data: {
                userId: userId,
                nombreUsuario: nombreUsuario,
                passwordUsuario: passwordUsuario
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    alert(response.success);
                    $('#modalEditarUsuario').modal('hide');
                    location.reload();  // Recargar la página para ver los cambios
                } else {
                    alert(response.error);
                }
            },
            error: function () {
                alert("Hubo un error al actualizar los datos.");
            }
        });
    });
});
