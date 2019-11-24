<?php
namespace Controladores;
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});

use Classes\Bd;
use Classes\Empreendedor;
use Classes\Investidor;
use PDOException;

$pdo=new BD();
$conexão=$pdo->abrirConexao();
if($_POST["radio"]=="E"){
    $empreendedor = new Empreendedor($_POST["nome"], $_POST["email"], $_POST["login"],$_POST["senha"],$_POST["cidade"], $_POST["telefone"], $_POST["outromeiodecontato"], $_POST["areainteresse"]);
    $empreendedor->cadastrar();
} else {
    $investidor = new Investidor($_POST["nome"], $_POST["email"], $_POST["login"],$_POST["senha"],$_POST["cidade"], $_POST["telefone"], $_POST["outromeiodecontato"], $_POST["areainteresse"]); 
    $investidor->cadastrar();
}