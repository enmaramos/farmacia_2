$(document).ready(function() {
    // Evento para abrir el modal de editar usuario y cargar los datos del usuario
    $('#modalEditarUsuario').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que abre el modal
        var userId = button.data('id'); // Extrae el ID del usuario

        // Llama a obtener_usuario.php para obtener los datos del usuario
        $.ajax({
            type: 'POST',
            url: 'obtener_usuario.php',
            data: { userId: userId },
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    // Rellena los campos del modal con los datos del usuario
                    $('#idUsuarioVer').val(response.ID_Usuario);
                    $('#nombreUsuarioVer').val(response.Nombre_Usuario);
                    $('#passwordUsuarioVer').val(response.Password);
                    $('#vendedorUsuarioVer').val(response.ID_Vendedor);
                    $('#estadoUsuarioVer').val(response.estado_usuario == 1 ? 'Activo' : 'Inactivo');
                    $('#fechaCreacionUsuarioVer').val(response.Fecha_Creacion);
                    $('#ultimoAccesoUsuarioVer').val(response.Ultimo_Acceso ? response.Ultimo_Acceso : 'No disponible');
                }
            },
            error: function() {
                alert('Error al obtener los datos del usuario.');
            }
        });
    });

    // Manejar el envío del formulario para actualizar el usuario
    $('#btnActualizarUsuario').on('click', function() {
        var id_usuario = $('#idUsuarioVer').val();
        var nombre_usuario = $('#nombreUsuarioVer').val();
        var password_usuario = $('#passwordUsuarioVer').val();
        var vendedor_usuario = $('#vendedorUsuarioVer').val();
        var estado_usuario = $('#estadoUsuarioVer').val() === 'Activo' ? 1 : 0;

        // Enviar los datos al servidor para actualizar
        $.ajax({
            type: 'POST',
            url: 'actualizar_usuario.php',
            data: {
                id_usuario: id_usuario,
                nombre_usuario: nombre_usuario,
                password_usuario: password_usuario,
                vendedor_usuario: vendedor_usuario,
                estado_usuario: estado_usuario
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Usuario actualizado con éxito.');
                    location.reload(); // Recargar la página para ver los cambios
                } else {
                    alert(response.error);
                }
            },
            error: function() {
                alert('Error al actualizar el usuario.');
            }
        });
    });
});
