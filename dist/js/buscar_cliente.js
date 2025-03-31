// Función para abrir el modal y cargar los clientes
function abrirBusquedaCliente() {
    // Mostrar el modal
    $('#clientesModal').modal('show');

    // Hacer la solicitud AJAX para obtener los clientes
    fetch('../pages/Ctrl/obtener_clientes.php')
        .then(response => response.json()) // Convertir la respuesta a JSON
        .then(data => {
            // Verificar si la respuesta es un array
            if (Array.isArray(data)) {
                // Limpiar el cuerpo de la tabla antes de agregar nuevos datos
                const clientesTableBody = document.getElementById('clientesTableBody');
                clientesTableBody.innerHTML = '';

                // Llenar la tabla con los datos de los clientes
                data.forEach(cliente => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${cliente.ID_Cliente}</td>
                        <td>${cliente.Nombre} ${cliente.Apellido}</td>
                        <td>${cliente.Cedula}</td>
                        <td>${cliente.Genero}</td>
                        <td>${cliente.Telefono}</td>
                        <td><button class="btn btn-primary" onclick="seleccionarCliente(${cliente.ID_Cliente})">Seleccionar</button></td>
                    `;
                    clientesTableBody.appendChild(row);
                });
            } else {
                console.error("La respuesta no es un array:", data);
            }
        })
        .catch(error => console.error('Error al obtener los clientes:', error));
}

// Función para seleccionar un cliente y rellenar el formulario
function seleccionarCliente(idCliente) {
    // Hacer la solicitud AJAX para obtener los datos del cliente seleccionado
    fetch(`../pages/Ctrl/obtener_clientes.php?idCliente=${idCliente}`)
        .then(response => response.json())
        .then(cliente => {
            // Rellenar los campos del formulario con los datos del cliente
            document.getElementById('nombreCliente').value = cliente.Nombre + ' ' + cliente.Apellido;
            document.getElementById('cedulaCliente').value = cliente.Cedula;
            document.getElementById('generoCliente').value = cliente.Genero;
            document.getElementById('telefonoCliente').value = cliente.Telefono;
            document.getElementById('direccionCliente').value = cliente.Direccion;

            // Cerrar el modal
            $('#clientesModal').modal('hide');
        })
        .catch(error => console.error('Error al obtener el cliente:', error));
}
