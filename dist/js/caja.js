document.addEventListener("DOMContentLoaded", function () {
    // Elementos del formulario
    const inputProducto = document.querySelector("#buscarProducto");
    const inputCliente = document.querySelector("#buscarCliente");
    const selectDosis = document.querySelector("#dosis");
    const selectPresentacion = document.querySelector("#presentacion");
    const selectUnidad = document.querySelector("#unidad");
    const inputPrecio = document.querySelector("#precio");
    const inputLaboratorio = document.querySelector("#laboratorio");
    const imgProducto = document.querySelector("#imagenProducto");
    const inputTelefonoCliente = document.querySelector("#telefonoCliente");
    const inputDireccionCliente = document.querySelector("#direccionCliente");

    let productos = [];
    let clientes = [];

    // Obtener productos desde la API
    fetch("../pages/Ctrl/api_caja.php?tipo=productos")
        .then(response => response.json())
        .then(data => {
            productos = data;
            cargarListaProductos();
        })
        .catch(error => console.error("Error al obtener productos: ", error));

    // Obtener clientes desde la API
    fetch("../pages/Ctrl/api_caja.php?tipo=clientes")
        .then(response => response.json())
        .then(data => {
            clientes = data;
            cargarListaClientes();
        })
        .catch(error => console.error("Error al obtener clientes: ", error));

    // Función para cargar la lista de productos en el datalist
    function cargarListaProductos() {
        if (productos && productos.length > 0) {
            const listaProductos = document.querySelector("#listaProductos");
            listaProductos.innerHTML = "";

            productos.forEach(producto => {
                const option = document.createElement('option');
                option.value = producto.Nombre_Medicamento;
                listaProductos.appendChild(option);
            });

            inputProducto.addEventListener('input', function () {
                const valor = inputProducto.value.toLowerCase();
                const filtrados = productos.filter(producto => producto.Nombre_Medicamento.toLowerCase().includes(valor));

                // Limpiar los campos de dosis, presentación, unidad y precio
                selectDosis.innerHTML = "<option>Seleccione Dosis</option>";
                selectPresentacion.innerHTML = "<option>Seleccione Presentación</option>";
                selectUnidad.innerHTML = "<option>Seleccione Unidad</option>";
                inputPrecio.value = '';
                inputLaboratorio.value = '';
                imgProducto.src = 'default.jpg';

                filtrados.forEach(producto => {
                    if (producto.Nombre_Medicamento.toLowerCase() === valor) {
                        inputLaboratorio.value = producto.LAB_o_MARCA;
                        selectDosis.innerHTML = `<option>${producto.Dosis}</option>`;
                        selectPresentacion.innerHTML = `<option>${producto.Presentacion}</option>`;
                        selectUnidad.innerHTML = `<option>${producto.Presentacion}</option>`; // Asumiendo que "Presentación" es también "Unidad"
                        inputPrecio.value = producto.Precio_Con_Impuesto;
                        imgProducto.src = producto.Imagen ? `../assets/imgProductos/${producto.Imagen}` : 'default.jpg';
                    }
                });
            });
        }
    }

    // Función para cargar la lista de clientes en el datalist
    function cargarListaClientes() {
        if (clientes && clientes.length > 0) {
            const listaClientes = document.querySelector("#listaClientes");
            listaClientes.innerHTML = "";

            clientes.forEach(cliente => {
                const option = document.createElement('option');
                option.value = cliente.Nombre_Completo;
                listaClientes.appendChild(option);
            });

            inputCliente.addEventListener('input', function () {
                const valor = inputCliente.value.toLowerCase();
                const filtrados = clientes.filter(cliente => cliente.Nombre_Completo.toLowerCase().includes(valor));

                // Limpiar los campos de teléfono y dirección
                inputTelefonoCliente.value = '';
                inputDireccionCliente.value = '';

                filtrados.forEach(cliente => {
                    if (cliente.Nombre_Completo.toLowerCase() === valor) {
                        inputTelefonoCliente.value = cliente.Telefono;
                        inputDireccionCliente.value = cliente.Direccion;
                    }
                });
            });
        }
    }
});
