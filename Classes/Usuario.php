<?php  


abstract class Usuario {

	private $nome;
	private $telefone;
	private $email;
	private $areas_interesse;
	private $descricão;
	private $localizacão;
	// imagem de perfil.


	public function __construct(string $nome, string $telefone,  string $email, string $areas_interesse, string $descricão, string $localizacão) {
		$this->nome = $nome;
		$this->telefone = $telefone;
		$this->email = $email;
		$this->areas_interesse = $areas_interesse; // Aqui vai ter que ser um array. Depois falamos como que vamos fazer. 
		$this->descricao = $descricao;
		$this->localizacão = $localizacão;
	}

	abstract public function get($propriedade) {
		return $this->{$propriedade};
	}

	abstract public function set($propriedade, $new) {
		$this->{$propriedade} = $new;
	}

}


?>