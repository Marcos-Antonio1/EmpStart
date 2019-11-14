<?php  


abstract class Usuario {

	private $nome;
	private $email;
	private $login;
	private $senha;
	private $localizacao;
	private $area_atuacao;
	//private $telefone;
	// imagem de perfil.


	public function __construct(string $nome, string $email, string $login, string $senha, string $localizacao, string $area_atuacao) {
		$this->nome = $nome;
		$this->email = $email;
		$this->login = $login;
		$this->senha = $senha;
		$this->localizacao = $localizacao;
		$this->area_atuacao  = $area_atuacao; // Será uma ou mais de uma? se for mais de 1, é array. 
		
		//$this->telefone = $telefone;
	}

	abstract public function AvaliarProjetos() : void {

	}

	abstract public function BuscarProjetos(): array {

	}

	abstract public function ProcurarUsuarios($nome) : array {

	}

	abstract public function get($propriedade) {
		return $this->{$propriedade};
	}

	abstract public function set($propriedade, $new) {
		$this->{$propriedade} = $new;
	}

}


?>