// Función para abrir el modal de búsqueda de cliente
function abrirBusquedaCliente() {
    // Abrir el modal
    $('#clientesModal').modal('show');
}

document.addEventListener('DOMContentLoaded', () => {
    // Obtener todos los botones "Seleccionar" dentro del modal
    const botonesSeleccionar = document.querySelectorAll('.select-client');
    
    botonesSeleccionar.forEach(boton => {
        boton.addEventListener('click', () => {
            const idCliente = boton.getAttribute('data-id');
            const fila = boton.closest('tr'); // Obtener la fila correspondiente al cliente

            // Obtener los valores de la fila
            const nombreCompleto = fila.children[1].innerText;
            const cedula = fila.children[2].innerText;
            const genero = fila.children[3].innerText;
            const telefono = fila.children[4].innerText;

            // Asignar los valores a los campos del formulario
            document.getElementById('nombreCliente').value = nombreCompleto;
            document.getElementById('cedulaCliente').value = cedula;
            document.getElementById('generoCliente').value = genero;
            document.getElementById('telefonoCliente').value = telefono;

            // Cerrar el modal
            $('#clientesModal').modal('hide');
        });
    });
});
