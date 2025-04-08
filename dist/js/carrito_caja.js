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
    texto.textContent = `El producto "${nombreProducto}" se agregó al carrito de compras.`;  // Cambiamos el texto

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

// Función para actualizar la cantidad de un producto en el carrito
function updateQuantity(index, cantidadCambio) {
    const producto = carrito[index];
    producto.cantidad += cantidadCambio;

    // Evitar que la cantidad sea menor a 1
    if (producto.cantidad < 1) producto.cantidad = 1;

    // Volver a mostrar el carrito
    mostrarCarrito();
}

// Función para eliminar un producto del carrito
function removeProduct(index) {
    carrito.splice(index, 1); // Eliminar el producto del carrito
    actualizarContador(); // Actualizar el contador
    mostrarCarrito(); // Volver a mostrar el carrito
}

// Event Listener para el botón de agregar al carrito
document.querySelector('#btnAgregar').addEventListener('click', agregarAlCarrito);

// Event Listener para el ícono del carrito
document.querySelector('.carrito-icono').addEventListener('click', mostrarCarrito);


 ////////////////////////////////////////////////////////AQUI INICIA MODAL POGOS/////////////////////////////////////////////////////////////////////

// Función para realizar la compra
function realizarCompra() {
    // Obtener el total general de la compra
    const totalGeneral = carrito.reduce((total, producto) => total + (producto.precio * producto.cantidad), 0);

    // Asignar el total general al campo "Total a Pagar" del modal de pago
    document.getElementById('totalPagar').value = `C$${totalGeneral.toFixed(2)}`;

    // Cerrar el modal del carrito
    const modalCarrito = bootstrap.Modal.getOrCreateInstance(document.getElementById('mostarCarrito'));
    modalCarrito.hide();

    // Abrir el modal de método de pago
    const modalMetodoPago = new bootstrap.Modal(document.getElementById('modalMetodoPago'));
    modalMetodoPago.show();
}
// Función para calcular el vuelto
function calcularVuelto() {
    const totalPagar = parseFloat(document.getElementById('totalPagar').value.replace('C$', '').trim());
    const montoRecibido = parseFloat(document.getElementById('montoRecibido').value);

    // Si el monto recibido es mayor o igual al total a pagar, calcular el vuelto
    if (!isNaN(montoRecibido) && montoRecibido >= totalPagar) {
        const vuelto = montoRecibido - totalPagar;
        document.getElementById('vueltoCliente').value = `C$${vuelto.toFixed(2)}`;
    } else {
        // Si el monto recibido es menor, mostrar 0
        document.getElementById('vueltoCliente').value = 'C$0.00';
    }
}

// Función para manejar la acción de facturar
function realizarCompra() {
    // Verificar si el carrito está vacío
    if (carrito.length === 0) {
        alert('¡Tu carrito está vacío! Agrega productos antes de proceder con la compra.');
        return;
    }

    // Calcular el total general del carrito
    let totalGeneral = 0;
    carrito.forEach(producto => {
        totalGeneral += producto.precio * producto.cantidad;
    });

    // Mostrar el total en el modal de método de pago
    document.getElementById('totalPagar').value = `C$${totalGeneral.toFixed(2)}`;

    // Cerrar el modal del carrito
    const modalCarrito = bootstrap.Modal.getInstance(document.getElementById('mostarCarrito'));
    modalCarrito.hide();

    // Abrir el modal de método de pago
    const modalMetodoPago = new bootstrap.Modal(document.getElementById('modalMetodoPago'));
    modalMetodoPago.show();
}

//////////////////////////////////////////////////AQUI INICIA FACTURA/////////////////////////////////////////////////////////////////

// Función para realizar la compra y generar la factura
function realizarCompra() {
    // Verificar si el carrito está vacío
    if (carrito.length === 0) {
        alert('¡Tu carrito está vacío! Agrega productos antes de proceder con la compra.');
        return;
    }

    // Calcular el total general del carrito
    let totalGeneral = 0;
    carrito.forEach(producto => {
        totalGeneral += producto.precio * producto.cantidad;
    });

    // Asignar el total general al campo "Total a Pagar" del modal de pago
    document.getElementById('totalPagar').value = `C$${totalGeneral.toFixed(2)}`;

    // Cerrar el modal del carrito
    const modalCarrito = bootstrap.Modal.getInstance(document.getElementById('mostarCarrito'));
    modalCarrito.hide();

    // Abrir el modal de método de pago
    const modalMetodoPago = new bootstrap.Modal(document.getElementById('modalMetodoPago'));
    modalMetodoPago.show();

    // Botón de "Pagar" en el modal de pago
    document.getElementById('btnPagar').addEventListener('click', function() {
        generarFactura(totalGeneral); // Llamamos a la función para generar la factura después del pago
    });
}

// Función para generar la factura
function generarFactura(totalGeneral) {
    let facturaHTML = `
        <div style="font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc;">
            <h2 style="text-align: center;">Factura de Compra</h2>
            <hr>
            <p><strong>Fecha:</strong> ${new Date().toLocaleString()}</p>
            <p><strong>Cliente:</strong> ${carrito[0].clienteNombre} (Cédula: ${carrito[0].clienteCedula})</p>
            <hr>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ccc; padding: 8px; text-align: left;">Producto</th>
                        <th style="border: 1px solid #ccc; padding: 8px; text-align: left;">Cantidad</th>
                        <th style="border: 1px solid #ccc; padding: 8px; text-align: left;">Precio Unitario</th>
                        <th style="border: 1px solid #ccc; padding: 8px; text-align: left;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
    `;

    carrito.forEach(producto => {
        const subtotal = producto.precio * producto.cantidad;
        facturaHTML += `
            <tr>
                <td style="border: 1px solid #ccc; padding: 8px;">${producto.nombreProducto}</td>
                <td style="border: 1px solid #ccc; padding: 8px;">${producto.cantidad}</td>
                <td style="border: 1px solid #ccc; padding: 8px;">C$${producto.precio.toFixed(2)}</td>
                <td style="border: 1px solid #ccc; padding: 8px;">C$${subtotal.toFixed(2)}</td>
            </tr>
        `;
    });

    facturaHTML += `
                </tbody>
            </table>
            <hr>
            <p><strong>Total a Pagar:</strong> C$${totalGeneral.toFixed(2)}</p>
            <p><strong>Pago con:</strong> ${document.getElementById('metodoPago').value}</p>
            <p><strong>Vuelto:</strong> ${document.getElementById('vueltoCliente').value}</p>
            <hr>
            <p style="text-align: center;">¡Gracias por tu compra!</p>
        </div>
    `;

    // Mostramos la factura en un modal o ventana emergente
    const facturaModal = new bootstrap.Modal(document.getElementById('modalFactura'));
    document.getElementById('modalFacturaBody').innerHTML = facturaHTML;
    facturaModal.show();
}

// Función para calcular el vuelto (ya está definida en tu código original)
function calcularVuelto() {
    const totalPagar = parseFloat(document.getElementById('totalPagar').value.replace('C$', '').trim());
    const montoRecibido = parseFloat(document.getElementById('montoRecibido').value);

    if (!isNaN(montoRecibido) && montoRecibido >= totalPagar) {
        const vuelto = montoRecibido - totalPagar;
        document.getElementById('vueltoCliente').value = `C$${vuelto.toFixed(2)}`;
    } else {
        document.getElementById('vueltoCliente').value = 'C$0.00';
    }
}

function imprimirFactura() {
    const facturaContenido = document.getElementById('modalFacturaBody').innerHTML;
    const ventanaImpresion = window.open('', '', 'width=800,height=600');
    ventanaImpresion.document.write(facturaContenido);
    ventanaImpresion.document.close();
    ventanaImpresion.print();
}
