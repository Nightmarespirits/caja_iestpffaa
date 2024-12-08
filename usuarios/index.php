<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';

    isAuth();

    // Consulta para obtener todos los usuarios activos
    $query = "SELECT u.*, r.nombre as rol 
              FROM usuarios u 
              INNER JOIN roles r ON u.rolId = r.id 
              WHERE u.estado = 'A'";
    $resultado = mysqli_query($db, $query);
    $listadoUsuarios = [];
    while($fila = $resultado->fetch_assoc()){
        $listadoUsuarios[] = $fila;
    }
?>

<?php include_once '../templates/_header.php'; ?>

<h1>Listado de Usuarios</h1>
<a href="crear_usuario.php">
    <i class="fa-solid fa-user-plus"></i>
    Nuevo Usuario
</a>

<table class="tabla">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listadoUsuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario['nombre'] ?></td>
                <td><?php echo $usuario['apellidos'] ?></td>
                <td><?php echo $usuario['email'] ?></td>
                <td><?php echo $usuario['rol'] ?></td>
                <td><?php echo $usuario['estado'] === 'A' ? 'Activo' : 'Inactivo' ?></td>
                <td>
                    <a class="acciones" href="editar.php?id=<?php echo $usuario['id'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a class="acciones" href="eliminar.php?id=<?php echo $usuario['id'] ?>" 
                       onclick="return confirm('¿Está seguro de eliminar este usuario?')">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once '../templates/_footer.php'; ?>
