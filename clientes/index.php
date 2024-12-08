<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';

    isAuth();

    $query = "CALL listarClientes();";
    $resultado = mysqli_query($db, $query);
    $listadoClientes = [];
    while($fila = $resultado->fetch_assoc()){
        $listadoClientes[] = $fila;
    }
?>

<?php
    include_once '../templates/_header.php';
?>
<h1>Listado de clientes</h1>
<a href="crear.php">
    <i class="fa-solid fa-user-plus"></i>
    Nuevo Cliente
</a>
<table class="tabla">
    <thead>
        <tr>
            <th>Rz. Social</th>
            <th>N° Documento</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($listadoClientes as $cliente):?>
            <tr>
                <td><?php echo $cliente['nombres'] ?></td>
                <td><?php echo $cliente['documento'] ?></td>
                <td><?php echo $cliente['telefono'] ?></td>
                <td><?php echo $cliente['email'] ?></td>
                <td><?php echo $cliente['tipoCliente'] ?></td>
                <td>
                    <a class="acciones" href="editar.php?uid=<?php echo $cliente['id'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>

<?php
    include_once '../templates/_footer.php';
?>