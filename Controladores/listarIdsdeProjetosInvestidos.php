<?php 
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
session_start();
use Classes\Investidor;
use Classes\Projeto;

$user= unserialize($_SESSION['usuario']);
$user->listarProjetos();
$projetos=$user->__get('projetosInvestidos');
$idsProjetos=array();
foreach($projetos as $projetoid){
    $id=$projetoid->idprojeto;
    $idsProjetos[]=$id;
}
echo json_encode( $idsProjetos);