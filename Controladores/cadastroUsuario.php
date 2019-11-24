<?php
namespace Controladores;
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});

use Classes\Bd;
use PDOException;

$pdo=new BD();
$conexão=$pdo->abrirConexao();
if($_POST["radio"]=="E"){
    $buscar=$conexão->prepare("insert into empreendedor (nome, email, login, senha, localizacao, telefone, outrosmeiosdecontato, areaatuacao) values (:nome, :email, :login, :senha, :localizacao, :telefone, :outrosmeiosdecontato, :areaatuacao)");
    try{
    $buscar->execute(array(
        ":nome"=>$_POST["nome"],
        ":email"=>$_POST["email"],
        ":login"=>$_POST["login"],
        ":senha"=>$_POST["senha"],
        ":localizacao"=>$_POST["cidade"],
        ":telefone"=>$_POST["telefone"],
        ":outrosmeiosdecontato"=>$_POST["outromeiodecontato"],
        ":areaatuacao"=>$_POST["areainteresse"]
    ));
    } catch(PDOException $e){
        echo $e->getMessage();
    }
} elseif ($_POST["radio"]=="I") {
    $buscar=$conexão->prepare("insert into investidor (nome, email, login, senha, localizacao, telefone, outrosmeiosdecontato, areaatuacao) values (:nome, :email, :login, :senha, :localizacao, :telefone, :outrosmeiosdecontato, :areaatuacao)");
    try{
    $buscar->execute(array(
        ":nome"=>$_POST["nome"],
        ":email"=>$_POST["email"],
        ":login"=>$_POST["login"],
        ":senha"=>$_POST["senha"],
        ":localizacao"=>$_POST["cidade"],
        ":telefone"=>$_POST["telefone"],
        ":outrosmeiosdecontato"=>$_POST["outromeiodecontato"],
        ":areaatuacao"=>$_POST["areainteresse"]
    ));
    } catch(PDOException $e){
        echo $e->getMessage();
    }
}