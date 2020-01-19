<?php
namespace Controladores;
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once  $dir .str_replace("\\","/",$classname).".php";
});

use Classes\Bd;
use Classes\Empreendedor;
use Classes\Investidor;
$urlparamostrarimagem="/var/www/html/ProjetoPOO/Views/assets/imgUser/imagempadrao.jpeg";
$novoEndereco;
if(!empty($_FILES)){
    $formatos=["png","jpeg","jpg"];
    $extensao=pathinfo($_FILES['imagem']['name'],PATHINFO_EXTENSION);
    if(in_array($extensao,$formatos)){
        $base="/var/www/html";
        $local="/ProjetoPOO/Views/assets/imgUser/";
        $temp= $_FILES['imagem']['tmp_name'];
        $newName=uniqid().".$extensao";
        $urlparamostrarimagem="$local"."$newName";
        $novoEndereco="$base". "$local" ."$newName";
        echo "$novoEndereco";
         if(move_uploaded_file($temp,$novoEndereco)){
             echo "imagem carregada com suceeso";
        }       
    }
}
if($_POST["radio"]=="E"){
    $empreendedor = new Empreendedor($_POST["nome"], $_POST["email"], $_POST["login"],$_POST["senha"],$_POST["cidade"], $_POST["telefone"], $_POST["outromeiodecontato"], $_POST["areainteresse"],'',"{$urlparamostrarimagem}");
    $empreendedor->cadastrar();
    header("Location:../index.php");
} else {
    $investidor = new Investidor($_POST["nome"], $_POST["email"], $_POST["login"],$_POST["senha"],$_POST["cidade"], $_POST["telefone"], $_POST["outromeiodecontato"], $_POST["areainteresse"],true,0,"{$urlparamostrarimagem}"); 
    $investidor->cadastrar();
    header('Location:../index.php');
}
