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
	public function listarTop10(){
		$listaTop10=array();
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$listar=$conexao->prepare("select * from projeto ORDER BY avaliacao Desc limit 10");
			$listar->execute(array(
			)); 
			$projetos=$listar->fetchAll(PDO::FETCH_OBJ);
			foreach($projetos as $projeto){
				$proje= new Projeto($projeto->nome,$projeto->descricao,$projeto->disponibilidade_para_investimentos,$projeto->areaatuacao,$projeto->imagem,$projeto->fk_empreendedor_projeto,$projeto->idprojeto,$projeto->orcamento,$projeto->avaliacao);
				$listaTop10[]=$proje;
				return $listaTop10;
			}
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}	
	abstract public  function cadastrar();
	
	abstract public function listarProjetos();

    abstract public function atualizarDados($dado,$valor);
	public function mostrarDados(){
		return[
			'nome'=>$this->nome,
			'email'=>$this->email,
			'login'=>$this->login,
			'local'=>$this->localizacao,
			'telefone'=>$this->telefone,
			'outrosmeios'=>$this->outrosMeiosDecontato,
			'area'=>$this->areaInteresse,
			'imagem'=>$this->imagem,
		];
	}
}

