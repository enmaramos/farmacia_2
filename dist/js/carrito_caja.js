let carrito = [];

// Función para agregar productos al carrito
function agregarAlCarrito() {
    const nombreProducto = document.querySelector('#productoForm input[placeholder="Nombre del producto"]').value;
    const dosis = document.querySelector('#productoForm input[placeholder="Dosis"]').value;
    const presentacion = document.querySelector('#productoForm input[placeholder="Presentación"]').value;
    const unidad = document.querySelector('#productoForm input[placeholder="Unidad"]').value;
    const precio = document.querySelector('#productoForm input[placeholder="Precio"]').value;
    const cantidad = document.querySelector('#productoForm input[placeholder="Cantidad"]').value;
    const descuento = document.querySelector('#productoForm input[placeholder="Descuento"]').value;
    
    if (!nombreProducto || !precio || !cantidad) {
        alert('Por favor, complete los campos obligatorios.');
        return;
    }
    
    const total = (cantidad * precio) - descuento;
    
    const producto = {
        nombre: nombreProducto,
        dosis,
        presentacion,
        unidad,
        precio,
        cantidad,
        descuento,
        total
    };

    carrito.push(producto);
    actualizarContador();
    alert('Producto agregado al carrito.');
}

// Función para actualizar el contador del carrito
function actualizarContador() {
    document.getElementById('contadorCarrito').textContent = carrito.length;
}

// Función para mostrar el carrito (futuro desarrollo)
function mostrarCarrito() {
    console.log('Mostrar carrito:', carrito);
    alert('Carrito: ' + JSON.stringify(carrito, null, 2));
}

// Event Listener para el botón de agregar al carrito
document.querySelector('#productoForm button').addEventListener('click', agregarAlCarrito);
