<?php  

require_once('Usuario.php');

class Investidor extends Usuario {

	private $disponibilidade; // Isso seria para a parte de receber ou não indicações.
	private $indicacoes;
	private $orcamentoInvestido;
	private $parcerias;
	private $pedidosDeParcerias;


	public function __construct(string $nome,  string $email, string $login, string $senha, string $localizacao, string $area_atuacao) {
		$this->disponibilidade = true;		
		$this->indicacoes = array;
		$this->orcamentoInvestido = 0;
		$this->parcerias = array;
		$this->pedidosDeParcerias = array;
		parent::__construct($nome, $email, $login, $senha, $localizacao, $area_atuacao);
}

	public function investirEmProjeto(Projeto $projeto, $valor) : bool {

	}

	public function solicitarParceria() : void {

	}

	public function confirmarParceria() : bool {

	}

	public function mostrarPedidosDeParceria() : void {

	}


}
?>