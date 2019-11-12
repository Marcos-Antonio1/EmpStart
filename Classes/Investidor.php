<?php  

require_once('Usuario.php');

class Investidor extends Usuario {

	private $disponibilidade; // Isso seria para a parte de receber ou não indicações.

	public function __construct(string $nome, string $telefone,  string $email, string $areas_interesse, string $descricao, string $localizacao) {
		$this->disponibilidade = true;
		parent::__construct($nome, $telefone, $email, $areas_interesse, $descricao, $localizacao);
	}
}





?>