<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';

    isAuth();

    $id = $_GET['uid'] ?? '';

    $query = "CALL buscarCliente('{$id}')";
    $resultado = mysqli_query($db, $query);
    $cliente = $resultado->fetch_assoc();
    $db->next_result();
    if(!isset($cliente)){
        header('location:index.php');
        exit;
    }

    $query = "CALL listarTiposDocumento()";
    $resultado = mysqli_query($db, $query);
    $tiposDocumento = [];
    while($fila = $resultado->fetch_assoc()){
        $tiposDocumento[] = $fila;
    }
?>


<?php include_once '../templates/_header.php';?>

<h1>Editar cliente</h1>
<form class="formulario" method="POST">
    <div class="form-control">
        <label for="nombre">Nombres:</label>
        <input type="text" name="nombres" id="nombres" 
            value="<?php echo $cliente['nombres'] ?>">
    </div>

    <div class="form-control">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" 
            value="<?php echo $cliente['apellidos'] ?>">
    </div>

    <div class="form-control">
        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo">
            <option value="N" <?php echo $cliente['tipo'] == 'N' ? 'selected' : ''; ?> >Natural</option>
            <option value="J" <?php echo $cliente['tipo'] == 'J' ? 'selected' : ''; ?>>Juridica</option>
        </select>
    </div>

    <div class="form-control">
        <label for="tipoDocumento">Tipo:</label>
        <select name="tipoDocumento" id="tipoDocumento">
            <?php foreach($tiposDocumento as $tipo): ?>
                <option value="<?php echo $tipo['id'] ?>" <?php echo $cliente['tipoDocumento'] === $tipo['id'] ? 'selected':''?>>
                <?php echo $tipo['nombre']?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
</form>

<?php include_once '../templates/_footer.php';?>