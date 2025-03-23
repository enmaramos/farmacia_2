$(document).ready(function() {
    // Evento para abrir el modal de ver usuario y cargar los datos del usuario
    $('#modalVerUsuario').on('show.bs.modal', function(event) {
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
                    $('#imagenUsuarioVer').attr('src', response.Imagen);
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
});
