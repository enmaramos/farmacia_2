<?php
include_once "Ctrl/head.php";
?>

<?php
include('../pages/Cnx/conexion.php');

// Definir el estado por defecto (vacío significa mostrar todos)
$estadoFiltro = isset($_GET['estado']) ? $_GET['estado'] : '1'; // Por defecto, mostrar solo activos

// Consulta dependiendo del estado seleccionado
if ($estadoFiltro == '1') {
    // Clientes activos
    $query = "SELECT * FROM clientes WHERE Estado = 1";
} elseif ($estadoFiltro == '0') {
    // Mostrar todos los clientes inactivos
    $query = "SELECT * FROM clientes WHERE Estado = 0";
} else {
    // Clientes activos e inactivos (por si alguien introduce algo inesperado)
    $query = "SELECT * FROM clientes";
}

$result = $conn->query($query);
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
                $('#clientesTable').DataTable();
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

        <!-- TABLA DE Clientes -->
        <div class="container">
            <div class="card p-3 shadow-sm">
                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">
                        <i class="fas fa-user-plus"></i> Agregar
                    </button>
                    <h3 class="text-center flex-grow-1">Lista de Clientes</h3>
                </div>

                <!-- Filtro de Estado -->
                <div class="mb-3">
                    <select id="filtroEstado" class="form-select w-auto" onchange="filtrarEstado()">
                        <option value="1" <?php if ($estadoFiltro == '1') echo 'selected'; ?>>Activos</option>
                        <option value="0" <?php if ($estadoFiltro == '0') echo 'selected'; ?>>Inactivos</option>
                    </select>
                </div>

                <table id="clientesTable" class="display text-center">
                    <thead>
                        <tr>
                            <th>Clientes</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <?php if ($estadoFiltro == 1) { ?>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            <?php } ?>
                            <?php if ($estadoFiltro == 0) { ?>
                                <th>Activar</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) {
                            // Cortar el primer nombre y primer apellido
                            $primerNombre = explode(' ', trim($row['Nombre']))[0];
                            $primerApellido = explode(' ', trim($row['Apellido']))[0];
                            $nombreCompleto = $primerNombre . ' ' . $primerApellido;
                        ?>
                            <tr class="clientes" data-estado="<?= $row['Estado'] ?>">
                                <td><?= htmlspecialchars($nombreCompleto) ?></td>
                                <td><?= htmlspecialchars($row['Genero']) ?></td>
                                <td><?= htmlspecialchars($row['Direccion']) ?></td>
                                <td>+(505) <?= htmlspecialchars($row['Telefono']) ?></td>
                                <td>
                                    <?php if ($row['Estado'] == 1): ?>
                                        <span class='badge bg-success'>Activo</span>
                                    <?php else: ?>
                                        <span class='badge bg-danger'>Inactivo</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Botón Ver -->
                                <td>
                                    <button class='btn btn-success VerClientesBtn btn-sm' data-bs-toggle='modal' data-bs-target='#modalVerClientes' data-id='<?= $row['ID_Cliente'] ?>' title="Ver Detalles">
                                        <i class='fas fa-eye'></i>
                                    </button>
                                </td>

                                <?php if ($estadoFiltro == 1) { ?>
                                    <!-- Botón Editar -->
                                    <td>
                                        <a href='' class='btn btn-warning editarClientesBtn btn-sm' data-bs-toggle='modal' data-bs-target='#modalEditarClientes' data-id='<?= $row['ID_Cliente'] ?>' title="Editar Clientes">
                                            <i class='fas fa-edit'></i>
                                        </a>
                                    </td>
                                    <!-- Botón Eliminar -->
                                    <td>
                                        <button class='btn btn-danger eliminarClientesBtn btn-sm' data-id='<?= $row['ID_Cliente'] ?>' title="Eliminar Cliente">
                                            <i class='fas fa-trash-alt'></i>
                                        </button>
                                    </td>
                                <?php } ?>

                                <?php if ($estadoFiltro == 0) { ?>
                                    <!-- Botón Activar -->
                                    <td>
                                        <button class='btn btn-primary activarClientesBtn btn-sm' data-id='<?= $row['ID_Cliente'] ?>' title="Reactivar Cliente">
                                            <i class="fas fa-user-check"></i>
                                        </button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            // Función para recargar la página con el filtro aplicado
            function filtrarEstado() {
                var estado = document.getElementById('filtroEstado').value;
                window.location.href = 'cliente.php?estado=' + estado; // Recargar la página con el filtro en la URL
            }
        </script>


        <!-- Modal para agregar cliente en el archivo Cliente.php -->
        <div class="modal fade" id="modalAgregarCliente" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="../pages/Ctrl/agregar_cliente.php" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Agregar Cliente</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Nombre -->
                            <div class="mb-3">
                                <label for="nombreCliente" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombreCliente" id="nombreCliente" placeholder="Ingrese el primer y segundo nombre" required>
                            </div>

                            <!-- Apellido -->
                            <div class="mb-3">
                                <label for="apellidoCliente" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellidoCliente" id="apellidoCliente" placeholder="Ingrese el primer y segundo apellido" required>
                            </div>

                            <!-- Cédula -->
                            <div class="mb-3">
                                <label for="cedulaCliente" class="form-label">Cédula</label>
                                <input type="text" class="form-control" name="cedulaCliente" id="cedulaCliente" placeholder="000-000000-0000X" pattern="[0-9]{3}-[0-9]{6}-[0-9]{4}[A-Z]{1}" title="Formato: 000-000000-0000X" required>
                            </div>

                            <!-- Género -->
                            <div class="mb-3">
                                <label for="generoCliente" class="form-label">Género</label>
                                <select class="form-select" name="generoCliente" id="generoCliente" required>
                                    <option value="">Seleccione género</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>
                                </select>
                            </div>

                            <!-- Dirección -->
                            <div class="mb-3">
                                <label for="direccionCliente" class="form-label">Dirección</label>
                                <input type="text" class="form-control" name="direccionCliente" id="direccionCliente" placeholder="Ingrese dirección" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="mb-3">
                                <label for="telefonoCliente" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" name="telefonoCliente" id="telefonoCliente" placeholder="8888-8888" pattern="[0-9]{4}-[0-9]{4}" title="Formato: 8888-8888" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="emailCliente" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="emailCliente" id="emailCliente" placeholder="ejemplo@correo.com" required>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cliente</button>
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

        

        <?php
        $conn->close();
        ?>





        <?php

        include_once "Ctrl/footer.php";
        ?>