<?php
    require_once('../includes/data.php');
    require_once '../includes/funciones.php';
    isAuth();
    
    $metodo = $_SERVER['REQUEST_METHOD'];

    // Obtener tipos de documento
    $query = "SELECT * FROM tipodocumento";
    $resultado = mysqli_query($db, $query);
    $tiposDocumento = [];
    while($fila = $resultado->fetch_assoc()){
        $tiposDocumento[] = $fila;
    }

    // Obtener tipos de cliente
    $query = "SELECT * FROM tipocliente"; 
    $resultado = mysqli_query($db, $query);
    $tiposCliente = [];
    while($fila = $resultado->fetch_assoc()){
        $tiposCliente[] = $fila;
    }
    
    if($metodo == "POST"){
        $cliente = $_POST;
        
        // Escapar los datos para prevenir SQL injection
        $nombres = mysqli_real_escape_string($db, $cliente['nombres']);
        $apellidos = mysqli_real_escape_string($db, $cliente['apellidos']);
        $tipo = mysqli_real_escape_string($db, $cliente['tipo']);
        $idTipoDocumento = mysqli_real_escape_string($db, $cliente['idTipoDocumento']);
        $nroDocumento = mysqli_real_escape_string($db, $cliente['nroDocumento']);
        $telefono = mysqli_real_escape_string($db, $cliente['telefono']);
        $email = mysqli_real_escape_string($db, $cliente['email']);
        $fechaNac = mysqli_real_escape_string($db, $cliente['fechaNac']);
        $idTipoCliente = mysqli_real_escape_string($db, $cliente['idTipoCliente']);

        $query = "INSERT INTO cliente (nombres, apellidos, tipo, idTipoDocumento, nroDocumento,
                    telefono, email, fechaNac, estado, idTipoCliente)
                VALUES('$nombres', '$apellidos', '$tipo', '$idTipoDocumento', '$nroDocumento',
                    '$telefono', '$email', '$fechaNac', 'A', '$idTipoCliente')";
        
        $resultado = mysqli_query($db, $query);
        if(!$resultado){
            die("Error al insertar: " . mysqli_error($db));
        }
        if($resultado){
            header('location: index.php');
            exit();
        }
    }
?>

<?php include_once '../templates/_header.php'; ?>

<h1>Crear Cliente</h1>

<form class="formulario" method="POST">
    <div class="form-control">
        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres" id="nombres" required>
    </div>

    <div class="form-control">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required>
    </div>

    <div class="form-control">
        <label for="tipo">Tipo:</label>
        <select name="tipo" id="tipo" required>
            <option value="">-- Seleccione --</option>
            <option value="N">Natural</option>
            <option value="J">Jurídica</option>
        </select>
    </div>

    <div class="form-control">
        <label for="idTipoDocumento">Tipo Doc.:</label>
        <select name="idTipoDocumento" id="idTipoDocumento" required>
            <option value="">-- Seleccione --</option>
            <?php foreach($tiposDocumento as $tipo): ?>
                <option value="<?php echo $tipo['id'] ?>">
                    <?php echo $tipo['codigo'] . " - " . $tipo['nombre']?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-control">
        <label for="nroDocumento">N° Doc.:</label>
        <input type="text" name="nroDocumento" id="nroDocumento" required>
    </div>

    <div class="form-control">
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono" required>
    </div>

    <div class="form-control">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-control">
        <label for="fechaNac">Fecha Nac.:</label>
        <input type="date" name="fechaNac" id="fechaNac" required>
    </div>

    <div class="form-control">
        <label for="idTipoCliente">Tipo Cliente:</label>
        <select name="idTipoCliente" id="idTipoCliente" required>
            <option value="">-- Seleccione --</option>
            <?php foreach($tiposCliente as $tipo): ?>
                <option value="<?php echo $tipo['id'] ?>">
                    <?php echo $tipo['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" value="Registrar Cliente" class="boton boton_primary--outline">
</form>

<?php include_once '../templates/_footer.php'; ?>
