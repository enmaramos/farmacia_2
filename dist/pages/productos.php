<?php
include_once "Ctrl/head.php";
?>

<?php
include('../pages/Cnx/conexion.php');

$queryCategorias = "SELECT ID_Categoria, Nombre_Categoria FROM categoria";
$resultCategorias = $conn->query($queryCategorias);

$queryProveedores = "SELECT ID_Proveedor, Nombre FROM proveedor";
$resultProveedores = $conn->query($queryProveedores);

// Definir el estado por defecto (vacío significa mostrar todos)
$estadoFiltro = isset($_GET['estado']) ? $_GET['estado'] : '1'; // Por defecto, mostrar solo activos

$sql = "SELECT DISTINCT Forma_Farmaceutica FROM medicamento_forma_farmaceutica";
$resultado_formas = $conn->query($sql);

// Validar errores en la consulta
if (!$resultado_formas) {
    die("Error en la consulta: " . $conn->error);
}

// Consulta dependiendo del estado seleccionado
if ($estadoFiltro == '1') {
    // Vendedores activos
    $query = "SELECT * FROM medicamento WHERE Estado = 1";
} elseif ($estadoFiltro == '0') {
    // Mostrar todos los vendedores inactivos
    $query = "SELECT * FROM medicamento WHERE Estado = 0";
} else {
    // Vendedores activos e inactivos (por si alguien introduce algo inesperado)
    $query = "SELECT * FROM medicamento";
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
                            <li class="breadcrumb-item"><a href="#">Medicamentos</a></li>
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
                $('#medicamentoTable').DataTable();
            });
        </script>

<!-- TABLA DE PRODUCTOS --> 
<div class="container">
    <div class="card p-3 shadow-sm">
        <div class="d-flex justify-content-between mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAgregarMedicamento">
                <i class="fas fa-user-plus"></i> Agregar Nuevo Medicamento
            </button>
            <h3 class="text-center flex-grow-1">Lista de Medicamentos</h3>
        </div>

        <!-- Filtro de Estado -->
        <div class="mb-3">
            <select id="filtroEstado" class="form-select w-auto" onchange="filtrarEstado()">
                <option value="1" <?php if ($estadoFiltro == '1') echo 'selected'; ?>>Activos</option>
                <option value="0" <?php if ($estadoFiltro == '0') echo 'selected'; ?>>Inactivos</option>
            </select>
        </div>

        <div class="table-responsive">
        <table id="medicamentoTable" class="display text-center table">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>LAB/MARCA</th>
                    <th>Imagen</th>
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
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr class="medicamento" data-estado="<?= $row['Estado'] ?>">
                        <td><?= $row['ID_Medicamento'] ?></td>
                        <td><?= $row['Nombre_Medicamento'] ?></td>
                        <td><?= $row['LAB_o_MARCA'] ?></td>
                        <td>
                            <?php 
                                $directorio = "../../dist/assets/img/";
                                $nombreImagen = pathinfo($row['Imagen'], PATHINFO_FILENAME); // Extrae el nombre sin extensión
                                $formatos = ['jpg', 'png', 'jpeg', 'gif', 'webp']; // Lista de formatos soportados
                                $rutaImagen = $directorio . "default.jpg"; // Imagen por defecto

                                // Buscar la imagen en los formatos disponibles
                                foreach ($formatos as $ext) {
                                    if (file_exists($directorio . $nombreImagen . "." . $ext)) {
                                        $rutaImagen = $directorio . $nombreImagen . "." . $ext;
                                        break;
                                    }
                                }
                            ?>
                            <img src="<?= $rutaImagen ?>" class="rounded" width="60" height="60" alt="Imagen del Medicamento">
                        </td>
                        <td>
                            <?php
                            if ($row['Estado'] == 1) {
                                echo "<span class='badge bg-success'>Activo</span>";
                            } else {
                                echo "<span class='badge bg-danger'>Inactivo</span>";
                            }
                            ?>
                        </td>
                        <!-- Botón Ver -->
                        <td>
                            <button class='btn btn-success VerMedicamentoBtn btn-sm' data-bs-toggle='modal' data-bs-target='#modalVerMedicamento' data-id='<?= $row['ID_Medicamento'] ?>' title="Ver Detalles">
                                <i class='fas fa-eye'></i>
                            </button>
                        </td>
                        <?php if ($estadoFiltro == 1) { ?>
                            <!-- Botón Editar (solo para activos) -->
                            <td>
                                <a href='' class='btn btn-warning editarMedicamentoBtn btn-sm ' data-bs-toggle='modal' data-bs-target='#modalEditarMedicamento' data-id='<?= $row['ID_Medicamento'] ?>' title="Editar Medicamento">
                                    <i class='fas fa-edit'></i>
                                </a>
                            </td>
                            <!-- Botón Eliminar (solo para activos) -->
                            <td>
                                <button class='btn btn-danger eliminarMedicamentoBtn btn-sm' data-id='<?= $row['ID_Medicamento'] ?>' title="Eliminar Medicamento">
                                    <i class='fas fa-trash-alt'></i>
                                </button>
                            </td>
                        <?php } ?>
                        <?php if ($estadoFiltro == 0) { ?>
                            <!-- Botón Activar (solo para inactivos) -->
                            <td>
                                <button class='btn btn-primary activarMedicamentoBtn btn-sm' data-id='<?= $row['ID_Medicamento'] ?>' title="Reactivar Medicamento">
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
</div>

<script>
    // Función para recargar la página con el filtro aplicado
    function filtrarEstado() {
        var estado = document.getElementById('filtroEstado').value;
        window.location.href = 'productos.php?estado=' + estado; // Recargar la página con el filtro en la URL
    }
</script>


     <!-- Modal para agregar medicamento -->
<div class="modal fade" id="modalAgregarMedicamento" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Agregar Medicamento Completo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <form action="../pages/Ctrl/agregar_medicamento_completo.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3" id="medicamentoTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="medicamento-tab" data-bs-toggle="tab" data-bs-target="#medicamento" type="button">Medicamento</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="lote-tab" data-bs-toggle="tab" data-bs-target="#lote" type="button">Lote</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="forma-tab" data-bs-toggle="tab" data-bs-target="#forma" type="button">Forma Farmacéutica</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="presentacion-tab" data-bs-toggle="tab" data-bs-target="#presentacion" type="button">Presentación</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dosis-tab" data-bs-toggle="tab" data-bs-target="#dosis" type="button">Dosis</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="medicamentoTabsContent">
                        <!-- Medicamento -->
                        <div class="tab-pane fade show active" id="medicamento" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="imagenMedicamento" class="form-label">Imagen</label>
                                    <input type="file" class="form-control" name="imagenMedicamento" id="imagenMedicamento" onchange="previewImage(event)" required>
                                    <img id="imagePreview" class="mt-2 border rounded shadow-sm" style="max-width: 100%; display: none;">
                                </div>
                                <div class="col-md-8">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label for="nombreMedicamento" class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombreMedicamento" id="nombreMedicamento" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="marcaMedicamento" class="form-label">Laboratorio / Marca</label>
                                            <input type="text" class="form-control" name="marcaMedicamento" id="marcaMedicamento" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="descripcionMedicamento" class="form-label">Descripción</label>
                                            <input type="text" class="form-control" name="descripcionMedicamento" id="descripcionMedicamento" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="prescripcionMedicamento" class="form-label">Prescripción Médica</label>
                                            <input type="text" class="form-control" name="prescripcionMedicamento" id="prescripcionMedicamento" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="requiereReceta" class="form-label">¿Requiere Receta?</label>
                                            <select class="form-control" name="requiereReceta" id="requiereReceta" required>
                                                <option value="1">Sí</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="idCategoria" class="form-label">Categoría</label>
                                            <select class="form-control" name="idCategoria" id="idCategoria" required>
                                                <option value="">Seleccione una categoría</option>
                                                <?php while ($row = $resultCategorias->fetch_assoc()) {
                                                    echo "<option value='" . $row['ID_Categoria'] . "'>" . $row['Nombre_Categoria'] . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="idProveedor" class="form-label">Proveedor</label>
                                            <select class="form-control" name="idProveedor" id="idProveedor" required>
                                                <option value="">Seleccione un proveedor</option>
                                                <?php while ($row = $resultProveedores->fetch_assoc()) {
                                                    echo "<option value='" . $row['ID_Proveedor'] . "'>" . $row['Nombre_Proveedor'] . "</option>";
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lote -->
                        <div class="tab-pane fade" id="lote" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="descripcionLote" class="form-label">Descripción del Lote</label>
                                    <input type="text" class="form-control" name="descripcionLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="estadoLote" class="form-label">Estado</label>
                                    <input type="text" class="form-control" name="estadoLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="cantidadLote" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" name="cantidadLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaFabricacionLote" class="form-label">Fecha de Fabricación</label>
                                    <input type="datetime-local" class="form-control" name="fechaFabricacionLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaCaducidadLote" class="form-label">Fecha de Caducidad</label>
                                    <input type="datetime-local" class="form-control" name="fechaCaducidadLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaEmisionLote" class="form-label">Fecha de Emisión</label>
                                    <input type="datetime-local" class="form-control" name="fechaEmisionLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="fechaRecibidoLote" class="form-label">Fecha de Recepción</label>
                                    <input type="datetime-local" class="form-control" name="fechaRecibidoLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="precioUnidadLote" class="form-label">Precio por Unidad</label>
                                    <input type="number" class="form-control" step="0.01" name="precioUnidadLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="precioTotalLote" class="form-label">Precio Total</label>
                                    <input type="number" class="form-control" step="0.01" name="precioTotalLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="stockMinimoLote" class="form-label">Stock Mínimo</label>
                                    <input type="number" class="form-control" name="stockMinimoLote" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="stockMaximoLote" class="form-label">Stock Máximo</label>
                                    <input type="number" class="form-control" name="stockMaximoLote" required>
                                </div>
                            </div>
                        </div>

                      <!-- Pestaña FORMAS FARMACÉUTICAS -->
<div class="tab-pane fade" id="forma" role="tabpanel">
    <div class="form-group p-3">
        <label><strong>Selecciona las formas farmacéuticas:</strong></label>

        <div style="display: flex; flex-wrap: wrap; gap: 12px; padding-top: 8px;">
            <?php
            if (isset($resultado_formas) && $resultado_formas->num_rows > 0) {
                while ($row = $resultado_formas->fetch_assoc()) {
                    $forma = htmlspecialchars($row['Forma_Farmaceutica']);
                    echo '<label style="display: flex; align-items: center; gap: 6px;">';
                    echo '  <input type="checkbox" name="formas_farmaceuticas[]" value="' . $forma . '" />';
                    echo '  ' . $forma;
                    echo '</label>';
                }
            } else {
                echo "<p>No hay formas farmacéuticas registradas.</p>";
            }
            ?>
        </div>
    </div>
</div>






                        <!-- Presentación -->
                        <div class="tab-pane fade" id="presentacion" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="tipoPresentacion" class="form-label">Tipo</label>
                                    <input type="text" class="form-control" name="tipoPresentacion" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="totalPresentacion" class="form-label">Total</label>
                                    <input type="number" class="form-control" name="totalPresentacion" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="precioPresentacion" class="form-label">Precio</label>
                                    <input type="number" class="form-control" name="precioPresentacion" step="0.01" required>
                                </div>
                            </div>
                        </div>

                        <!-- Dosis -->
                        <div class="tab-pane fade" id="dosis" role="tabpanel">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="dosisMedicamento" class="form-label">Dosis</label>
                                    <input type="text" class="form-control" name="dosisMedicamento" placeholder="Ej: 500mg, 10ml" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar Medicamento Completo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Función para mostrar la vista previa de la imagen seleccionada
function previewImage(event) {
    var input = event.target;
    var file = input.files[0];

    // Verificar si se seleccionó un archivo
    if (file) {
        var reader = new FileReader();

        reader.onload = function(e) {
            // Establecer la imagen de la vista previa
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block'; // Mostrar la imagen
        };

        // Leer la imagen seleccionada
        reader.readAsDataURL(file);
    } else {
        var imagePreview = document.getElementById('imagePreview');
        imagePreview.style.display = 'none'; // Si no hay archivo, ocultar la vista previa
    }
}

</script>


<!-- Validaciones de los Modales -->
<script>
document.addEventListener("DOMContentLoaded", function() { 
    function configurarModal(modalId, formularioId, cancelarClass) {
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
    }

    // Configurar modales para agregar y editar medicamentos
    configurarModal("modalAgregarMedicamento", "formAgregarMedicamento", ".btn-secundario");
    configurarModal("modalEditarMedicamento", "formEditarMedicamento", ".btn-secondary");

    // Verificar si el modal debe abrirse después de un error
    if (sessionStorage.getItem("modalOpen") === "true") { 
        var modalBootstrap = new bootstrap.Modal(document.getElementById("modalEditarMedicamento")); 
        modalBootstrap.show(); 
        sessionStorage.removeItem("modalOpen"); 
    }
});
</script>





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




        <script src="../js/editar_vendedor.js?123456"></script>
        <script src="../js/baja_vendedor.js?1234"></script>
        <script src="../js/ver_vendedor.js?12345"></script>
        <script src="../js/reactivar_vendedor.js?12345"></script>
        
        <?php
        $conn->close();
        ?>





        <?php

        include_once "Ctrl/footer.php";
        ?>