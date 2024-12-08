<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';
    isAuth();
    
    $uid = $_GET['uid'] ?? '';

    $metodo = $_SERVER['REQUEST_METHOD'];
    if($metodo == "POST"){
        // MÉTODO POST
        $empleado = $_POST;
        $query = "UPDATE empleado
                    SET nombres = '{$empleado['nombres']}',
                    apellidos = '{$empleado['apellidos']}',
                    nroDocumento = '{$empleado['nroDocumento']}',
                    idTipoDocumento = '{$empleado['idTipoDocumento']}',
                    fechaNac = '{$empleado['fechaNac']}',
                    telefono = '{$empleado['telefono']}',
                    email = '{$empleado['email']}'
                    WHERE id = {$uid}";
        $resultado = mysqli_query($db, $query);
        if($resultado){
            header('location: index.php');
        }
    } else {
        // MÉTODO GET
        $query = "SELECT * FROM empleado
                    WHERE id = '{$uid}'";
        $resultado = mysqli_query($db, $query);
        $empleado = $resultado->fetch_assoc();
        if(!isset($empleado)){
            header('location: index.php');
        }
    }

    $query = "SELECT * FROM tipodocumento";
    $resultado = mysqli_query($db, $query);
    $tiposDocumento = [];
    while($fila = $resultado->fetch_assoc()){
        $tiposDocumento[] = $fila;
    }
?>

<?php
    include_once '../templates/_header.php';
?>
<!--CONTENIDO DE LA PÁGINA-->

<h1>Editar empleado</h1>
<form class="formulario" method="POST">
    <div class="form-control">
        <label for="nombre">Nombres:</label>
        <input type="text" name="nombres" id="nombre" 
            value="<?php echo $empleado['nombres'] ?>">
    </div>

    <div class="form-control">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos"
            value="<?php echo $empleado['apellidos'] ?>">
    </div>

    <div class="form-control">
        <label for="tipodoc">Tipo Doc.:</label>
        <select name="idTipoDocumento" id="idTipoDocumento">
            <option value="" disabled selected>--SELECCIONE--</option>
            <?php
            foreach($tiposDocumento as $tipo):
            ?>
            <option value="<?php echo $tipo['id'] ?>" <?php echo $empleado['idTipoDocumento'] === $tipo['id'] ? 'selected':''?>>
                <?php echo $tipo['codigo'] . " - " . $tipo['nombre']?>
            </option>
            <?php
            endforeach;
            ?>
        </select>
    </div>

    <div class="form-control">
        <label for="numerodoc">N° Doc.:</label>
        <input type="text" name="nroDocumento" id="numerdodoc"
            value="<?php echo $empleado['nroDocumento'] ?>">
    </div>

    <div class="form-control">
        <label for="fechanac">Fecha Nac.:</label>
        <input type="date" name="fechaNac" id="fechanac"
            value="<?php echo $empleado['fechaNac'] ?>">
    </div>

    <div class="form-control">
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono"
            value="<?php echo $empleado['telefono'] ?>">
    </div>

    <div class="form-control">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"
            value="<?php echo $empleado['email'] ?>">
    </div>

    <input type="submit" value="Actualizar" class="boton boton_primary--outline">
</form>

<!--FIN DEL CONTENIDO-->

<?php
    include_once '../templates/_footer.php';
?>