<?php  
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});

use Classes\Usuario;
use Classes\Bd;

class Investidor extends Usuario {
	private $idInvestidor;
	private $disponibilidade; // Isso seria para a parte de receber ou não indicações.
	private $indicacoes;// implementar depois
	private $orcamentoInvestido;
	private $parcerias; // implementar depois 
	private $pedidosDeParcerias;// implementar depois 


	public function __construct(String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse, $disponibilidade=true,$orcamentoInvestido=0, $imagem="", $id_investidor="") {
		$this->idInvestidor=$id_investidor;
		$this->disponibilidade = $disponibilidade;		
		//$this->indicacoes = array();
		$this->orcamentoInvestido = $orcamentoInvestido;
		$this->parcerias = array();
		//$this->pedidosDeParcerias = array();
		parent::__construct($nome,$email, $login,$senha,$localizacao,$telefone, $outrosMeiosDecontato,$areaInteresse,$imagem="");
}
	public function cadastrar(){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$cadastrar=$conexao->prepare("insert into investidor (nome, email,login, senha, localizacao, telefone, outrosmeiosdecontato, areaatuacao, disponibilidade, orcamentoinvestido) values (:nome, :email, :login, :senha, :localizacao, :telefone, :outrosmeiosdecontato, :areaatuacao, :disponibilidade, :orcamentoinvestido)
			");
			$cadastrar->execute(array(
				":nome" =>$this->nome,
				":email" =>$this->email,
				":login" =>$this->login,
				":senha" =>$this->senha,
				":localizacao"=>$this->localizacao,
				":telefone"=>$this->telefone,
				":outrosmeiosdecontato"=>$this->outrosMeiosDecontato,
				":areaatuacao"=> $this->areaInteresse,
				":disponibilidade"=>$this->disponibilidade,
				":orcamentoinvestido" =>$this->orcamentoInvestido,
			));
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function listarProjetos() {		

	}

	public function atualizarDados($dados=array(),$valores=array()) : bool {
		$preparadorqueryAtributoseValores=array();
		$interador=0;
		while($interador<sizeof($dados)){
			if(!is_numeric($valores[$interador])){
				$preparadorqueryAtributoseValores[]=$dados[$interador]."="."'{$valores[$interador]}'";
			}else{
				$preparadorqueryAtributoseValores[]=$dados[$interador]."=".$valores[$interador];
			}
			$interador++;
		}
		$string=implode(",",$preparadorqueryAtributoseValores);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$update=$conexao->prepare("Update investidor set {$string} where idinvestidor=:id");
			$update->execute(array(
				":id"=>$this->idInvestidor,
			));
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		} 
	}
	public function investirEmProjeto(int $idProjeto, $valor) : bool {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$busca=$conexao->prepare("select * from projeto where idprojeto = :id;");
			$busca->execute(array(
				":id"=>$idProjeto,
			));
			$projeto=$busca->fetchAll(PDO::FETCH_OBJ);
			$somandoorcamento = $projeto->_get('orcamento'); //pega o orcamento do objeto para somar abaixo:
			$somandoorcamento += $valor;
			$updateOrcamentoProjeto = $conexao->prepare("update orcamento set {$somandoorcamento} where idprojeto = :id");
			$updateOrcamentoProjeto->execute(array(
				":id"=>$idProjeto
			));
			$busca = $conexao->prepare("select quantidadeinvestida from projeto_has_investidor where investidor_idinvestidor = :id");
			$busca->execute(array(
				"id"=>$this->idInvestidor
			));
			$InvestimentoAtualNoProjeto = $busca->fetch(); // Essa soma a seguir seria possível assim? pq teria retonar um valor, não sei bem sobre fetch.
			$InvestimentoAtualNoProjeto += $valor;
			// Verificar se a query a seguir é válida:
			$update = $conexao->prepare("update from projeto_has_investidor quantidadeinvestida set {$InvestimentoAtualNoProjeto} where investidor_idinvestidor = :id");
			$update->execute(array(
				":id"=>$this->idInvestidor
			));
						
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function solicitarParceria() : void {
			// implementar depois 
	}

	public function confirmarParceria() : bool {
		 //implementar depois
	}
	public function mostrarPedidosDeParceria() : void {
			//implementar depois
	}

	public function retirarInvestimento(){
		
	}

}

 /* 
$Investidor = new Investidor('joyce', 'joyce@gmail.com', 'joy', '123', 'currais novos', '9999-9999', 'link', 'TI');
//$Investidor->cadastrar(); 
//$Investidor->atualizarDados('login', 'novo');
 $att = ['nome', 'email', 'senha'];
$dados = ['lalala', 'lalala@gmail.com', '1234'];
$Investidor->atualizarDados($att, $dados); */
 
?>