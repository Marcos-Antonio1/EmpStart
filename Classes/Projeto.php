<?php  


class Projeto{

	//private $telefone;
	//private $email;
	//private $area_atuacao;
	//private $investidores;
	//private $avaliacao;
	private $nome;
	private $descricao;
	private $disponibilidade_investimentos;
	private $investidores;
	private $empreendedor;
	private $orcamento;
	
	public function __construct(Empreendedor $empreendedor, string $nome, string $telefone, string $email, string $area_atuacao, string $descricao) {
		$this->empreendedor = $empreendedor;
		$this->$nome = $nome;
		$this->$telefone = $telefone;
		$this->$email = $email;
		$this->area_atuacao = $area_atuacao;
		$this->descricao = $descricao;
		$this->investidores = array;
		$this->avaliacao = array; //Array de estrelas.
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

	public function receberInvestimento() : void {

	}

	public function mostrarOrcamento() {

	}

}

?>