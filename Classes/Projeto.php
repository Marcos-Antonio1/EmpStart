<?php  


class Projeto{

	private $nome;
	private $telefone;
	private $email;
	private $area_atuacao;
	private $descricao;
	private $investidores;
	private $avaliacao;

	public function __construct(string $nome, string $telefone, string $email, string $area_atuacao, string $descricao) {
		$this->$nome = $nome;
		$this->$telefone = $telefone;
		$this->$email = $email;
		$this->area_atuacao = $area_atuacao;
		$this->descricao = $descricao;
		$this->investidores = [];
		$this->avaliacao = []; //Array de estrelas.
	}

	public function get($propriedade) {
		return $this->{$propriedade};
	}

	public function set($propriedade, $new) {
		$this->{$propriedade} = $new;
	}




}



?>