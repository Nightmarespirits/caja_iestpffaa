<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';

    isAuth();
    
    // Ejecutar consulta SQL
    $query = "SELECT A.*, B.codigo 
                FROM empleado A INNER JOIN tipodocumento B
                ON A.idTipoDocumento = B.id
                ORDER BY apellidos, nombres;";
    $resultado = mysqli_query($db, $query);
    // Leer resultado de la consultado
    $empleados = [];
    while($fila = $resultado->fetch_assoc()){
        $empleados[] = $fila;
    }
?>

<?php
    include_once '../templates/_header.php';
?>
<h1>Listado de empleados</h1>
<a href="crear.php">
    <i class="fa-solid fa-user-plus"></i>
    Nuevo Empleado
</a>
<table class="tabla">
    <thead>
        <tr>
            <th>Apellidos y nombres</th>
            <th>N° Documento</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <!--Mostrar datos en la tabla-->
        <?php
        foreach($empleados as $empleado):
        ?>
        <tr>
            <td><?php echo $empleado['apellidos'] . " " . 
                $empleado["nombres"] ?>
            </td>
            <td><?php echo $empleado['codigo'] . " - " . $empleado['nroDocumento'] ?></td>
            <td><?php echo $empleado['email']?></td>
            <td>
                <a class="acciones" href="editar.php?uid=<?php echo $empleado['id'] ?>">
                    <i class="fa-solid fa-user-pen"></i>
                </a>
                <a class="acciones acciones-remove" href="eliminar.php?uid=<?php echo $empleado['id'] ?>">
                    <i class="fa-regular fa-trash-can"></i>
                </a>
            </td>
        </tr>
        <?php
        endforeach;
        ?>
    </tbody>
</table>

<?php
    include_once '../templates/_footer.php';
?>