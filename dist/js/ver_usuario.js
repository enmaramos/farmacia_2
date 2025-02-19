$(document).ready(function() {
    // Mostrar los datos del usuario cuando se hace clic en el botón de "Ver"
    $('#empleadosTable tbody').on('click', '.VerUsuarioBtn', function() {
        const userId = $(this).data('id');
        console.log('User ID:', userId); // Verifica que el ID se esté obteniendo correctamente
        
        // Hacer una solicitud AJAX al servidor para obtener los datos del usuario
        $.ajax({
            url: '../pages/Ctrl/obtener_usuario.php', // Archivo que devuelve los datos del usuario
            type: 'POST',
            data: { userId: userId },
            dataType: 'json',
            success: function(response) {
                // Llenar los campos del modal con los datos obtenidos
                $(' #idUsuario').val(response.ID_Usuario);
                $(' #nombre_Usuario').val(response.Nombre_Usuario);
                $(' #email_Usuario').val(response.Email);
                $(' #contraseña_Usuario').val(response.Contraseña); // Muestra la contraseña (solo para mostrar, no editable)
                $(' #telefono_Usuario').val(response.Telefono);
                $(' #rol_Usuario').val(response.IdRol);
                $(' #imagenPreview').attr('src', 'uploads/' + response.Imagen); // Muestra la imagen en la vista previa
                
                // Mostrar el modal
                $('#modalVerUsuario').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error al obtener los datos del usuario:', error);
                alert('Error al obtener los datos del usuario.');
            }
        });
    });
});
