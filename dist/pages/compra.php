<?php
include_once "Ctrl/head.php";
?>

<?php
include('../pages/Cnx/conexion.php');

?>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                    <!--- <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Home</a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="#" class="nav-link">Contact</a> </li>-->
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->

                    <!----ICONO DE LUP   <li class="nav-item"> <a class="nav-link" data-widget="navbar-search" href="#" role="button"> <i class="bi bi-search"></i> </a> </li> --->





                    <!--MENU DE USUARIO  PARTE SUPERRIOR ALA DERECHA -->

                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin:: menu desplegable del usuario-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="../../dist/assets/img/user2-160x160.jpg" class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline">Alexander Pierce</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="../../dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    Alexander Pierce - Web Developer

                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->
                            <li class="user-body"> <!--begin::Row-->
                                <!-----  <div class="row">
                                    <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                                    <div class="col-4 text-center"> <a href="#">Ventas</a> </div>
                                    <div class="col-4 text-center"> <a href="#">Friends</a> </div>
                                </div> ---> <!--end::Row-->

                            </li> <!--end::Menu Body--> <!--begin::Menu Footer-->
                            <li class="user-footer"> <a href="#" class="btn btn-default btn-flat"><!---Prefil--></a> <a href="#" id="btnCerrarSesion" class="btn btn-default btn-flat float-end">Cerrar sesión</a>
                                <!--end::Menu Footer-->

                                <!--MENU DE USUARIO  PARTE SUPERRIOR ALA DERECHA -->

                        </ul>
                    </li> <!--end::User Menu Dropdown-->

                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->


        <?php
        include_once "Ctrl/menu.php";
        ?>

        </ul> <!--end::Sidebar Menu-->
        </nav>
    </div> <!--end::Sidebar Wrapper-->
    </aside> <!--end::Sidebar--> <!--begin::App Main-->
    <main class="app-main"> <!--begin::App Content Header-->
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <!-- <h3 class="mb-0">Vendedores</h3> -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Menu
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->

        <!---table JQUERY -->
        <script>
            $(document).ready(function() {
                $('#vendedoresTable').DataTable();
            });
        </script>

<?php
$error = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]); // Elimina espacios en blanco

    if (empty($email)) {
        $error = "El campo de correo es obligatorio.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El correo ingresado no es válido.";
    } else {
        $error = "Correo válido: " . htmlspecialchars($email);
    }
}
?>
<div class="container-fluid bg-white p-4 rounded shadow">
    <h4 class="mb-0">🧾 Registro de Compras</h4>

    <div class="row">
        <!-- SECCIÓN IZQUIERDA -->
        <div class="col-md-8">

            <!-- PRODUCTO -->
            <div class="border rounded p-3 mb-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="text-primary">🧪 Datos del Producto</h5>
                    <!-- Botón para abrir cuadro de búsqueda -->
                    <button type="button" id="btnBuscarProducto" class="btn btn-info">
                        <i class="fas fa-search"></i> Buscar Producto
                    </button>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="nombreMedicamento" readonly>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Laboratorio/Marca:</label>
                        <input type="text" class="form-control" id="marcaMedicamento" readonly>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Imagen:</label>
                        <input type="text" class="form-control" id="imagenMedicamento" readonly>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label>Descripción:</label>
                        <textarea class="form-control" id="descripcionMedicamento" rows="2" readonly></textarea>
                    </div>
                </div>
            </div>

            <!-- LOTE -->
            <div class="border rounded p-3 mb-4 shadow-sm">
                <h5 class="text-primary mb-3">📦 Datos del Lote</h5>

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Descripción del Lote:</label>
                        <input type="text" class="form-control" id="descripcionLote">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Cantidad del Lote:</label>
                        <input type="number" class="form-control bg-warning" id="cantidadLote">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>F. Fabricación:</label>
                        <input type="date" class="form-control" id="fechaFabLote">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>F. Caducidad:</label>
                        <input type="date" class="form-control" id="fechaCadLote">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>F. Recibido:</label>
                        <input type="date" class="form-control" id="fechaRecibidoLote">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Precio por Unidad:</label>
                        <input type="text" class="form-control" id="precioUnidadLote">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Precio Total del Lote:</label>
                        <input type="text" class="form-control" id="precioTotalLote" readonly>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Stock Mín:</label>
                        <input type="number" class="form-control" id="stockMinimo">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label>Stock Máx:</label>
                        <input type="number" class="form-control" id="stockMaximo">
                    </div>
                </div>
            </div>

            <!-- PROVEEDOR -->
            <div class="border rounded p-3 mb-4 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="text-primary">🚚 Datos del Proveedor</h5>
                    <button class="btn btn-sm btn-outline-primary">🔍 Buscar Proveedor</button>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" id="nombreProveedor" readonly>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Teléfono:</label>
                        <input type="text" class="form-control" id="telefonoProveedor" readonly>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Email:</label>
                        <input type="email" class="form-control" id="emailProveedor" readonly>
                    </div>
                </div>
            </div>

        </div>

        <!-- SECCIÓN DERECHA: COMPRA -->
        <div class="col-md-4">
            <div class="border rounded p-3 shadow-sm">
                <h5 class="text-success">💰 Detalles de la Compra</h5>

                <div class="mb-2">
                    <label>Número de Compra:</label>
                    <input type="text" class="form-control" id="numeroCompra">
                </div>
                <div class="mb-2">
                    <label>Estado del Pedido:</label>
                    <input type="text" class="form-control" id="estadoPedido">
                </div>
                <div class="mb-2">
                    <label>Fecha:</label>
                    <input type="date" class="form-control" id="fechaCompra">
                </div>
                <div class="mb-2">
                    <label>Descripción:</label>
                    <textarea class="form-control" id="descripcionCompra" rows="2"></textarea>
                </div>
                <div class="mb-2">
                    <label>Subtotal:</label>
                    <input type="text" class="form-control" id="subtotalCompra">
                </div>
                <div class="mb-2">
                    <label>IVA:</label>
                    <input type="text" class="form-control" id="ivaCompra">
                </div>
                <div class="mb-2">
                    <label>Total:</label>
                    <input type="text" class="form-control" id="totalCompra" readonly>
                </div>
                <div class="mb-2">
                    <label>Cantidad a Comprar:</label>
                    <input type="number" class="form-control" id="cantidadCompra">
                </div>

                <div class="d-grid mt-3">
                    <button class="btn btn-success">💾 Guardar Compra</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para la búsqueda de producto -->
<div class="modal fade" id="modal_medicamento" tabindex="-1" aria-labelledby="modal_medicamentoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_medicamentoLabel">Buscar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <table id="tablaProducto" class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Laboratorio o Marca</th>
                            <th>Descripción</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Productos dinámicos se cargarán aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<script>
    // Función para recargar la página con el filtro aplicado
    function filtrarEstado() {
        var estado = document.getElementById('filtroEstado').value;
        window.location.href = 'vendedor.php?estado=' + estado; // Recargar la página con el filtro en la URL
    }
</script>




        <!-- Modal para agregar vendedor -->
        <div class="modal fade" id="modalAgregarVendedor" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Agregar Vendedor</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../pages/Ctrl/agregar_vendedor.php" method="POST">
                        <div class="modal-body">
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombreVendedor" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreVendedor" id="nombreVendedor" placeholder="Ingrese el primer y segundo nombre " required>
                            </div>

                            <!-- Apellido -->
                            <div class="mb-3">
                                <label for="apellidoVendedor" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellidoVendedor" id="apellidoVendedor" placeholder="Ingrese el primer y segundo apellido" required>
                            </div>

                            <!-- Número de Cédula -->
                            <div class="mb-3">
                                <label for="cedulaVendedor" class="form-label">N° Cédula</label>
                                <input type="text" class="form-control" name="cedulaVendedor" placeholder="000-000000-0000X " id="cedulaVendedor" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefonoVendedor" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" name="telefonoVendedor" id="telefonoVendedor" required>
                            </div>

                            <!-- Dirección -->
                            <div class="mb-3">
                                <label for="direccionVendedor" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccionVendedor" placeholder="Ingrese direccion" id="direccionVendedor" required>
                            </div>

                            <!-- Sexo -->
                            <div class="mb-3">
                                <label for="sexoVendedor" class="form-label">Sexo</label>
                                <select class="form-control" name="sexoVendedor" id="sexoVendedor" required>
                                    <option value="H">Masculino</option>
                                    <option value="M">Femenino</option>
                                </select>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="emailVendedor" class="form-label">Correo electronico</label>
                                <input type="email" class="form-control" name="emailVendedor" value = "<?php echo htmlspecialchars($email); ?>" placeholder="ex: myname@example.com " id="emailVendedor" required>
                            </div>

                            <!-- Rol -->
                            <div class="mb-3">
                                <label for="rolVendedor" class="form-label">Rol</label>
                                <select class="form-control" name="rolVendedor" id="rolVendedor"  required>
                                    <option value="2">Empleado</option>
                                    <option value="1">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Vendedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Validaciones de los Modales -->
        <script>
document.addEventListener("DOMContentLoaded", function() { 
    function configurarModal(modalId, telefonoId, cedulaId, formularioId, cancelarClass) {
        let modal = document.getElementById(modalId);
        let formulario = document.getElementById(formularioId);

        // Resetear formulario al cerrar el modal con la "X" o el botón Cancelar
        modal.addEventListener("hidden.bs.modal", function() { 
            formulario.reset(); 
        });

        let btnCancelar = modal.querySelector(cancelarClass);
        if (btnCancelar) { 
            btnCancelar.addEventListener("click", function() { 
                formulario.reset(); 
            }); 
        }

        // Validación del campo teléfono
        const telefonoInput = document.getElementById(telefonoId);
        telefonoInput.value = "(+505)  "; 

        telefonoInput.addEventListener("input", function() { 
            let valor = telefonoInput.value;

            if (!valor.startsWith("(+505) ")) { 
                telefonoInput.value = "(+505) "; 
                return; 
            }

            let numeros = valor.replace(/\D/g, "").substring(3); 

            if (numeros.length > 8) { 
                numeros = numeros.slice(0, 8); 
            }

            let telefonoFormateado = "(+505) "; 
            if (numeros.length > 4) { 
                telefonoFormateado += numeros.slice(0, 4) + "-" + numeros.slice(4); 
            } else { 
                telefonoFormateado += numeros; 
            }

            telefonoInput.value = telefonoFormateado; 
        });

        telefonoInput.addEventListener("keydown", function(event) { 
            if (telefonoInput.selectionStart < 7 && (event.key === "Backspace" || event.key === "Delete")) { 
                event.preventDefault(); 
            } 
        });

        telefonoInput.addEventListener("blur", function() { 
            if (telefonoInput.value.trim() === "" || telefonoInput.value === "(+505)") { 
                telefonoInput.value = "(+505) "; 
            } 
        });

        // Validación del campo cédula
        const cedulaInput = document.getElementById(cedulaId);

        cedulaInput.addEventListener("input", function() {
            let valor = cedulaInput.value.toUpperCase(); // Convertir a mayúsculas
            let numeros = valor.replace(/\D/g, ""); // Extraer solo números
            let letraFinal = valor.match(/[A-Z]$/) ? valor.match(/[A-Z]$/)[0] : ""; // Extraer la última letra si es mayúscula

            // Evitar que el usuario escriba letras antes de los números
            if (valor.length > 0 && valor[0].match(/[A-Z]/)) {
                cedulaInput.value = "";
                return;
            }

            // Limitar a los primeros 15 números
            if (numeros.length > 15) {
                numeros = numeros.slice(0, 15);
            }

            // Aplicar el formato ###-######-###X
            let cedulaFormateada = "";
            if (numeros.length > 3) {
                cedulaFormateada += numeros.slice(0, 3) + "-";
                if (numeros.length > 9) {
                    cedulaFormateada += numeros.slice(3, 9) + "-";
                    cedulaFormateada += numeros.slice(9);
                } else {
                    cedulaFormateada += numeros.slice(3);
                }
            } else {
                cedulaFormateada += numeros;
            }

            // Agregar la última letra si ya está presente
            if (letraFinal) {
                cedulaFormateada += letraFinal;
            }

            cedulaInput.value = cedulaFormateada;
        });

        // Evitar caracteres incorrectos al escribir
        cedulaInput.addEventListener("keydown", function(event) {
            let valor = cedulaInput.value;

            // Permitir Backspace, Delete y teclas de navegación
            if (["Backspace", "Delete", "ArrowLeft", "ArrowRight", "Tab"].includes(event.key)) {
                return;
            }

            // No permitir más de 16 caracteres
            if (valor.length >= 16) {
                event.preventDefault();
                return;
            }

            // Evitar letras antes de los números
            if (valor.length === 0 && event.key.match(/[A-Za-z]/)) {
                event.preventDefault();
            }

            // Evitar números en la última posición
            if (valor.length === 15 && event.key.match(/\d/)) {
                event.preventDefault();
            }
        });
    }

    // Configurar ambos modales
    configurarModal("modalAgregarVendedor", "telefonoVendedor", "cedulaVendedor", "formAgregarVendedor", ".btn-secundario");
    configurarModal("modalEditarVendedor", "editarTelefonoVendedor", "editarCedulaVendedor", "formEditarVendedor", ".btn-secondary");

    // Verificar si el modal debe abrirse después de un error
    if (sessionStorage.getItem("modalOpen") === "true") { 
        var modalBootstrap = new bootstrap.Modal(document.getElementById("modalEditarVendedor")); 
        modalBootstrap.show(); 
        sessionStorage.removeItem("modalOpen"); 
    }
});


</script>


    <!-- Modal para editar vendedor -->
<div class="modal fade" id="modalEditarVendedor" tabindex="-1" aria-labelledby="modalLabelEditar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelEditar">Editar Vendedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditarVendedor">
                <div class="modal-body">
                    <input type="hidden" name="idVendedor" id="idVendedor">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="editarNombreVendedor" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="editarNombreVendedor" placeholder="Ingrese el primer y segundo nombre "   id="editarNombreVendedor" required>
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label for="editarApellidoVendedor" class="form-label">Apellido</label>
                        <input type="text" class="form-control" name="editarApellidoVendedor" placeholder= "Ingrese el primery segundo apellido" id="editarApellidoVendedor" required>
                    </div>

                    <!-- Número de Cédula -->
                    <div class="mb-3">
                        <label for="editarCedulaVendedor" class="form-label">N° Cédula</label>
                        <input type="text" class="form-control" name="editarCedulaVendedor" placeholder="000-000000-0000X"  id="editarCedulaVendedor" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <label for="editarTelefonoVendedor" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="editarTelefonoVendedor" id="editarTelefonoVendedor">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="editarDireccionVendedor" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="editarDireccionVendedor" placeholder="Ingrese su direccion" id="editarDireccionVendedor">
                    </div>

                    <!-- Sexo -->
                    <div class="mb-3">
                        <label for="editarSexoVendedor" class="form-label">Sexo</label>
                        <select class="form-control" name="editarSexoVendedor" id="editarSexoVendedor" required>
                            <option value="H">Masculino</option>
                            <option value="M">Femenino</option>
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="editarCorreoVendedor" class="form-label">Correo electronico</label>
                        <input type="email" class="form-control" name="editarCorreoVendedor" placeholder ="ex: myname@example.com" id="editarCorreoVendedor" required>
                    </div>

                    <!-- Rol -->
                    <div class="mb-3">
                        <label for="editarRolVendedor" class="form-label">Rol</label>
                        <select class="form-control" name="editarRolVendedor" id="editarRolVendedor" required>
                            <option value="2">Empleado</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal para ver vendedor -->
<div class="modal fade" id="modalVerVendedor" tabindex="-1" aria-labelledby="modalVerVendedorLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerVendedorLabel">Ver Vendedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombreVendedorVer" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreVendedorVer" disabled>
                </div>

                <!-- Apellido -->
                <div class="mb-3">
                    <label for="apellidoVendedorVer" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellidoVendedorVer" disabled>
                </div>

                <!-- Número de Cédula -->
                <div class="mb-3">
                    <label for="cedulaVendedorVer" class="form-label">N° Cédula</label>
                    <input type="text" class="form-control" id="cedulaVendedorVer" disabled>
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="telefonoVendedorVer" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoVendedorVer" disabled>
                </div>

                <!-- Dirección -->
                <div class="mb-3">
                    <label for="direccionVendedorVer" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccionVendedorVer" disabled>
                </div>

                <!-- Sexo -->
                <div class="mb-3">
                    <label for="sexoVendedorVer" class="form-label">Sexo</label>
                    <input type="text" class="form-control" id="sexoVendedorVer" disabled>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="emailVendedorVer" class="form-label">Correo electronico</label>
                    <input type="email" class="form-control" id="emailVendedorVer" disabled>
                </div>

                <!-- Rol -->
                <div class="mb-3">
                    <label for="rolVendedorVer" class="form-label">Rol</label>
                    <input type="text" class="form-control" id="rolVendedorVer" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>





<script src="../js/seleccionar_medicamento_y_lote.js?12345"></script>

       





        <?php

        include_once "Ctrl/footer.php";
        ?>