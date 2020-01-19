<?php
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
session_start();

use Classes\Empreendedor;
use Classes\Investidor;
use Classes\Projeto;

if(isset($_POST)){
    $user=unserialize($_SESSION['usuario']);
    $result=$user->BuscarTodososUsuario();
    echo json_encode($result);
}