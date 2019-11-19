<?php
namespace Classes;
require_once("Projeto.php");
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

	public function __construct( $idEmpreendedor = "" ,String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse,$imagem="") {
		$this->requisicoes_investimento = array();
		parent::__construct( $nome,  $email, $login, $senha,$localizacao,$telefone,$outrosMeiosDecontato,$areaInteresse,$imagem);
		$projetos=array();
	}
	public function criarProjeto(Projeto $projeto)  {
		var_dump($projeto);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$cadastrar=$conexao->prepare("insert into projeto(nome,descricao,disponibilidade_para_investimentos,orcamento,avaliacao,areaatuacao,fk_empreendedor_projeto)values(:nome,:descricao,:disponibilidade,:oracamento,:avaliacao,:areaatuacao,:fk_empreendedor_projeto);
			");
			$cadastrar->execute(array(
				":nome" =>$projeto->nome,
				":descricao" =>$projeto->descricao,
				":disponibilidade" =>$projeto->disponibilidade_para_investimentos,
				":orcamento" => $projeto->orcamento,
				":avaliacao"=>0,
				":areaatuacao"=> $this->areaInteresse,
				":fk_empreendedor_projeto" =>1,
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

	public function atualizarDados( $dados=array(),$valores=array())
	{

	}

	public function procurarInvestidor($nome){

	}
	public function indicarProjeto( $investidor,  $projeto) : boolean {

	}

	public function alterarDadosDoProjeto() : bool {

	}

	public function excluirInvestidor(Investidor $investidor, Projeto $projeto) : bool {

	}

	public function verificarRequisicoes() : void {

	}
	public function adicionarInvestidor() : bool {

	}
}
$em=new Empreendedor('ca','adasd@adsdas','fkonline','coxinha','perto de ti','12312','sinal de fumaça','automotivo');
$projeto= new Projeto(1,'qualquer','caça e pesca',true,0,10,'inovação',1);
$em->criarProjeto($projeto);
?>
