<?php 
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});
use PDO;
use Classes\Bd;
use PDOException;

abstract class Usuario {
	protected  $nome;
	protected  $email;
	protected  $login;
	protected  $senha;
	protected  $localizacao;
	protected  $telefone;
	protected  $outrosMeiosDecontato;
	protected  $areaInteresse;
	protected  $imagem;
	

	public function __construct(String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse,$imagem="")
	{
		$this->nome= $nome;
		$this->email= $email;
		$this->login= $login;
		$this->senha= $senha;
		$this->telefone=$telefone;
		$this->outrosMeiosDecontato=$outrosMeiosDecontato;
		$this->localizacao= $localizacao;
		$this->areaInteresse =$areaInteresse; // recebe um array com as areas de interesse 
		$this->imagem =$imagem;
	}
	public function avaliarProjetos($idProjeto,$avaliacao){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$update=$conexao->prepare("update Projeto Set avaliacao= avaliacao+ :avaliacao where idprojeto= :id;");
		try{
			$update->execute(array(
				":avaliacao" =>$avaliacao,
				":id"=>$idProjeto
			));
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}	
	abstract public  function cadastrar();
	
	abstract public function listarProjetos();

	abstract public function atualizarDados();
}

