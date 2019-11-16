<?php
namespace Classes; 
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});
use Classes\Usuario;
use Classes\Bd;
class Empreendedor extends Usuario{

	private $requisicoes_investimento;
	private $projetos;
	public function __construct(string $nome,  string $email, string $login, string $senha, string $localizacao, string $area_atuacao,string $telefone) {
		$this->requisicoes_investimento = array();
		parent::__construct($nome, $email, $login, $senha, $localizacao, $area_atuacao,$telefone);
		$projetos=array();
	}

	public function criarProjeto(string $nome, string $telefone, string $email, string $area_atuacao, string $descricao)  {
		
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

?>
