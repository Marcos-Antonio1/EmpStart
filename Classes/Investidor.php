<?php  
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});

use Classes\Usuario;
use Classes\Bd;

class Investidor extends Usuario {
	private $idInvestidor;
	private $disponibilidade; // Isso seria para a parte de receber ou não indicações.
	private $indicacoes;// implementar depois
	private $orcamentoInvestido;
	private $parcerias; // implementar depois 
	private $pedidosDeParcerias;// implementar depois 


	public function __construct($id_investidor="",String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse,$imagem="",$disponibilidade=true,$orcamentoInvestido=0) {
		$this->idInvestidor=$id_investidor;
		$this->disponibilidade = $disponibilidade;		
		//$this->indicacoes = array();
		$this->orcamentoInvestido = $orcamentoInvestido;
		$this->parcerias = array();
		//$this->pedidosDeParcerias = array();
		parent::__construct($nome,$email, $login,$senha,$localizacao,$telefone, $outrosMeiosDecontato,$areaInteresse,$imagem="");
}
	public function cadastrar(){

	}
	public function listarProjetos()
	{
		
	}
	public function atualizarDados(){

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

}




?>