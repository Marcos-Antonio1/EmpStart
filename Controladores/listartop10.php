<?php
session_start(); 
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
session_start();

use Classes\Projeto;
use Classes\Empreendedor;
use Classes\Investidor;

if(isset($_SESSION)){
    $user= unserialize($_POST['usuario']);
    $resultado=$user->listarTop10();
    echo json_encode($resultado);
}