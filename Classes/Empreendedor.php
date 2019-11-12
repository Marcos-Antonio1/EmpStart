<?php  

require_once('Usuario.php');

class Empreendedor extends Usuario {

	public function __construct(string $nome, int $telefone,  string $email, string $areas_interesse, string $descricao, string $localizacao) {
		parent::__construct($nome, $telefone, $email, $areas_interesse, $descricao, $localizacao);
	}
}


?>
