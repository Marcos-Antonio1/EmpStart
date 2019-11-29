<?php
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
require_once("autorizacao.php");
use Classes\Empreendedor;
use Classes\Investidor;

if(isset($_POST)){
    $user=unserialize($_SESSION['usuario']);
    $valor;
        foreach($_POST as $value){
            $valor=" '{$value}' ";
        }
        $dado=key($_POST);   
    if($user instanceof Empreendedor){
        $user->atualizarDados($dado,$valor);
    }else{
        $user->atualizarDados($dado,$valor);
    }
}