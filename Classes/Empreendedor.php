<?php
namespace Classes;
 
spl_autoload_register(function($classname){
	require_once str_replace("Classes\\","","Classes\Usuario") .".php";
});
use Classes\Usuario;
use Classes\Projeto;
class Empreendedor extends Usuario{

	private $requisicoes_investimento;
	private $projetos;
	public function __construct(string $nome,  string $email, string $login, string $senha, string $localizacao, string $area_atuacao,string $telefone) {
		$this->requisicoes_investimento = array();
		parent::__construct($nome, $email, $login, $senha, $localizacao, $area_atuacao,$telefone);
		$projetos=array();
	}

	public function criarProjeto(string $nome, string $telefone, string $email, string $area_atuacao, string $descricao)  {
		$projeto=new Projeto($nome,$telefone,$email,$area_atuacao,$descricao);
		array_push($this->projetos,$projeto);
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
	public function mostrarTodosOsProjetos(){
		var_dump($this->projetos);
	}
}
$user=new Usuario('asad','adsda','adsdas','dasda','adsdad','23121','dasda');
$user->criarProjeto('add','adsda','321','312312','adsda');
$user->mostrarTodosOsProjetos();
?>
