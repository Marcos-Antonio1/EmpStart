<?php
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});

use Classes\Empreendedor;
use Classes\Investidor;
session_start();
    
if(isset($_POST)){
    $user=unserialize($_SESSION['usuario']);
    echo json_encode($user->verDetalhesdeprojeto($_POST['idprojeto']));
}