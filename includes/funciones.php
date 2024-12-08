<?php

define("BASE_URL", "http://localhost/caja_iestpffaa/");

function depurar($valor){
    echo '<pre>';
    var_dump($valor);
    echo '</pre>';
    exit;
}

function isAuth() : void {
    session_start();
    if(!isset($_SESSION['login'])){
        header('location: ' . BASE_URL . 'auth/login.php');
    }
}

function validarAcceso($moduloValidar) : bool {
    $modulos = [
        [
            "modulo" => "Clientes",
            "roles" => [
                "ADM",
                "PRES"
            ]
        ],
        [
            "modulo" => "Empleados",
            "roles" => [
                "ADM",
                "RRHH"
            ]
        ],
        [
            "modulo" => "Prestamos",
            "roles" => [
                "ADM",
                "PRES"
            ]
        ],
        [
            "modulo" => "Usuarios",
            "roles" => [
                "ADM"
            ]
        ]
    ];

    $modulo = [];
    foreach($modulos as $mod){
        if($mod["modulo"] == $moduloValidar){
            $modulo = $mod;
            break;
        }
    }
    $rolUsuario = $_SESSION['rol'];
    $tieneAcceso = ($modulo && in_array($rolUsuario, $modulo["roles"]));
    return $tieneAcceso;
}