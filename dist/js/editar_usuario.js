$(document).ready(function() {
  if (!$.fn.DataTable.isDataTable("#empleadosTable")) {
      var usuariosTable = $('#empleadosTable').DataTable({
          destroy: true,
          ajax: {
              url: '../pages/Ctrl/obtener_usuarios.php',
              dataSrc: ''
          },
          columns: [
              { data: 'ID_Usuario' },
              { data: 'Nombre_Usuario' },
              { data: 'Email' },
              { data: 'Telefono' },
              { data: 'IdRol' },
              {
                  data: null,
                  render: function(data, type, row) {
                      return `<button class="editarUsuarioBtn btn btn-warning" data-id="${row.ID_Usuario}">Editar</button>`;
                  }
              }
          ],
          language: {
              url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
          }
      });
  }

  $('#empleadosTable tbody').on('click', '.editarUsuarioBtn', function() {
      const userId = $(this).data('id');
      console.log('User ID:', userId);

      $.ajax({
          url: '../pages/Ctrl/obtener_usuario.php',
          type: 'POST',
          data: { userId: userId },
          dataType: 'json',
          success: function(response) {
              $('#idUsuario').val(response.ID_Usuario);
              $('#nombre_Usuario').val(response.Nombre_Usuario);
              $('#email_Usuario').val(response.Email);
              $('#contraseña_Usuario').val(response.Contraseña);
              $('#telefono_Usuario').val(response.Telefono);
              $('#rol_Usuario').val(response.IdRol);
              $('#imagenPreview').attr('src', 'uploads/' + response.Imagen).show();
          },
          error: function(xhr, status, error) {
              console.error('Error al obtener los datos del usuario:', error);
              alert('Error al obtener los datos del usuario.');
          }
      });
  });

  $('#modalEditarUsuario form').on('submit', function(event) {
      event.preventDefault();

      const formData = new FormData(this);
      $.ajax({
          url: '../pages/Ctrl/actualizar_usuario.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
              console.log(response);
              if (response.error) {
                  alert('Error al actualizar el usuario: ' + response.error);
              } else if (response.success) {
                  if (confirm('Usuario actualizado correctamente. ¿Quieres volver a la lista de usuarios?')) {
                      window.location.href = '../pages/usuarios.php';
                  }
              }
          },
          error: function(xhr, status, error) {
              console.error('Error al actualizar el usuario:', error);
              alert('Error al actualizar el usuario.');
          }
      });
  });
});

