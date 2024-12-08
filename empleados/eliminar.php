<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';
    isAuth();

    $id = $_GET['uid'] ?? ''; // PARAMETRO QUE VIENE POR GET

    if(!$id){
        header('location: index.php');        
    }

    $query = "SELECT * FROM empleado
                WHERE id = '{$id}'
                LIMIT 1";

    $resultado = mysqli_query($db, $query);
    $empleado = $resultado->fetch_assoc();
    $mensaje = "";

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $query = "DELETE FROM empleado
                    WHERE id = '{$empleado['id']}'";
        $resultado = mysqli_query($db, $query);
        if($resultado){
            header('location: index.php');
        } else {
            $mensaje = "No se ha podido eliminar el registro";
        }
    }
?>

<?php
    include_once '../templates/_header.php';
?>

<!--VALIDAMOS QUE EXISTA EL EMPLEADO-->
<?php
    if(isset($empleado)):
        echo $mensaje;
?>
    <h1>Eliminar empleado</h1>
    <p>¿Está seguro de eliminar el empleado <strong><?php echo $empleado['apellidos'] . ', ' . $empleado['nombres'] ?></strong> con número de documento <strong><?php echo $empleado['nroDocumento'] ?></strong>?</p>
    <form method="POST">
        <input class="boton boton_primary" type="submit" value="Eliminar">
    </form>
<?php
    else:
?>
    <p>No se encuentra el registro a eliminar.</p>
    <a href="index.php">Regresar</a>
<?php
    endif;
?>


<?php
    include_once '../templates/_footer.php';
?>