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
	}
	public function AvaliarProjetos($idProjeto,$avaliacao){

	}
	public function BuscarProjetos(){

	}
}
