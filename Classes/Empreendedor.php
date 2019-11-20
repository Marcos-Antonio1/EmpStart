<?php
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});
use PDO;
use PDOException;
use Classes\Usuario;
use Classes\Bd;
use Classes\Projeto;

class Empreendedor extends Usuario{
	private $idEmpreendedor;
	private $requisicoes_investimento;
	public $projetos=array();
	public function __construct(String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse,$imagem="") {
		$this->requisicoes_investimento = array();
		parent::__construct( $nome,  $email, $login, $senha,$localizacao,$telefone,$outrosMeiosDecontato,$areaInteresse,$imagem);
		$projetos=array();
	}
	public function criarProjeto(Projeto $projeto)  {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$cadastrar=$conexao->prepare("insert into projeto(nome,descricao,disponibilidade_para_investimentos,orcamento,avaliacao,areaatuacao,fk_empreendedor_projeto)values(:nome,:descricao,:disponibilidade,:orcamento,:avaliacao,:areaatuacao,:fk_empreendedor_projeto);
			");
			$cadastrar->execute(array(
				":nome" =>$projeto->__get('nome'),
				":descricao" =>$projeto->__get('descricao'),
				":disponibilidade" =>$projeto->__get('disponibilidade_para_investimentos'),
				":orcamento" => $projeto->__get('orcamento'),
				":avaliacao"=>0,
				":areaatuacao"=> $projeto->__get('areaatuacao'),
				":fk_empreendedor_projeto" =>$this->idEmpreendedor,
			));
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function cadastrar()
	{	
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$inserir=$conexao->prepare("insert into empreendedor(nome,email,login,senha,localizacao,telefone,outrosmeiosdecontato,areaatuacao) VALUES(:nome,:email,:login,:senha,:localizacao,:telefone,:outrosmeiosdecontato,:areaInterese);");
			$inserir->execute(array(
				":nome"=>$this->nome,
				":email"=>$this->email,
				":login"=>$this->login,
				":senha"=>$this->senha,
				":localizacao"=> $this->localizacao,
				":telefone"=>$this->telefone,
				":outrosmeiosdecontato"=>$this->outrosMeiosDecontato,
				":areaInterese"=>'qualquer'
			));
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function CarregarProjetos() // carrega todos os projetos do banco para o array de projetos do usuario 
	{		
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$listar=$conexao->prepare("select * from projeto where fk_empreendedor_projeto = :id;");
			$listar->execute(array(
				"id"=>$this->idEmpreendedor,
			)); 
			$projetos=$listar->fetchAll(PDO::FETCH_OBJ);
			foreach($projetos as $projeto){
				$proje= new Projeto($projeto->idprojeto,$projeto->nome,$projeto->descricao,$projeto->disponibilidade_para_investimentos,$projeto->orcamento,$projeto->avaliacao,$projeto->areaatuacao,$projeto->fk_empreendedor_projeto,$projeto->imagem);
				$this->projetos[]=$proje;
			}
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function listarProjetos(){
		$this->CarregarProjetos();
		var_dump($this->projetos); 		
	}
	public function atualizarDados( $dados=array(),$valores=array()):bool{  
		$preparadorqueryAtributoseValores=array();
		$interador=0;
		while($interador<sizeof($dados)){
			if(!is_numeric($valores[$interador])){
				$preparadorqueryAtributoseValores[]=$dados[$interador]."="."'{$valores[$interador]}'";
			}else{
				$preparadorqueryAtributoseValores[]=$dados[$interador]."=".$valores[$interador];
			}
			$interador++;
		}
		$string=implode(",",$preparadorqueryAtributoseValores);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$update=$conexao->prepare("Update empreendedor set {$string} where idempreendedor=:id;");
			$update->execute(array(
				":id"=>$this->idEmpreendedor,
			));
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		} 
	}
	public function adicionarInvestidor() : bool {

	}
	public function alterarDadosDoProjeto($idProjeto,$dados=array(),$valores=array()) : bool {
		$preparadorqueryAtributoseValores=array();
		$interador=0;
		while($interador<sizeof($dados)){
			if(!is_numeric($valores[$interador])){
				$preparadorqueryAtributoseValores[]=$dados[$interador]."="."'{$valores[$interador]}'";
			}else{
				$preparadorqueryAtributoseValores[]=$dados[$interador]."=".$valores[$interador];
			}
			$interador++;
		}
		$string=implode(",",$preparadorqueryAtributoseValores);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$update=$conexao->prepare("Update projeto set {$string} where idprojeto=:id;");
			$update->execute(array(
				":id"=>$idProjeto,
			));
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		} 
	}
	public function excluirInvestidor(int $idInvestidor, int $idProjeto) : bool {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$excluir=$conexao->prepare("DELETE from projeto_has_investidor where projeto_idprojeto=:idprojeto and investidor_idinvestidor=:idinvestidor;");
			$excluir->execute(array(
				":idprojeto"=>$idInvestidor,
				":idinvestidor"=>$idProjeto
			));
			return true;
		} catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	public function excluirProjeto($idProjeto){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$dinheiro_investido=$conexao->prepare("Select quantidadeinvestida,investidor_idinvestidor from projeto_has_investidor where projeto_idprojeto:id");
			$dinheiro_investido->execute(array(
				":id"=>2
			));
			$dinheiro=$dinheiro_investido->fetch(PDO::FETCH_COLUMN);
			$tiradinheiroinvestido=$conexao->prepare("update investidor set orcamentoinvestido=orcamentoinvestido - :dinheiro where idinvestidor=:id");
				$tiradinheiroinvestido->execute(array(
				":id"=>$idProjeto,
			));
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}	
/* 
	public function verificarRequisicoes() : void {
	}
	public function procurarInvestidor($nome){

	}
	public function indicarProjeto( $investidor,  $projeto) : boolean {

	}
 */
}
/* 
 $em=new Empreendedor('','adasd@adsdas','fkonline','coxinha','perto de ti','12312','sinal de fumaça','automotivo');
//$projeto= new Projeto(1,'outrocoisa','caça e pesca',true,0,10,'informatica',1);
//$em->criarProjeto($projeto);
//$em->excluirInvestidor(1,1);
$atualizar=['nome','descricao','avaliacao'];
$dados=['restaurador de pratas ','restaurar moedas antigas',20];
$em->alterarDadosDoProjeto(3,$atualizar,$dados); 
*/
