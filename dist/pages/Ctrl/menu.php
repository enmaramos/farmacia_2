
        <!-----------------------------------------------------IINICIO DEL MENU IZQUIERDO------------------------------------------------------------>

        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="./index.html" class="brand-link"> <!--begin::Brand Image--> <img src="../../dist/assets/img/logoredondo.ico" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--><span class="brand-text fw-light" > Farmacia <br> San Francisco Javier</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                  <nav class="mt-2"> <!--begin::Sidebar --->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                        <!-----------------------------------------------------------INICIO DEL MENU------------------------------------------------------------------------------>
                     
                        <!--------------------------------------------------------LO QUE EST EN USO ---------------------------------------------------->
                        <li class="nav-item"> <a href="./inicio.php" class="nav-link"> <i class="fa-solid fa-house-user"></i>
                                <p>INICIO</p>
                            </a> </li>

                            <li class="nav-item has-treeview"> 
                            <a href="#" class="nav-link"> 
                                <i class="fa-solid fa-users"></i>
                                <p>
                                    CLIENTE
                                    <i class="right fas fa-angle-left"></i> <!-- Icono de flecha -->
                                </p>
                            </a> 
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./clientes_registro.php" class="nav-link">
                                        <i class="fa-solid fa-user-plus"></i>
                                        <p>Registrar Cliente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./clientes_lista.php" class="nav-link">
                                        <i class="fa-solid fa-list"></i>
                                        <p>Lista de Clientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                            <li class="nav-item"> <a href="./usuarios.php" class="nav-link"> 
                                <p>Usuarios</p>
                            </a> </li>
                           
