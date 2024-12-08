<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';
    isAuth();

    // Verificar que se reciba el ID del préstamo
    $id = $_GET['id'] ?? null;
    if(!$id) {
        header('Location: /prestamos');
    }

    // Obtener datos del préstamo
    $query = "SELECT p.*, 
                     TRIM(CONCAT(c.nombres, ' ', c.apellidos)) as cliente,
                     TRIM(CONCAT(e.nombres, ' ', e.apellidos)) as empleado
              FROM prestamo p 
              INNER JOIN cliente c ON p.idCliente = c.id
              INNER JOIN empleado e ON p.idEmpleado = e.id
              WHERE p.id = {$id}";
    
    $resultado = mysqli_query($db, $query);
    $prestamo = mysqli_fetch_assoc($resultado);

    // Obtener cuotas del préstamo
    $query = "SELECT * FROM cuotaprestamo 
              WHERE idPrestamo = {$id} 
              ORDER BY nroCuota";
    
    $resultado = mysqli_query($db, $query);
    $cuotas = [];
    while($cuota = mysqli_fetch_assoc($resultado)) {
        $cuotas[] = $cuota;
    }
?>

<?php include_once '../templates/_header.php'; ?>

<h1>Detalle de préstamo</h1>

<div class="prestamo-info">
    <div class="form-control">
        <label>Cliente:</label>
        <input type="text" value="<?php echo $prestamo['cliente']; ?>" disabled>
    </div>

    <div class="form-control">
        <label>Fecha de préstamo:</label>
        <input type="text" value="<?php echo date('Y-m-d', strtotime($prestamo['fechaPrestamo'])); ?>" disabled>
    </div>

    <div class="form-control">
        <label>Importe:</label>
        <input type="text" value="<?php echo number_format($prestamo['importe'], 2); ?>" disabled>
    </div>

    <div class="form-control">
        <label>Tasa de interés mensual:</label>
        <input type="text" value="<?php echo $prestamo['tasa']; ?>" disabled>
    </div>
</div>

<h2>Plan de cuotas</h2>

<table class="tabla">
    <thead>
        <tr>
            <th>N° Cuota</th>
            <th>Importe Cuota</th>
            <th>Importe Interés</th>
            <th>Amortización</th>
            <th>Saldo</th>
            <th>Fecha Pago</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>0</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td><?php echo number_format($prestamo['importe'], 2); ?></td>
            <td>-</td>
        </tr>
        <?php 
        $saldo = $prestamo['importe'];
        foreach($cuotas as $cuota): 
            $saldo -= $cuota['amortizacion'];
        ?>
            <tr>
                <td><?php echo $cuota['nroCuota']; ?></td>
                <td><?php echo number_format($cuota['importeCuota'], 2); ?></td>
                <td><?php echo number_format($cuota['importeInteres'], 2); ?></td>
                <td><?php echo number_format($cuota['amortizacion'], 2); ?></td>
                <td><?php echo number_format($saldo, 2); ?></td>
                <td><?php echo date('Y-m-d', strtotime($cuota['fechaPago'])); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once '../templates/_footer.php' ?>
