<?php
require_once '../includes/data.php';
require_once '../includes/funciones.php';

// Iniciar la sesión para poder destruirla
session_start();

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión
session_destroy();

// Redirigir al login
header('location: ' . BASE_URL . 'auth/login.php');
exit;
