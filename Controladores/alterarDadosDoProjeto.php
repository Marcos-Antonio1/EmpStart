<?php 
namespace Controladores;
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
session_start();

use Classes\Empreendedor;
use Classes\Projeto;
$user=unserialize($_SESSION['usuario']);
if(isset($_POST)){
    $user->alterarDadosDoProjeto($_POST['idprojeto'],$_POST['dado'],$_POST['valor']);
}
$imagem_setada=false;
$novoEndereco;
if(!empty($_FILES)){
    $formatos=["png","jpeg","jpg"];
    $extensao=pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
    if(in_array($extensao,$formatos)){
        $base="/var/www/html";
        $local="/ProjetoPOO/Views/assets/imgProjeto/";
        $temp= $_FILES['imagem']['tmp_name'];
        $newName=uniqid().".$extensao";
        $urlparamostrarimagem="$local"."$newName";
        $novoEndereco="$base". "$local" ."$newName";
        echo "$novoEndereco";
         if(move_uploaded_file($temp,$novoEndereco)){
            $imagem_setada=true;
        }       
    }
    if($imagem_setada){
        $user->alterarDadosDoProjeto($_POST['idprojeto'],$_POST['dado'],"{$urlparamostrarimagem}");
        echo $urlparamostrarimagem;
    }
}