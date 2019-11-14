<?php  

require_once('Usuario.php');

class Empreendedor extends Usuario {

	private $requisicoes_investimento;

	public function __construct(string $nome,  string $email, string $login, string $senha, string $localizacao, string $area_atuacao) {
		$this->requisicoes_investimento = array;
		parent::__construct($nome, $email, $login, $senha, $localizacao, $area_atuacao);
	}

	public function criarProjeto() : bool {

	}

	public function procurarInvestidor($nome) : array {

	}

	public function indicarProjeto(Investidor $investidor, Projeto $projeto) : bool {

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
?>
