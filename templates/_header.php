<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'"/>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/style.css">
    <title>Document</title>
    <style>
        .dashboard__header {
            width: 100%;
            background-color: #fff; /* o el color que prefieras */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .navbar__contenedor {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            gap: 1rem;
        }

        .navbar__usuario {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar__acciones {
            display: flex;
            gap: 1rem;
        }
    </style>
</head>
<body class="dashboard">
    <header class="dashboard__header">
        <nav class="navbar">
            <div class="navbar__contenedor">
                <div class="navbar__logo">
                    <a href="<?php echo BASE_URL ?>">
                        <img src="<?php echo BASE_URL ?>assets/img/logo.png" alt="Logo" style="width: 250px;">
                    </a>
                </div>

                <div class="navbar__busqueda">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="search" placeholder="Buscar...">
                </div>

                <div class="navbar__usuario">
                    <div class="navbar__usuario-info">
                        <p><?php echo $_SESSION['nombreUsuario'] ?? 'No Logueado' ?></p>
                        <span><?php echo $_SESSION['rol'] ?? 'No especificado' ?></span>
                    </div>
                </div>

                <div class="navbar__acciones">
                    <a href="<?php echo BASE_URL ?>profile.php" class="navbar__link">
                        <i class="fa-solid fa-user-gear"></i>
                        Mi Perfil
                    </a>
                    <a href="<?php echo BASE_URL ?>auth/logout.php" class="navbar__link navbar__link--logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <div class="dashboard__grid">
        <!--TODO: AGREGAR SIDEBAR-->
        <?php include_once '_sidebar.php'; ?>
        
        <main class="dashboard_contenido">