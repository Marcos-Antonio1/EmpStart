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
    $dados1=$user->buscarInvestidor( $_POST['palavra']);
    $dados2=$user->buscarEmpreendedor( $_POST['palavra']);
    $dados3=$user->buscarPorProjeto( $_POST['palavra'] );
    $result=array_merge($dados3,$dados1,$dados2);
    echo json_encode($result);
}