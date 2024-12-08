<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';
    isAuth();

    $query = "SELECT id, TRIM(CONCAT(nombres, ' ', apellidos)) AS nombres
            FROM cliente";
    $resultado = mysqli_query($db, $query);
    $listadoClientes = [];
    while($cliente = $resultado->fetch_assoc()){
        $listadoClientes[] = $cliente;
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $empleado = $_SESSION['idUsuario'];
        $cliente = $_POST['cliente'];
        $importe = $_POST['importe'];
        $tasa = $_POST['tasa'];
        $numeroCuotas = $_POST['tiempo'];
        $tipoCuota = $_POST['tipo'];
        $fechaPrestamo = date('Y-m-d');
        $fechaDesembolso = $_POST['fechaDesembolso'];
        $estado = 'A';
        $tasaPorcentual = $tasa /100;        

        $query = "INSERT INTO prestamo(idEmpleado, idCliente, importe, tasa, tiempo, tipoCuota,
                    fechaPrestamo, fechaDesembolso, estado) 
                VALUES ('{$empleado}', '{$cliente}', '{$importe}', '{$tasa}', '{$numeroCuotas}', 
                    '{$tipoCuota}', '{$fechaPrestamo}', '{$fechaDesembolso}','{$estado}');";
        
        $resultado = mysqli_query($db, $query);
        $query = "SELECT LAST_INSERT_ID() AS id;";
        $resultado = mysqli_query($db, $query);
        $idPrestamo = $resultado->fetch_assoc()['id'];
        
        $cuotaMensual = round(($importe * $tasaPorcentual) / (1 - pow((1 + $tasaPorcentual), $numeroCuotas *-1)), 2);
        $cuota = 1;
        $saldo = $importe;
        $fechaPago = $fechaDesembolso;
        while($cuota <= $numeroCuotas){
            $importeInteres = round($saldo * $tasaPorcentual,2);
            $amortizacion = $cuotaMensual - $importeInteres;
            $fechaPago = date('Y-m-d', strtotime($fechaPago . '+ 1 month'));

            $query = "INSERT INTO cuotaprestamo(idPrestamo, nroCuota, importeCuota, 
                        importeInteres, amortizacion, fechaPago, estado) 
                    VALUES ('{$idPrestamo}', '{$cuota}', '{$cuotaMensual}', '{$importeInteres}',
                        '{$amortizacion}', '{$fechaPago}','P')";

            $resultado = mysqli_query($db, $query);

            $saldo -= $amortizacion;
            $cuota ++;
        }
        
    }
?>

<?php include_once '../templates/_header.php'; ?>

<h1>Crear Prestamo</h1>
<form class="formulario" method="POST">
    <div class="form-control">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" disabled value="<?php echo $_SESSION['nombreUsuario'] ?>">
    </div>

    <div class="form-control">
        <label for="cliente">Cliente:</label>
        <select name="cliente">
            <option value="" disabled selected>--SELECCIONE--</option>
            <?php foreach($listadoClientes as $cliente): ?>
                <option value="<?php echo $cliente['id']; ?>">
                    <?php echo $cliente['nombres']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-control">
        <label for="importe">Importe:</label>
        <input type="number" name="importe">
    </div>

    <div class="form-control">
        <label for="tasa">Tasa Interés (% mensual)</label>
        <input type="number" name="tasa">
    </div>

    <div class="form-control">
        <label for="tiempo">Numero de cuotas (expresado en meses)</label>
        <input type="number" name="tiempo">
    </div>

    <div class="form-control">
        <label for="tipo">Tipo Cuota</label>
        <select name="tipo">
            <option value="" disabled selected>--SELECCIONE--</option>
            <option value="F">Fijo</option>
            <option value="V">Variable</option>
        </select>
    </div>

    <div class="form-control">
        <label for="fechaPrestamo">Fecha de préstamo</label>
        <input type="text" name="fechaPrestamo" value="<?php echo date("m/d/Y"); ?>" disabled>
    </div>

    <div class="form-control">
        <label for="fechaDesembolso">Fecha a desembolsar</label>
        <input type="date" name="fechaDesembolso" min="<?php echo date('Y-m-d'); ?>">
    </div>

    <input type="submit" value="Registrar" class="boton boton_primary--outline">

</form>

<?php include_once '../templates/_footer.php' ?>