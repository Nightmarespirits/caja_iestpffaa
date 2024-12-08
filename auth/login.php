<?php
    require_once '../includes/data.php';
    require_once '../includes/funciones.php';
    
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "CALL loginUsuario('{$email}')";
        $resultado = mysqli_query($db, $query);
        $usuario = $resultado->fetch_assoc();
        if($usuario && $usuario['estado'] == "A"){
            $estadoPassword = password_verify($password, $usuario['password']);
            if($estadoPassword){
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['rol'] = $usuario['rol'];
                $_SESSION['idUsuario'] = $usuario['id'];
                $_SESSION['emailUsuario'] = $usuario['email'];
                $_SESSION['nombreUsuario'] = $usuario['nombre'] . ' ' . $usuario['apellidos'];
                header('location:' . BASE_URL);
            } else {
                $mensaje = "Password incorrecto";
            }
        } else {
            $mensaje = "Usuario no encontrado.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'"/>
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Login de usuario</title>
</head>
<body>
    <div class="portada-login">
        <div class="contenedor-login">
            <p>
                <?php echo $mensaje ?? '' ?>
            </p>
            <form class="formulario" method="POST">
                <div class="form-control">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                </div>
                <?php
                // $password = "123";
                // $hash = password_hash($password, PASSWORD_DEFAULT);
                // echo $hash;
                ?>
                <div class="form-control">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>

                <input class="boton boton_primary" type="submit" value="Iniciar sesión">
            </form>
        </div>
    </div>
</body>
</html>