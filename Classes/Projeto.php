<?php  


class Projeto{

	private $nome;
	private $telefone;
	private $email
	private $area_atuação;
	private $descricao;
	private $investidores;
	private $avaliacao;

	public function __construct(string $nome, string $telefone, string $email, string $area_atuação, string $area_atuação) {
		$this->$nome = $nome;
		$this->$telefone = $telefone;
		$this->$email = $email;
		$this->area_atuação = $area_atuação;
		$this->descricao = 
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