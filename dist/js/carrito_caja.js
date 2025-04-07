// Arreglo para almacenar los productos del carrito
let carrito = [];

function agregarAlCarrito() {
    const nombreProducto = document.querySelector('#nombreProducto').value;
    const laboratorio = document.querySelector('#laboratorio').value;
    const unidad = document.querySelector('#unidad').value; // Formato
    const presentacion = document.querySelector('#presentacion').value;
    const dosis = document.querySelector('#dosis').value;
    const precio = parseFloat(document.querySelector('#precio').value);
    const cantidad = parseInt(document.querySelector('#cantidad').value);

    const imagenProducto = document.querySelector('#imagenProducto').src;
    const nombreImagen = imagenProducto.split('/').pop();
    const rutaImagen = '../../dist/assets/img/' + nombreImagen;

    const nombreCliente = document.querySelector('#nombreCliente').value;
    const cedulaCliente = document.querySelector('#cedulaCliente').value;

    // Validación básica
    if (!nombreProducto || !laboratorio || !unidad || !presentacion || !dosis || !precio || !cantidad) {
        alert('Por favor, complete todos los campos del producto.');
        return;
    }

    if (!nombreCliente || !cedulaCliente) {
        alert('Por favor, complete los campos del cliente.');
        return;
    }

    // 🔒 Verificar si ya existe un producto con misma presentación, dosis y unidad
    const yaExiste = carrito.some(producto =>
        producto.presentacion.trim().toLowerCase() === presentacion.trim().toLowerCase() &&
        producto.dosis.trim().toLowerCase() === dosis.trim().toLowerCase() &&
        producto.unidad.trim().toLowerCase() === unidad.trim().toLowerCase()
    );

    if (yaExiste) {
        alert('Ya existe un producto con la misma presentación, dosis y formato en el carrito.');
        return;
    }

    // Crear el objeto producto
    const producto = {
        nombreProducto,
        laboratorio,
        unidad,
        presentacion,
        dosis,
        precio,
        cantidad,
        imagen: rutaImagen,
        clienteNombre: nombreCliente,
        clienteCedula: cedulaCliente
    };

    // Agregar al carrito
    carrito.push(producto);


    // Actualizar el contador del carrito
    actualizarContador();

    // Mostrar mensaje de éxito
    mostrarNotificacion(rutaImagen, nombreProducto);  // Pasamos la imagen y el nombre del producto
}

// Función para mostrar la notificación de producto agregado
function mostrarNotificacion(imagen, nombreProducto) {
    const notificacion = document.getElementById('notificacion');
    const icono = notificacion.querySelector('.imagen-icono'); // Seleccionamos el elemento donde se mostrará la imagen
    const texto = notificacion.querySelector('span'); // Seleccionamos el texto de la notificación

    // Establecemos la imagen del producto en el icono
    icono.src = imagen;
    texto.textContent = `El producto "${nombreProducto}" se agregó al carrito de Ventas.`;  // Cambiamos el texto

    // Mostrar la notificación
    notificacion.classList.add('show');
    notificacion.style.display = 'flex';

    // Ocultar la notificación después de 3 segundos
    setTimeout(function() {
        notificacion.classList.remove('show'); // Remover la animación
        notificacion.style.display = 'none';
    }, 4000);
}


// Función para actualizar el contador del carrito
function actualizarContador() {
    document.getElementById('contadorCarrito').textContent = carrito.length;
}

// Función para mostrar el carrito en el modal
function mostrarCarrito() {
    const modalCarrito = document.getElementById('mostarCarrito');
    const contenidoCarrito = modalCarrito.querySelector('.modal-body');
    contenidoCarrito.innerHTML = ''; // Limpiar el contenido previo

    let totalGeneral = 0;

    carrito.forEach((producto, index) => {
        const totalProducto = producto.precio * producto.cantidad;
        totalGeneral += totalProducto;

        const productoHTML = `
        <div class="d-flex justify-content-between align-items-center">
            <!-- Imagen del producto -->
            <img src="${producto.imagen}" alt="${producto.nombreProducto}" class="img-fluid" style="width: 100px;">
            
            <div class="flex-grow-1 ms-3">
                <h5 class="fw-bold text-primary mb-1">${producto.nombreProducto}</h5>

                <h6 class="fw-bold text-primary">Precio unitario: C$${producto.precio.toFixed(2)}</h6>
    
                <!-- Solo muestra Presentación si tiene un valor válido -->
                ${producto.presentacion && producto.presentacion !== "Seleccione una opción" ? 
                    `<p class="mb-1"><strong>Presentación:</strong> ${producto.presentacion}</p>` : ''}
                
                <!-- Solo muestra Dosis si tiene un valor válido -->
                ${producto.dosis && producto.dosis !== "Seleccione una opción" ? 
                    `<p class="mb-1"><strong>Dosis:</strong> ${producto.dosis}</p>` : ''}
                
                <!-- Solo muestra Formato si tiene un valor válido -->
                ${producto.unidad && producto.unidad !== "Seleccione una opción" ? 
                    `<p class="mb-1"><strong>Formato:</strong> ${producto.unidad}</p>` : ''}

                <div class="d-flex align-items-center mt-1">
                    <button class="btn btn-outline-primary btn-sm" onclick="updateQuantity(${index}, -1)">-</button>
                    <input type="text" class="form-control mx-2 text-center" value="${producto.cantidad}" style="width: 40px;" readonly>
                    <button class="btn btn-outline-primary btn-sm" onclick="updateQuantity(${index}, 1)">+</button>
                </div>
            </div>
    
            <div class="d-flex flex-column align-items-end">
                <span class="fw-bold text-success mb-2">Subtotal: C$${totalProducto.toFixed(2)}</span>
                <button class="btn btn-danger btn-sm" onclick="removeProduct(${index})">🗑</button>
            </div>
        </div>
        <hr>
    `;
    
    

        contenidoCarrito.insertAdjacentHTML('beforeend', productoHTML);
    });

    document.getElementById('grandTotal').textContent = `C$${totalGeneral.toFixed(2)}`;

    // Mostrar el modal
    const modal = bootstrap.Modal.getOrCreateInstance(modalCarrito);
    modal.show();

}

// Actualizar cantidad del producto en el carrito
function updateQuantity(index, cantidadCambio) {
    const producto = carrito[index];
    producto.cantidad += cantidadCambio;
    if (producto.cantidad < 1) producto.cantidad = 1;
    mostrarCarrito();
}

// Eliminar un producto del carrito
function removeProduct(index) {
    carrito.splice(index, 1);
    actualizarContador();
    mostrarCarrito();
}

// Abrir modal de método de pago
function abrirModalPago() {
    const total = carrito.reduce((sum, p) => sum + (p.precio * p.cantidad), 0);
    document.getElementById('totalPagar').value = `C$${total.toFixed(2)}`;
    document.getElementById('montoRecibido').value = '';
    document.getElementById('vueltoCliente').value = '';

    const modalPago = new bootstrap.Modal(document.getElementById('modalMetodoPago'));
    modalPago.show();
}

// Calcular vuelto
function calcularVuelto() {
    const total = parseFloat(document.getElementById('totalPagar').value.replace('C$', '').trim());
    const recibido = parseFloat(document.getElementById('montoRecibido').value);

    if (!isNaN(total) && !isNaN(recibido)) {
        const vuelto = recibido - total;
        document.getElementById('vueltoCliente').value = vuelto >= 0 ? `C$${vuelto.toFixed(2)}` : 'C$0.00';
    }
}

function confirmarPago() {
    const recibido = parseFloat(document.getElementById('montoRecibido').value);
    const total = parseFloat(document.getElementById('totalPagar').value.replace('C$', '').trim());

    if (isNaN(recibido) || recibido < total) {
        alert("El monto recibido es insuficiente.");
        return;
    }

    // Obtener solo el nombre y cédula del cliente desde el formulario
    const nombreCliente = document.getElementById('nombreCliente').value || 'Cliente Genérico';
    const cedulaCliente = document.getElementById('cedulaCliente').value || 'Cédula no registrada';

    // Si no tienes dirección o teléfono en tu formulario, no hace falta asignar valores por defecto
    // Los valores se dejarán vacíos o nulos
    const direccionCliente = ''; // Sin dirección
    const telefonoCliente = ''; // Sin teléfono

    // Insertar los datos en la factura
    document.getElementById('clienteNombre').textContent = nombreCliente;
    document.getElementById('clienteCedula').textContent = cedulaCliente;
    document.getElementById('clienteDireccion').textContent = direccionCliente || 'Dirección no registrada'; // Este campo no se utilizará en este caso
    document.getElementById('clienteTelefono').textContent = telefonoCliente || '---'; // Este campo tampoco

    // Insertar fecha actual
    const fechaActual = new Date().toLocaleDateString('es-ES');
    document.getElementById('fechaFactura').textContent = fechaActual;

    // Número de factura aleatorio
    const numeroFactura = Math.floor(10000 + Math.random() * 90000);
    document.getElementById('numeroFactura').textContent = numeroFactura;

    // Obtener productos del carrito
    const filasCarrito = document.querySelectorAll('#tablaCarrito tbody tr');
    const cuerpoFactura = document.getElementById('detalleFactura');
    cuerpoFactura.innerHTML = '';

    let totalFactura = 0;

    filasCarrito.forEach(fila => {
        const columnas = fila.querySelectorAll('td');
        const nombreProducto = columnas[0].textContent;
        const cantidad = columnas[1].textContent;
        const precio = columnas[2].textContent.replace('$', '').replace(',', '');
        const subtotal = columnas[4].textContent.replace('$', '').replace(',', '');

        totalFactura += parseFloat(subtotal);

        const filaFactura = document.createElement('tr');
        filaFactura.innerHTML = `
            <td>${nombreProducto}</td>
            <td>${cantidad}</td>
            <td>$${parseFloat(precio).toFixed(2)}</td>
            <td>$${parseFloat(subtotal).toFixed(2)}</td>
        `;
        cuerpoFactura.appendChild(filaFactura);
    });

    document.getElementById('totalFactura').textContent = totalFactura.toFixed(2);

    // Mostrar factura final
    document.getElementById('facturaFinal').style.display = 'block';

    // Confirmación visual
    alert("✅ Pago procesado con éxito. ¡Gracias por su compra!");

    // Limpiar carrito
    carrito = [];
    actualizarContador();

    // Cerrar modales
    const modalPago = bootstrap.Modal.getInstance(document.getElementById('modalMetodoPago'));
    modalPago.hide();
    const modalCarrito = bootstrap.Modal.getInstance(document.getElementById('mostarCarrito'));
    modalCarrito.hide();
}

  