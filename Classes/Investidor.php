<?php  
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});

use Classes\Usuario;
use Classes\Bd;
use PDO;
use PDOException;

class Investidor extends Usuario {
	private $idInvestidor;
	private $disponibilidade; // Isso seria para a parte de receber ou não indicações.
	private $orcamentoInvestido;
	private $parcerias;  
	private $pedidosDeParcerias; 
	private $projetosInvestidos;

	public function __construct(String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone, String $outrosMeiosDecontato,$areaInteresse, $disponibilidade=true,$orcamentoInvestido=0,$imagem='',$id_investidor='') {
		$this->idInvestidor=$id_investidor;
		$this->disponibilidade = $disponibilidade;		
		$this->orcamentoInvestido = $orcamentoInvestido;
		$this->parcerias = array();
		$this->pedidosDeParcerias = array();
		$this->prejetosInvestidos=array();
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
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscaidProjetos=$conexao->prepare("select projeto_idprojeto from projeto_has_investidor where investidor_idinvestidor=:id");
			$buscaidProjetos->execute(array(
				":id"=>$this->idInvestidor,
			));
			$idsProjetos=$buscaidProjetos->fetchAll(PDO::FETCH_NUM);
			 foreach($idsProjetos as $idProjeto){
				 echo $idProjeto[0];
				 $buscarProjeto=$conexao->prepare("SELECT * from projeto where idprojeto= :id");
				 $buscarProjeto->execute(array(
					 ":id"=>$idProjeto[0],
				 ));
				 $resulProjeto=$buscarProjeto->fetch(PDO::FETCH_OBJ);
				 $projeto=new Projeto($resulProjeto->nome,$resulProjeto->descricao,$resulProjeto->disponibilidade_para_investimentos,$resulProjeto->orcamento,$resulProjeto->avaliacao,$resulProjeto-areaatuacao,$resulProjeto->fk_empreendedor_projeto,$resulProjeto->idprojeto,$resulProjeto->imagem); 
				 $this->projetosInvestidos[]=$projeto;
				}
			 var_dump($this->projetosInvestidos);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
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
			$requisitarinvestimento=$conexao->prepare("insert into projeto_has_investidor(projeto_idprojeto,investidor_idinvestidor,quantidadeinvestida)Values(:idProjeto,:idInvestidor,:valor)");
			$requisitarinvestimento->execute(array(
				":idProjeto"=> $idProjeto,
				":idInvestidor"=> $this->idInvestidor,
				":valor"=>$valor,
			));
			return true;								
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	public function solicitarParceria($idParceiro) : bool {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$solicitarParceria=$conexao->prepare("insert into investidor_has_investidor(investidor_idinvestidor1,investidor_idinvestidor2)values (:idinvestidor,:idparceiro)");
			$solicitarParceria->execute(array(
				":idinvestidor"=>$this->idInvestidor,
				":idparceiro"=>$idParceiro,
			));
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	public function confirmarParceria($idPaceirodaSolicitacao){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
		$confirmar=$conexao->prepare("update investidor_has_investidor set estadoparceria= :estado where investidor_idinvestidor1= :id and  investidor_idinvestidor2= :idParceiro");
		$confirmar->execute(array(
			":estado"=>'true',
			":id"=>$this->idInvestidor,
			":idParceiro"=>$idPaceirodaSolicitacao,
		));
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function mostrarPedidosDeParceria() : void {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscarPedidos=$conexao->prepare("Select investidor_idinvestidor1 from investidor_has_investidor where investidor_idinvestidor2=:id and estadoparceria= :condicao");
			$buscarPedidos->execute(array(
				":id"=>$this->idInvestidor,
				":condicao"=>"false",
			));
			$idspedidosinvestimentos=$buscarPedidos->fetchAll(PDO::FETCH_NUM);
			foreach($idspedidosinvestimentos as $ids){
				$buscarinvestidores=$conexao->prepare("Select idinvestidor,nome,localizacao,areaatuacao,imagem from investidor where idinvestidor=:id");
				$buscarinvestidores->execute(array(
					":id"=>$ids[0],
				));
					$resultado=$buscarinvestidores->fetchAll(PDO::FETCH_OBJ);
					$this->pedidosDeParcerias[]=$resultado;
			}	
		}catch(PDOException $e){
			echo $e->getMessage();
		}			
	}
	public function retirarInvestimento($idProjeto){		
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$excluirInvestimento=$conexao->prepare("DELETE FROM projeto_has_investidor where projeto_idprojeto=:idprojeto and investidor_idinvestidor=:idInvestidor");
			$excluirInvestimento->execute(array(
				":idprojeto"=>$idProjeto,
				":idInvestidor"=>$this->idInvestidor,
			));
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}

/* 
$Investidor = new Investidor('joyce', 'joyce@gmail.com', 'joy', '123', 'currais novos', '9999-9999', 'link', 'TI','123',2,2,2);
$Investidor->listarProjetos(); */
?>