// Arreglo para almacenar los productos del carrito
let carrito = [];

// Función para agregar productos al carrito
function agregarAlCarrito() {
    // Obtener los valores del formulario de producto
    const nombreProducto = document.querySelector('#nombreProducto').value;
    const laboratorio = document.querySelector('#laboratorio').value;
    const unidad = document.querySelector('#unidad').value;
    const presentacion = document.querySelector('#presentacion').value;
    const dosis = document.querySelector('#dosis').value;
    const precio = parseFloat(document.querySelector('#precio').value);
    const cantidad = parseInt(document.querySelector('#cantidad').value);

    // Obtener la imagen del producto y generar la ruta completa
    const imagenProducto = document.querySelector('#imagenProducto').src; // Obtiene la URL completa de la imagen mostrada en el HTML
    const nombreImagen = imagenProducto.split('/').pop();  // Extrae solo el nombre del archivo de imagen
    const rutaImagen = '../../dist/assets/img/' + nombreImagen;  // Genera la ruta completa de la imagen

    // Obtener los valores del formulario de cliente
    const nombreCliente = document.querySelector('#nombreCliente').value;
    const cedulaCliente = document.querySelector('#cedulaCliente').value;

    // Verificar que todos los campos de producto estén completos
    if (!nombreProducto || !laboratorio || !unidad || !presentacion || !dosis || !precio || !cantidad) {
        alert('Por favor, complete todos los campos del producto.');
        return;
    }

    // Verificar que los campos de cliente estén completos
    if (!nombreCliente || !cedulaCliente) {
        alert('Por favor, complete los campos del cliente.');
        return;
    }

    // Crear un objeto con los datos del producto
    const producto = {
        nombreProducto,
        laboratorio,
        unidad,
        presentacion,
        dosis,
        precio,
        cantidad,
        imagen: rutaImagen,  // Usamos la ruta completa de la imagen
        clienteNombre: nombreCliente,
        clienteCedula: cedulaCliente
    };

    // Agregar el producto al carrito
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
