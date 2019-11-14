<?php  
namespace Classes;
spl_autoload_register(function($classname){
	require_once str_replace("Classes\\","","Classes\Usuario") .".php";
});

use Classes\Usuario;

class Investidor extends Usuario {

	private $disponibilidade; // Isso seria para a parte de receber ou não indicações.
<<<<<<< HEAD
	private $indicacoes;// implementar depois
	private $orcamentoInvestido;
	private $parcerias; // implementar depois 
	private $pedidosDeParcerias;// implementar depois 


	public function __construct(string $nome,  string $email, string $login, string $senha, string $localizacao, string $area_atuacao,$telefone) {
		$this->disponibilidade = true;		
		$this->indicacoes = array();
		$this->orcamentoInvestido = 0;
		$this->parcerias = array();
		$this->pedidosDeParcerias = array();
		parent::__construct($nome, $email, $login, $senha, $localizacao, $area_atuacao,$telefone);
}

	public function investirEmProjeto(int $idProjeto, $valor) : bool {

	}

	public function solicitarParceria() : void {
			// implementar depois 
	}

	public function confirmarParceria() : bool {
		 //implementar depois
	}

	public function mostrarPedidosDeParceria() : void {
			//implementar depois
	}
=======
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
>>>>>>> 52e39c40020cbf9295ebf42d3d1e38a9e73970cd

	}

<<<<<<< HEAD
=======

>>>>>>> 52e39c40020cbf9295ebf42d3d1e38a9e73970cd
}
?>