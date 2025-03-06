<!-----------------------------------------------------IINICIO DEL MENU IZQUIERDO------------------------------------------------------------>

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
    <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link"> <!--begin::Brand Image--> <img src="../../dist/assets/img/logoredondo.ico" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--><span class="brand-text fw-light"> Farmacia <br> San Francisco Javier</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar --->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-----------------------------------------------------------INICIO DEL MENU------------------------------------------------------------------------------>

                <!--------------------------------------------------------LO QUE EST EN USO ---------------------------------------------------->


                <li class="nav-item">
                    <a href="./inicio.php" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i> <!-- Icono de administración -->
                        <p>
                            Administración
                            <i class="nav-arrow bi bi-chevron-right"></i> <!-- Flecha de submenú -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./usuarios.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./proveedores.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Proveedor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./vendedor.php" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Vendedores</p>
                            </a>
                        </li>
                    </ul>
                </li>