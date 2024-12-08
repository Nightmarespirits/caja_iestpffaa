<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';
    isAuth();
?>

<?php
    include_once '../templates/_header.php';
?>

<h1>Listado de prestamos</h1>
<a href="crear.php">
    <i class="fa-solid fa-hand-holding-dollar"></i>
    Nuevo Prestamo
</a>

<?php
    // Obtener listado de préstamos
    $query = "SELECT p.*, 
                     TRIM(CONCAT(c.nombres, ' ', c.apellidos)) as cliente
              FROM prestamo p 
              INNER JOIN cliente c ON p.idCliente = c.id
              ORDER BY p.fechaPrestamo DESC";
    
    $resultado = mysqli_query($db, $query);
?>

<table class="tabla">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Fecha Préstamo</th>
            <th>Importe</th>
            <th>Tasa</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($prestamo = mysqli_fetch_assoc($resultado)): ?>
        <tr>
            <td><?php echo $prestamo['cliente']; ?></td>
            <td><?php echo date('Y-m-d', strtotime($prestamo['fechaPrestamo'])); ?></td>
            <td><?php echo number_format($prestamo['importe'], 2); ?></td>
            <td><?php echo $prestamo['tasa']; ?>%</td>
            <td>
                <a href="detalle_prestamo.php?id=<?php echo $prestamo['id']; ?>" class="boton boton_secondary">
                    Ver Detalle
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php
    include_once '../templates/_footer.php';
?>