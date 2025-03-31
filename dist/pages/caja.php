<?php
include_once "Ctrl/head.php";
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

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Proveedor</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Menu
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div> <!--end::App Content Header--> <!--begin::App Content-->





        <!--ESTILOS DE CAJA-->
        <style>
            .contenedor {
                max-width: 1200px;
                margin: 20px auto;
                padding: 40px;
                background: #ffff;
                border-radius: 10px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                position: relative;
                min-height: 700px;
            }

            .row {
                margin: 0 -10px;
            }

            .col-md-5,
            .col-md-2 {
                padding: 0 55px;
            }

            .form-control,
            .form-select {
                margin-bottom: 15px;
            }

            .carrito-container {
                position: absolute;
                top: 20px;
                right: 20px;
                display: flex;
                align-items: center;
            }

            .carrito-icono {
                background-color: #007bff;
                color: white;
                padding: 10px;
                border-radius: 50%;
                cursor: pointer;
                font-size: 1.5rem;
                margin-left: 10px;
            }

            .carrito-contenedor {
                background-color: red;
                color: white;
                padding: 5px 10px;
                border-radius: 50%;
                font-size: 1rem;
                font-weight: bold;
            }

            #btnAgregar {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-35%);
                width: auto;
            }

            /* Cuadro para la imagen del producto */
            .img-container {
                width: 200px;
                /* Ajusta el tamaño del cuadro */
                height: 200px;
                border: 2px dashed #ccc;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                text-align: center;
                padding: 10px;
            }

            .img-container img {
                max-width: 100%;
                max-height: 80%;
                object-fit: contain;
            }

            #imagenProducto {
                width: 95%;
                height: auto;
                /* Mantiene la proporción de la imagen */
                object-fit: cover;
                /* Asegura que la imagen cubra el espacio sin distorsionarse */
                display: block;
                /* Elimina los márgenes y paddings que puedan haber */
                margin: 0 auto;
                /* Centra la imagen dentro de su contenedor */
            }


            .modal-dialog {
                max-width: 80%;
                /* Limita el tamaño máximo del modal */
            }


            /* Ajustar el tamaño de los inputs "Requiere Receta" y "Vencimiento" */
            .extra-inputs {
                width: 200px;
                /* Mismo ancho que el cuadro de la imagen */
            }

            .requiere-receta-advertencia {
                background-color: #ffcccc;
                /* Fondo rojo claro para advertencia */
                color: #a94442;
                /* Color del texto en rojo oscuro */
                border: 1px solid #a94442;
                /* Borde rojo oscuro */
            }
        </style>

        <!-- CONTENEDOR DE CAJA -->
        <div class="contenedor">
            <div class="d-flex justify-content-between align-items-center">
                <div class="carrito-container">
                    <div class="carrito-contenedor" id="contadorCarrito">0</div>
                    <div class="carrito-icono" onclick="mostrarCarrito()">🛒</div>
                </div>
            </div>

            <div class="row">
                <!-- Sección de productos -->
                <div class="col-md-5">
                    <h4>Buscar Producto</h4>

                    <!-- Botón con ícono de búsqueda para abrir el cuadro de búsqueda de producto -->
                    <button type="button" id="btnBuscarProducto" class="btn btn-info form-control">
                        <i class="fas fa-search"></i> Buscar Producto
                    </button>

                    <label>Nombre del Producto</label>
                    <input type="text" id="nombreProducto" class="form-control" readonly> <!-- Campo para mostrar el nombre del producto -->

                    <label>Laboratorio o Marca</label>
                    <input type="text" id="laboratorio" class="form-control" readonly> <!-- Campo no editable -->

                    <label>Dosis</label>
                    <select id="dosis" class="form-select">
                        <option>Seleccione Dosis</option>
                    </select>

                    <label>Presentación</label>
                    <select id="presentacion" class="form-select">
                        <option>Seleccione Presentación</option>
                    </select>

                    <label>Formato del producto</label>
                    <select id="unidad" class="form-select">
                        <option>Seleccione Unidad</option>
                    </select>

                    <label>Precio</label>
                    <input type="text" id="precio" class="form-control" readonly> <!-- Campo no editable -->

                    <label>Cantidad</label>
                    <input type="number" id="cantidad" class="form-control">
                </div>

                <!-- Sección de imagen y detalles adicionales -->
                <div class="col-md-2 d-flex flex-column align-items-center">
                    <div class="img-container">
                        <img id="imagenProducto" src="default.jpg" alt="Imagen del producto">
                    </div>
                    <label>Requiere Receta</label>
                    <input type="text" id="requiereReceta" class="form-control extra-inputs" readonly> <!-- Campo no editable -->

                    <label>Vencimiento</label>
                    <input type="text" id="vencimiento" class="form-control extra-inputs" readonly> <!-- Campo solo para mostrar la fecha -->

                    <label>Descripcion</label>
                    <textarea id="descripcion" class="form-control extra-inputs" readonly></textarea> <!-- Campo no editable -->

                    <label>Descuento</label>
                    <input type="text" id="descuento" class="form-control extra-inputs">
                </div>

                <!-- Sección de clientes -->
                <div class="col-md-5">
                    <h4>Buscar Cliente</h4>

                    <!-- Botón con ícono de búsqueda para abrir el cuadro de búsqueda de cliente -->
                    <button type="button" id="btnBuscarCliente" class="btn btn-info form-control" onclick="abrirBusquedaCliente()">
                        <i class="fas fa-search"></i> Buscar Cliente
                    </button>

                    <label>Nombre del Cliente</label>
                    <input type="text" id="nombreCliente" class="form-control" readonly>

                    <label>Cédula</label>
                    <input type="text" id="cedulaCliente" class="form-control" readonly>

                    <label>Sexo</label>
                    <input type="text" id="generoCliente" class="form-control" readonly>

                    <label>Teléfono</label>
                    <input type="text" id="telefonoCliente" class="form-control">

                    <label>Dirección</label>
                    <textarea id="direccionCliente" class="form-control"></textarea>
                </div>
            </div>

            <!-- Botón de agregar al carrito -->
            <button class="btn btn-primary d-block mx-auto mt-4" id="btnAgregar">Agregar al Carrito</button>
        </div>



        <script>
            $(document).ready(function() {
                // Inicializar DataTable en la tabla con el id "tablaProducto"
                $('#tablaProducto, #clientesTable').DataTable();
            });
        </script>


        <!-- Modal para buscar productos -->
        <div class="modal fade" id="modalBusquedaProducto" tabindex="-1" aria-labelledby="modalBusquedaProductoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBusquedaProductoLabel">Buscar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="tablaProducto" class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Laboratorio o Marca</th>
                                    <th>Dosis</th>
                                    <th>Presentaciones</th>
                                    <th>Formato del producto</th> <!-- Nueva columna -->
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Los productos se llenarán aquí dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para buscar cliente -->
        <div class="modal fade" id="clientesModal" tabindex="-1" aria-labelledby="clientesModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clientesModalLabel">Seleccionar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="clientesTable" class="table table-striped table-dark">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Cédula</th>
                                    <th>Género</th>
                                    <th>Teléfono</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody id="clientesTableBody">
                                <!-- Los datos de los clientes se cargarán aquí -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>




        <script src="../js/carrito_caja.js?2345"></script>
        <script src="../js/medicamento.js?12345"></script>
        <script src="../js/seleccionar_medicamento.js?12345"></script>
        <script src="../js/buscar_cliente.js?12345"></script>

        <?php

        include_once "Ctrl/footer.php";
        ?>