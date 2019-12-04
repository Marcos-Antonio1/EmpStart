<?php 
namespace Controladores;
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
session_start();
use Classes\Empreendedor;
use Classes\Projeto;
use Classes\Investidor;

if(isset($_POST)){
    $user=unserialize($_SESSION['usuario']);
    $objetoProjeto=$user->verDetalhesdeprojeto($_POST['idprojeto']);
    $investidores=$objetoProjeto->__get('investidores');
    echo json_encode($investidores);
}