<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="<?php echo BASE_URL; ?>" class="dashboard__enlace">
            <i class="fa-solid fa-house dashboard__icono"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>    
        </a>

        <?php if(validarAcceso("Empleados")): ?>
            <a href="<?php echo BASE_URL; ?>empleados" class="dashboard__enlace">
                <i class="fa-solid fa-clipboard-user dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Empleados
                </span>    
            </a>
        <?php endif;?>

        <?php if(validarAcceso("Clientes")): ?>
            <a href="<?php echo BASE_URL; ?>clientes" class="dashboard__enlace">
                <i class="fa-solid fa-people-group dashboard__icono"></i>
                <span class="dashboard__menu-texto">
                    Clientes
                </span>    
            </a>
        <?php endif;?>

        <?php if(validarAcceso("Prestamos")): ?>
            <a href="<?php echo BASE_URL; ?>prestamos" class="dashboard__enlace">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <span class="dashboard_menu-texto">
                    Prestamos
                </span>
            </a>
        <?php endif;?>

        <?php if(validarAcceso("Usuarios")): ?>
            <a href="<?php echo BASE_URL; ?>usuarios" class="dashboard__enlace">
                <i class="fa-solid fa-users"></i>
                <span class="dashboard_menu-texto">
                    Usuarios
                </span>
            </a>
        <?php endif;?>
    </nav>
</aside>

