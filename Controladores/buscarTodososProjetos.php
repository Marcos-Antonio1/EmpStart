<?php 
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
use Classes\Bd;

$pdo=new Bd();
$conexao=$pdo->abrirConexao();
try{
    $buscar=$conexao->prepare("SELECT * FROM projeto");
    $buscar->execute();
    $resultados=$buscar->fetchAll(PDO::FETCH_OBJ);
    $dados= json_encode($resultados);
    echo $dados;
}catch(PDOException $e){
    echo $e->getMessage();
}