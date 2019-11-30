<?php
session_start(); 
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
session_start();

use Classes\Empreendedor;
use Classes\Investidor;
use Classes\Projeto;

if(isset($_SESSION)){
    $user= unserialize($_SESSION['usuario']);
    $user->CarregarProjetos();
    $dados=$user->__get('projetos');
     $resultado = json_encode($dados);
     echo $resultado;
     
     //echo json_encode($resultado);    
}