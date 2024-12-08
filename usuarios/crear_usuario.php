<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';

    isAuth();

    // Consulta para obtener los roles
    $query = "SELECT * FROM roles";
    $resultado = mysqli_query($db, $query);
    $roles = [];
    while($fila = $resultado->fetch_assoc()){
        $roles[] = $fila;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = mysqli_real_escape_string($db, $_POST['nombre']);
        $apellidos = mysqli_real_escape_string($db, $_POST['apellidos']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $rolId = mysqli_real_escape_string($db, $_POST['rolId']);
        
        // Hash del password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar usuario
        $query = "INSERT INTO usuarios (nombre, apellidos, email, password, rolId, estado) 
                 VALUES ('{$nombre}', '{$apellidos}', '{$email}', '{$passwordHash}', {$rolId}, 'A')";
        
        $resultado = mysqli_query($db, $query);

        if($resultado) {
            header('Location: index.php');
        }
    }
?>

<?php include_once '../templates/_header.php'; ?>

<h1>Crear Usuario</h1>

<form class="formulario" method="POST">
    <div class="form-control">
        <label for="nombre">Nombres:</label>
        <input type="text" name="nombre" id="nombre" required>
    </div>

    <div class="form-control">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" id="apellidos" required>
    </div>

    <div class="form-control">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div>

    <div class="form-control">
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
    </div>

    <div class="form-control">
        <label for="rolId">Rol:</label>
        <select name="rolId" id="rolId" required>
            <option value="">-- Seleccione --</option>
            <?php foreach($roles as $rol): ?>
                <option value="<?php echo $rol['id'] ?>"><?php echo $rol['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" value="Crear Usuario" class="boton">
</form>

<?php include_once '../templates/_footer.php'; ?>
