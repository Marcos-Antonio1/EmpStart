<?php 
namespace Classes;
spl_autoload_register(function($classname){
	require_once str_replace("Classes\\","","Classes\Usuario") .".php";
});
class Usuario {
	private $usuarioId;
	private $nome;
	private $email;
	private $login;
	private $senha;
<<<<<<< HEAD
	private $areaLocalizao;
	private $areaInteresse =array();
	private $telefone;

	public function __construct(String $nome, String $email, String $login, String $senha, String $areaLocalizao, $areaInteresse, String $telefone)
	{
		$this->nome= $nome;
		$this->email= $email;
		$this->login= $login;
		$this->senha= $senha;
		$this->areaLocalizao= $areaLocalizao;
		$this->areaInteresse =$areaInteresse;
		$this->telefone=$telefone;
=======
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

>>>>>>> 52e39c40020cbf9295ebf42d3d1e38a9e73970cd
	}
	public function AvaliarProjetos($idProjeto,$avaliacao){

	}
	public function BuscarProjetos(){

	}
}
