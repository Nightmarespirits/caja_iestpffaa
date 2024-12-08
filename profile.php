<?php
require_once 'includes/data.php';
require_once 'includes/funciones.php';
isAuth();

include_once 'templates/_header.php';
?>

<div class="contenedor">
    <h1>Mi Perfil</h1>

    <div class="perfil-usuario">
        <div class="foto-perfil">
            <!-- Por ahora mostramos una imagen genérica -->
            <img src="/assets/img/usuario-default.png" alt="Foto de perfil">
        </div>

        <div class="datos-perfil">
            <div class="campo-perfil">
                <label>Nombre Completo:</label>
                <p><?php echo $_SESSION['nombreUsuario']; ?></p>
            </div>

            <div class="campo-perfil">
                <label>Correo Electrónico:</label>
                <p><?php echo $_SESSION['emailUsuario']; ?></p>
            </div>

            <div class="campo-perfil">
                <label>Rol:</label>
                <p><?php echo $_SESSION['rol']; ?></p>
            </div>

            <div class="campo-perfil">
                <label>ID Usuario:</label>
                <p><?php echo $_SESSION['idUsuario']; ?></p>
            </div>
        </div>
    </div>
</div>

<style>
.perfil-usuario {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    display: flex;
    gap: 2rem;
}

.foto-perfil {
    flex: 0 0 200px;
}

.foto-perfil img {
    width: 100%;
    border-radius: 50%;
}

.datos-perfil {
    flex: 1;
}

.campo-perfil {
    margin-bottom: 1rem;
}

.campo-perfil label {
    font-weight: bold;
    color: #666;
}

.campo-perfil p {
    margin: 0.5rem 0;
    font-size: 1.1rem;
}
</style>

<?php include_once 'templates/_footer.php'; ?>
