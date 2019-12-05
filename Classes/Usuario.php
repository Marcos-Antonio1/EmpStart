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
	
	public function listarTop10(){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$listar=$conexao->prepare("Select  empreendedor.nome as empreendedor,projeto.nome, projeto.orcamento, projeto.avaliacao from empreendedor, projeto where projeto.fk_empreendedor_projeto=empreendedor.idempreendedor ORDER BY avaliacao DESC limit 10");
			$listar->execute(array(
			));
		  return $projetos=$listar->fetchAll(PDO::FETCH_OBJ);
		  echo "marocs";	
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}	
	abstract public  function cadastrar();
	
	abstract public function listarProjetos();

	abstract public function atualizarDados($dado,$valor);
	
	public function buscarPorProjeto($palavra){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$query1=["select * from projeto where nome like ", "'$palavra%'"];
		$ini=implode("",$query1);
		$projetosbuscar=array(); 
		try{
			$buscar=$conexao->prepare($ini); 
			$buscar->execute();
			$projetos=$buscar->fetchAll(PDO::FETCH_OBJ);
			foreach($projetos as $projeto){
				//String $nome, String $descricao, bool $disponibilidade_para_investimentos,string $areaAtuacao,$imagem="",$fk_empreendedor_projeto='',$idprojeto='',float $orcamento=0,$avaliacao=''
				$proje= new Projeto($projeto->nome,$projeto->descricao,$projeto->disponibilidade_para_investimentos,$projeto->areaatuacao,$projeto->imagem,$projeto->fk_empreendedor_projeto,$projeto->idprojeto,$projeto->orcamento,$projeto->avaliacao);
				$projetosbuscar[]=$proje;
			}
			return  $projetosbuscar;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}

	public function buscarEmpreendedor($palavra){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$query1=["select * from empreendedor where nome like ", "'$palavra%'"];
		$ini=implode("",$query1);
		$projetosbuscar=array(); 
		$empreedores=array();
		try{
			$buscar=$conexao->prepare($ini); 
			$buscar->execute();
			$empreendedor=$buscar->fetchAll(PDO::FETCH_OBJ);
			foreach($empreendedor as $empreen){
				//String $nome, String $descricao, bool $disponibilidade_para_investimentos,string $areaAtuacao,$imagem="",$fk_empreendedor_projeto='',$idprojeto='',float $orcamento=0,$avaliacao=''
				$usuario=new Empreendedor($empreen->nome,$empreen->email,$empreen->login,$empreen->senha,$empreen->localizacao,$empreen->telefone,$empreen->outrosmeiosdecontato,$empreen->areaatuacao,$empreen->idempreendedor,$empreen->imagem);
				$empreedores[]=$usuario;
			}
			return  $empreedores;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	public function buscarInvestidor($palavra){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$query1=["select * from investidor where nome like ", "'$palavra%'"];
		$ini=implode("",$query1); 
		$investidores=array();
		try{
			$buscar=$conexao->prepare($ini); 
			$buscar->execute();
			$inves=$buscar->fetchAll(PDO::FETCH_OBJ);
			foreach($inves as $investidor  ){
				//String $nome, String $descricao, bool $disponibilidade_para_investimentos,string $areaAtuacao,$imagem="",$fk_empreendedor_projeto='',$idprojeto='',float $orcamento=0,$avaliacao=''
				$in=new Investidor($investidor->nome,$investidor->email,$investidor->login,$investidor->senha,$investidor->localizacao,$investidor->telefone,$investidor->outrosmeiosdecontato,$investidor->areaatuacao,$investidor->disponibilidade,$investidor->orcamentoinvestido,$investidor->imagem,$investidor->idinvestidor);
				$investidores[]=$in;
			}
			return  $investidores;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	
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

	public function MostraDadosdeEmpreemdedor($idEmpreendedor){
		$idEmpreendedor=intval($idEmpreendedor);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscar=$conexao->prepare('Select * from empreendedor where idempreendedor =:id');
			$buscar->execute(array(
				":id"=>$idEmpreendedor,
			));
			$user=$buscar->fetchAll(PDO::FETCH_OBJ);
			$usuario=new Empreendedor($user[0]->nome,$user[0]->email,$user[0]->login,$user[0]->senha,$user[0]->localizacao,$user[0]->telefone,$user[0]->outrosmeiosdecontato,$user[0]->areaatuacao,$user[0]->idempreendedor,$user[0]->imagem);
			return $usuario;
		}catch(PDOException $e ){
			echo $e->getMessage();
		}
	}
	public function verDetalhesdeprojeto($idProjeto){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscar=$conexao->prepare("Select * from projeto where idprojeto=:id");
			$buscar->execute(array(
				":id"=>$idProjeto,
			));
			$projeto=$buscar->fetchAll(PDO::FETCH_OBJ);
				$proje= new Projeto($projeto[0]->nome,$projeto[0]->descricao,$projeto[0]->disponibilidade_para_investimentos,$projeto[0]->areaatuacao,$projeto[0]->imagem,$projeto[0]->fk_empreendedor_projeto,$projeto[0]->idprojeto,$projeto[0]->orcamento,$projeto[0]->avaliacao);				
				return $proje;
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function MostrandoDadosDoinvestidor($idInvestidor){
		$idInvestidor=intval($idInvestidor);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscar=$conexao->prepare('Select * from investidor where idinvestidor =:id');
			$buscar->execute(array(
				":id"=>$idInvestidor,
			));
			$investidor=$buscar->fetchAll(PDO::FETCH_OBJ);
			$inves=new Investidor($investidor[0]->nome,$investidor[0]->email,$investidor[0]->login,$investidor[0]->senha,$investidor[0]->localizacao,$investidor[0]->telefone,$investidor[0]->outrosmeiosdecontato,$investidor[0]->areaatuacao,$investidor[0]->disponibilidade,$investidor[0]->orcamentoinvestido,$investidor[0]->imagem,$investidor[0]->idinvestidor);
			return $inves;
		}catch(PDOException $e ){
			echo $e->getMessage();
		}
		
	}
}

