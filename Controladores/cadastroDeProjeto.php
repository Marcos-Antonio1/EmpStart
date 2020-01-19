<?php
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
 require_once("autorizacao.php");
use Classes\Projeto;
use Classes\Empreendedor;
$imagem_setada=false;
$novoEndereco;
if(isset($_POST)){
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
    }
     $user=unserialize($_SESSION['usuario']);
    if($imagem_setada){
        $projeto=new Projeto($_POST['nome'],$_POST['descricao'],$_POST['tipo'],$_POST['area'],"{$urlparamostrarimagem}");
    }else{
        $projeto=new Projeto($_POST['nome'],$_POST['descricao'],$_POST['tipo'],$_POST['area']);
    }
    $user->criarProjeto($projeto);
    header('Location:../Views/home.php');
}