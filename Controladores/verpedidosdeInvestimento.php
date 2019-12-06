<?php 
namespace Controladores;
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
session_start();
use Classes\Empreendedor;
use Classes\Investidor;

if(isset($_POST)){
    $resultado=array();
    $user=unserialize($_SESSION['usuario']);
    $user->verificarRequisicoes();
    $requisicoes=$user->__get('requisicoes_investimento');
    foreach($requisicoes as $requ){
        $investidor=$user->MostrandoDadosDoinvestidor($requ->investidor_idinvestidor);
        $requ->nomeinvestidor=$investidor->__get('nome');
        $requ->localizacaoinvestidor=$investidor->__get('localizacao');
        $requ->telefoneInvestidor=$investidor->__get('telefone');
        $requ->areaInteresseInves=$investidor->__get('areaInteresse');
        $requ->imagem=$investidor->__get('imagem');
        $projeto=$user->verDetalhesdeprojeto($requ->projeto_idprojeto);
        $requ->nomeprojeto=$projeto->__get('nome');
        $resultado[]=$requ;
        
    }
    echo json_encode($resultado);
}