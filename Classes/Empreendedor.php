<?php  

require_once('Usuario.php');

class Empreendedor extends Usuario {

	public function __construct(string $nome, int $telefone,  string $email, string $areas_interesse, string $descricão, string $localizacão) {
		parent::__construct($nome, $telefone, $email, $areas_interesse, $descricão, $localizacão);
	}
}


?>
