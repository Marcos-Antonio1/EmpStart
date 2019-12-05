<?php  
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});

use Classes\Usuario;
use Classes\Projeto;
use Classes\Empreendedor;
use Classes\Bd;	
use PDO;
use PDOException;
use JsonSerializable;

class Investidor extends Usuario implements JsonSerializable {
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
		parent::__construct($nome,$email, $login,$senha,$localizacao,$telefone, $outrosMeiosDecontato,$areaInteresse,$imagem);
}
	public function __get($nome){
		return $this->$nome;
	}
	public function cadastrar(){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$cadastrar=$conexao->prepare("insert into investidor (nome, email,login, senha, localizacao, telefone, outrosmeiosdecontato, areaatuacao, disponibilidade, orcamentoinvestido,imagem) values (:nome, :email, :login, :senha, :localizacao, :telefone, :outrosmeiosdecontato, :areaatuacao, :disponibilidade, :orcamentoinvestido,:imagem)
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
				":imagem"=>$this->imagem,
			));
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function listarProjetos() {		
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscaidProjetos=$conexao->prepare("select projeto_idprojeto from projeto_has_investidor where investidor_idinvestidor=:id and investimentoativo =true");
			$buscaidProjetos->execute(array(
				":id"=>$this->idInvestidor,
			));
			$idsProjetos=$buscaidProjetos->fetchAll(PDO::FETCH_NUM);
			 foreach($idsProjetos as $idProjeto){
				 $buscarProjeto=$conexao->prepare("SELECT * from projeto where idprojeto= :id");
				 $buscarProjeto->execute(array(
					 ":id"=>$idProjeto[0],
				 ));
				 $projeto=$buscarProjeto->fetch(PDO::FETCH_OBJ);
				 $proje= new Projeto($projeto->nome,$projeto->descricao,$projeto->disponibilidade_para_investimentos,$projeto->areaatuacao,$projeto->imagem,$projeto->fk_empreendedor_projeto,$projeto->idprojeto,$projeto->orcamento,$projeto->avaliacao);
				 $this->projetosInvestidos[]=$projeto;
				}
			 
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function atualizarDados( $dados,$valores) { 
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$query1=["update investidor set ","$dados"," = ","$valores","where idinvestidor = ","$this->idInvestidor"];
		$ini=implode("",$query1); 
		try{
			$atualizar=$conexao->prepare($ini); 
			$atualizar->execute();
		}catch(PDOException $e){
			echo $e->getMessage();
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
		$idPaceirodaSolicitacao=intval($idPaceirodaSolicitacao);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
		$confirmar=$conexao->prepare("update investidor_has_investidor set estadoparceria= true where investidor_idinvestidor1= :idParceiro  and  investidor_idinvestidor2= :id");
		$confirmar->execute(array(
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
			$buscarPedidos=$conexao->prepare("Select  investidor_idinvestidor1 from investidor_has_investidor where investidor_idinvestidor2=:id and estadoparceria= false");
			$buscarPedidos->execute(array(
				":id"=>$this->idInvestidor,
			));
			$idspedidosinvestimentos=$buscarPedidos->fetchAll(PDO::FETCH_NUM);
			foreach($idspedidosinvestimentos as $ids){
				$buscarinvestidores=$conexao->prepare("Select idinvestidor,nome,localizacao,areaatuacao,imagem from investidor where idinvestidor=:id");
				$buscarinvestidores->execute(array(
					":id"=>$ids[0],
				));
					$resultado=$buscarinvestidores->fetchAll(PDO::FETCH_OBJ);
					foreach($resultado as $result){
						$this->pedidosDeParcerias[]=$result;
					}
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
	public function mostrarPaceiros(){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscar=$conexao->prepare("select  investidor_idinvestidor1,investidor_idinvestidor2  from investidor_has_investidor where  investidor_idinvestidor1 = :id  and estadoparceria= :condicao or investidor_idinvestidor2= :id  and estadoparceria= :condicao ");
			$buscar->execute(array(
				":id"=>$this->idInvestidor,
				":condicao"=>true,
			));
			$valores=$buscar->fetchAll(PDO::FETCH_NUM);
			$ids=array();
			foreach($valores as $valor){
				foreach($valor as $var){
					if($var!=$this->idInvestidor){
						$ids[]=$var;					}
				}
			}
			foreach($ids as $id){
				$buscarPareceiros=$conexao->prepare("select idinvestidor,nome,email,localizacao,telefone,imagem from investidor where idinvestidor=:id");
				$buscarPareceiros->execute(array(
					":id"=>$id,
				));
				$parceiro=$buscarPareceiros->fetch(PDO::FETCH_OBJ);
				$this->parcerias[]=$parceiro;
			}
		}catch(PDOException $e){	
			echo $e->getMessage();
		}	
	}
	public function desfazerParceria($idParceria){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$desfazer=$conexao->prepare("delete from investidor_has_investidor where investidor_idinvestidor1= :id and investidor_idinvestidor2= :idP or investidor_idinvestidor1= :idP and investidor_idinvestidor2=:id");
			$desfazer->execute(array(
				":id"=>$this->idInvestidor,
				":idP"=>$idParceria,
			));
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function avaliarProjetos($idProjeto,$avaliacao){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$update=$conexao->prepare("update Projeto Set avaliacao= avaliacao+ :avaliacao where idprojeto= :id;");
		try{
			$update->execute(array(
				":avaliacao" =>$avaliacao,
				":id"=>$idProjeto
			));
		$registraravaliacao=$conexao->prepare("INSERT INTO avaliacao_investidor(
			investidor_idinvestidor, projeto_idprojeto)
			VALUES (:idinvestidor,:idprojeto)");
			$registraravaliacao->execute(array(
				":idinvestidor"=>$this->idInvestidor,
				":idprojeto"=>$idProjeto,
			));
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function jsonSerialize() {
        return [
			'idInvestidor'=>$this->idInvestidor,
			'orcamentoInvestido'=>$this->orcamentoInvestido,
			'parcerias'=> $this->parcerias,
			'pedidosDepacerias'=>$this->pedidosDeParcerias,
			'projetosInvestidos'=>$this->projetosInvestidos,
			'nome'=>$this->nome,
			'email'=>$this->email,
			'telefone'=>$this->telefone,
			'localizacao'=>$this->localizacao,
			'imagem'=>$this->imagem
		];
	}
	
}
/* 
$inv=new Investidor('marcos ','dada','dasdas','12232','dadasdas','d123132','dadasda','dasda',true,0,'dasda',1);
$inv->mostrarPaceiros();
var_dump(json_encode( $inv->__get('parcerias'))); */
?>