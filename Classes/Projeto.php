<?php  
namespace Classes;
spl_autoload_register(function($classname){
	require_once str_replace("Classes\\","","Classes\Usuario") .".php";
});

class Projeto{
<<<<<<< HEAD
	//private $telefone;
	//private $email;
	//private $area_atuacao;
	private $avaliacao=array();
=======

	//private $telefone;
	//private $email;
	//private $area_atuacao;
	//private $investidores;
	//private $avaliacao;
>>>>>>> 52e39c40020cbf9295ebf42d3d1e38a9e73970cd
	private $nome;
	private $descricao;
	private $disponibilidade_investimentos;
	private $investidores;
	private $empreendedor;
	private $orcamento;
	
<<<<<<< HEAD
	public function __construct( string $nome, string $telefone, string $email, string $area_atuacao, string $descricao) {
=======
	public function __construct(Empreendedor $empreendedor, string $nome, string $telefone, string $email, string $area_atuacao, string $descricao) {
		$this->empreendedor = $empreendedor;
>>>>>>> 52e39c40020cbf9295ebf42d3d1e38a9e73970cd
		$this->$nome = $nome;
		$this->$telefone = $telefone;
		$this->$email = $email;
		$this->area_atuacao = $area_atuacao;
		$this->descricao = $descricao;
<<<<<<< HEAD
		$this->investidores = array();
		$this->avaliacao = array(); //Array de estrelas.
=======
		$this->investidores = array;
		$this->avaliacao = array; //Array de estrelas.
>>>>>>> 52e39c40020cbf9295ebf42d3d1e38a9e73970cd
		$this->orcamento = 0;
	}

	public function get($propriedade) {
		return $this->{$propriedade};
	}

	public function set($propriedade, $new) {
		$this->{$propriedade} = $new;
	}

	public function adicionarInvestidor() : bool {

	}

	public function removerInvestidor() : bool {

	}
<<<<<<< HEAD

	public function receberInvestimento() : void {

	}

	public function mostrarOrcamento() {

	}

=======

	public function receberInvestimento() : void {

	}

	public function mostrarOrcamento() {

	}

>>>>>>> 52e39c40020cbf9295ebf42d3d1e38a9e73970cd
}

?>