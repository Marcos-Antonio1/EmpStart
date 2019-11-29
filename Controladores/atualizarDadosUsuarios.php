<?php
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
require_once("autorizacao.php");
use Classes\Empreendedor;
use Classes\Investidor;
use Classes\Bd;
session_start();

if(isset($_POST)){
    $user=unserialize($_SESSION['usuario']);
    $valor;
        foreach($_POST as $value){
            $valor=" '{$value}' ";
        }
    $dado=key($_POST);
    $pdo=new Bd();
    $conexao=$pdo->abrirConexao();
    if($user instanceof Empreendedor){
        $user->atualizarDados($dado,$valor);
        $buscar=$conexao->prepare("SELECT * from empreendedor where idempreendedor= :id");
        $buscar->execute(array(
            ":id"=>$user->__get('idEmpreendedor'),
        ));
        $users=$buscar->fetchAll(PDO::FETCH_OBJ);
        $user=$users[0];
        //String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse,$idEmpreendedor='',$imagem=""
        if(!empty($user)){
                $usuario=new Empreendedor($user->nome,$user->email,$user->login,$user->senha,$user->localizacao,$user->telefone,$user->outrosmeiosdecontato,$user->areaatuacao,$user->idempreendedor,$user->imagem);
                //header('Location: ../Views/home.php');
                $_SESSION['usuario']= serialize($usuario);
            }
        }
        else{
        $user->atualizarDados($dado,$valor);
        $atualizar=$conexao->prepare("SELECT * from investidor where idinvestidor= :id");
         $atualizar->execute(array(
            ":id"=>$user->__get('idInvestidor')
         ));
         $usersinvestidores=$atualizar->fetchAll(PDO::FETCH_OBJ);
         $userinvestidor=$usersinvestidores[0];
         if(!empty($userinvestidor)){
             $usuario=new Investidor($userinvestidor->nome,$userinvestidor->email,$userinvestidor->login,$userinvestidor->senha,$userinvestidor->localizacao,$userinvestidor->telefone,$userinvestidor->outrosmeiosdecontato,$userinvestidor->areaatuacao,$userinvestidor->disponibilidade,$userinvestidor->orcamentoinvestido,$userinvestidor->imagem,$userinvestidor->idinvestidor);
             $_SESSION['usuario']= serialize($usuario);
            }
        }

    }
