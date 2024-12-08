<?php

    
    require_once('../includes/data.php');
    require_once '../includes/funciones.php';
    isAuth();
    
    $metodo = $_SERVER['REQUEST_METHOD'];

    $query = "SELECT * FROM tipodocumento";
    $resultado = mysqli_query($db, $query);
    $tiposDocumento = [];
    while($fila = $resultado->fetch_assoc()){
        $tiposDocumento[] = $fila;
    }
    
    if($metodo == "POST"){
        $empleado = $_POST;
        
        // Escapar los datos para prevenir SQL injection
        $nombres = mysqli_real_escape_string($db, $empleado['nombres']);
        $apellidos = mysqli_real_escape_string($db, $empleado['apellidos']);
        $nroDocumento = mysqli_real_escape_string($db, $empleado['nroDocumento']);
        $idTipoDocumento = mysqli_real_escape_string($db, $empleado['idTipoDocumento']);
        $fechaNac = mysqli_real_escape_string($db, $empleado['fechaNac']);
        $telefono = mysqli_real_escape_string($db, $empleado['telefono']);
        $email = mysqli_real_escape_string($db, $empleado['email']);

        $query = "INSERT INTO empleado (nombres, apellidos, nroDocumento, idTipoDocumento, 
                    fechaNac, telefono, email)
                VALUES('$nombres', '$apellidos', '$nroDocumento', '$idTipoDocumento',
                    '$fechaNac', '$telefono', '$email')";
        
        $resultado = mysqli_query($db, $query);
        if(!$resultado){
            die("Error al insertar: " . mysqli_error($db));
        }
        if($resultado){
            header('location: index.php');
            exit(); // Agregar exit después del header
        }
    }
?>

<?php
    include_once '../templates/_header.php';
?>

<h1>Crear Empleado</h1>

<form class="formulario" method="POST">
    <div class="form-control">
        <label for="nombre">Nombres:</label>
        <input type="text" name="nombres" id="nombre">
    </div>

    <div class="form-control">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos">
    </div>

    <div class="form-control">
        <label for="tipodoc">Tipo Doc.:</label>
        <select name="idTipoDocumento" id="idTipoDocumento">
            <option value="" disabled selected>--SELECCIONE--</option>
            <?php
            foreach($tiposDocumento as $tipo):
            ?>
            <option value="<?php echo $tipo['id'] ?>">
                <?php echo $tipo['codigo'] . " - " . $tipo['nombre']?>
            </option>
            <?php
            endforeach;
            ?>
        </select>
    </div>

    <div class="form-control">
        <label for="numerodoc">N° Doc.:</label>
        <input type="text" name="nroDocumento" id="numerdodoc">
    </div>

    <div class="form-control">
        <label for="fechanac">Fecha Nac.:</label>
        <input type="date" name="fechaNac" id="fechanac">
    </div>

    <div class="form-control">
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" id="telefono">
    </div>

    <div class="form-control">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </div>

    <input type="submit" value="Registrar" class="boton boton_primary--outline">
</form>

<?php
    include_once '../templates/_footer.php';
?>