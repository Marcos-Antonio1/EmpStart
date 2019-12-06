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
    $user= unserialize($_SESSION['usuario']);
    echo json_encode($user->listarTop10());
    
}