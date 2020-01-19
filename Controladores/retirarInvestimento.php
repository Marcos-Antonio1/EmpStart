<?php 
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});

session_start();
use Classes\Investidor;
if(isset($_POST)){
    $user=unserialize($_SESSION['usuario']);
    $user->retirarInvestimento($_POST['idprojeto']);
}