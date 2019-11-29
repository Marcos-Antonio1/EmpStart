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
use PDO;

$pdo=new BD();
$conexão=$pdo->abrirConexao();
if($_POST['radio']=="E"){
    $buscar=$conexão->prepare("SELECT * from empreendedor where login=:login and senha=:senha ");
    try{
    $buscar->execute(array(
        ":login"=>$_POST["login"],
        ":senha"=>$_POST["senha"]
    ));
    $users=$buscar->fetchAll(PDO::FETCH_OBJ);
    $user=$users[0];
    //String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse,$idEmpreendedor='',$imagem=""
    if(!empty($user)){
            $usuario=new Empreendedor($user->nome,$user->email,$user->login,$user->senha,$user->localizacao,$user->telefone,$user->outrosmeiosdecontato,$user->areaatuacao,$user->idempreendedor,$user->imagem);
            //header('Location: ../Views/home.php');
            var_dump($empreendedor);
            session_start();
            $_SESSION['usuario']= serialize($usuario);
            header("Location: ../Views/home.php");
        }else{
            $mensagem="usuario não cadastrado";
           header("Location: ../index.php?mensagem=$mensagem");
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}else{
    $buscarinvestidor=$conexão->prepare("SELECT * from investidor where login=:login and senha=:senha");
            $buscarinvestidor->execute(array(
                ":login"=>$_POST["login"],
                ":senha"=>$_POST["senha"]
            ));
            $usersinvestidores=$buscarinvestidor->fetchAll(PDO::FETCH_OBJ);
            $userinvestidor=$usersinvestidores[0];
            if(!empty($userinvestidor)){
                $usuario=new Investidor($userinvestidor->nome,$userinvestidor->email,$userinvestidor->login,$userinvestidor->senha,$userinvestidor->localizacao,$userinvestidor->telefone,$userinvestidor->outrosmeiosdecontato,$userinvestidor->areaatuacao,$userinvestidor->disponibilidade,$userinvestidor->orcamentoinvestido,$userinvestidor->imagem,$userinvestidor->idinvestidor);
                var_dump($investidor);
                session_start();
                $_SESSION['usuario']= serialize($usuario);
                header("Location: ../Views/homeInvestidor.php");
            }else{
                $mensagem="usuario não cadastrado";
                header("Location: ../index.php?mensagem=$mensagem");
            }
}