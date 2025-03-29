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

            /* Ajustar el tamaño de los inputs "Requiere Receta" y "Vencimiento" */
            .extra-inputs {
                width: 200px;
                /* Mismo ancho que el cuadro de la imagen */
            }
        </style>

        <!--CONTENEDOR DE CAJA-->
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
                    <label>Producto</label>
                    <input type="text" class="form-control" placeholder="Nombre del producto">
                    <label>Laboratorio o Marca</label>
                    <input type="text" class="form-control" placeholder="Nombre del laboratorio">
                    <label>Dosis</label>
                    <select class="form-select">
                        <option>Seleccione Dosis</option>
                    </select>
                    <label>Presentación</label>
                    <select class="form-select">
                        <option>Seleccione Presentación</option>
                    </select>
                    <label>Unidad</label>
                    <select class="form-select">
                        <option>Seleccione Unidad</option>
                    </select>
                    <label>Precio</label>
                    <input type="text" class="form-control">
                    <label>Cantidad</label>
                    <input type="number" class="form-control">
                    <label>Descuento</label>
                    <input type="text" class="form-control">
                </div>

                <!-- Sección de imagen y detalles adicionales -->
                <div class="col-md-2 d-flex flex-column align-items-center">
                    <div class="img-container">
                        <img id="imagenProducto" src="" alt="Imagen del producto">
                    </div>
                    <label>Requiere Receta</label>
                    <input type="text" class="form-control extra-inputs">
                    <label>Vencimiento</label>
                    <input type="date" class="form-control extra-inputs">
                    <label>Descripcion</label>
                    <textarea class="form-control extra-inputs"></textarea>
                </div>

                <!-- Sección de clientes -->
                <div class="col-md-5">
                    <h4>Buscar Cliente</h4>
                    <label>Cliente</label>
                    <input type="text" class="form-control" placeholder="Nombre del cliente">
                    <label>Teléfono</label>
                    <input type="text" class="form-control">
                    <label>Dirección</label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>

            <!-- Botón de agregar al carrito -->
            <button class="btn btn-primary d-block mx-auto mt-4" id="btnAgregar">Agregar al Carrito</button>
        </div>









        <script src="../js/carrito_caja.js?2345"></script>


        <?php

        include_once "Ctrl/footer.php";
        ?>