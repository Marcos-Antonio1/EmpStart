<?php
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});
use PDO;
use PDOException;
use Classes\Usuario;
use Classes\Bd;
use Classes\Projeto;
use JsonSerializable;
use Classes\Investidor;

class Empreendedor extends Usuario implements JsonSerializable{
	private $idEmpreendedor;
	private $requisicoes_investimento;
	public $projetos=array();
	public function __construct(String $nome, String $email, String $login, String $senha, String $localizacao,  String $telefone,  $outrosMeiosDecontato,$areaInteresse,$idEmpreendedor='',$imagem="") {
		$this->requisicoes_investimento = array();
		$this->idEmpreendedor=$idEmpreendedor;
		parent::__construct( $nome,  $email, $login, $senha,$localizacao,$telefone,$outrosMeiosDecontato,$areaInteresse,$imagem);
		$projetos=array();
	}
	public function __get($nome){
		return $this->$nome;
	}
	public function criarProjeto(Projeto $projeto)  {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$cadastrar=$conexao->prepare("insert into projeto(nome,descricao,disponibilidade_para_investimentos,orcamento,avaliacao,areaatuacao,fk_empreendedor_projeto,imagem)values(:nome,:descricao,:disponibilidade,:orcamento,:avaliacao,:areaatuacao,:fk_empreendedor_projeto,:imagem)
			");
			$cadastrar->execute(array(
				":nome" =>$projeto->__get('nome'),
				":descricao" =>$projeto->__get('descricao'),
				":disponibilidade" =>$projeto->__get('disponibilidade_para_investimentos'),
				":orcamento" => $projeto->__get('orcamento'),
				":avaliacao"=>0,
				":areaatuacao"=> $projeto->__get('areaatuacao'),
				":fk_empreendedor_projeto" =>$this->idEmpreendedor,
				":imagem"=>$projeto->__get('imagem'),
			));
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function cadastrar()
	{	
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$inserir=$conexao->prepare("insert into empreendedor(nome,email,login,senha,localizacao,telefone,outrosmeiosdecontato,areaatuacao,imagem) VALUES(:nome,:email,:login,:senha,:localizacao,:telefone,:outrosmeiosdecontato,:areaInterese,:imagem);");
			$inserir->execute(array(
				":nome"=>$this->nome,
				":email"=>$this->email,
				":login"=>$this->login,
				":senha"=>$this->senha,
				":localizacao"=> $this->localizacao,
				":telefone"=>$this->telefone,
				":outrosmeiosdecontato"=>$this->outrosMeiosDecontato,
				":areaInterese"=>'qualquer',
				":imagem"=>$this->imagem,
				
			));
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function CarregarProjetos() // carrega todos os projetos do banco para o array de projetos do usuario 
	{		
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$listar=$conexao->prepare("select * from projeto where fk_empreendedor_projeto = :id");
			$listar->execute(array(
				":id"=>$this->idEmpreendedor,
			)); 
			$projetos=$listar->fetchAll(PDO::FETCH_OBJ);
			foreach($projetos as $projeto){
				//String $nome, String $descricao, bool $disponibilidade_para_investimentos,string $areaAtuacao,$imagem="",$fk_empreendedor_projeto='',$idprojeto='',float $orcamento=0,$avaliacao=''
				$proje= new Projeto($projeto->nome,$projeto->descricao,$projeto->disponibilidade_para_investimentos,$projeto->areaatuacao,$projeto->imagem,$projeto->fk_empreendedor_projeto,$projeto->idprojeto,$projeto->orcamento,$projeto->avaliacao);
				$this->projetos[]=$proje;
			}
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function listarProjetos(){
		$this->CarregarProjetos();
		 return $this->projetos;	
	}
	public function atualizarDados( $dados,$valores) { 
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$query1=["update Empreendedor set ","$dados"," = ","$valores","where idempreendedor = ","$this->idEmpreendedor"];
		$ini=implode("",$query1); 
		try{
			$atualizar=$conexao->prepare($ini); 
			$atualizar->execute();
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
		 public function verificarRequisicoes() : void {
			$pdo=new Bd();
			$conexao=$pdo->abrirConexao();
			try{
				$busca=$conexao->prepare("Select * from projeto where  fk_empreendedor_projeto=:id");
				$busca->execute(array(
					":id"=>$this->idEmpreendedor,
				));
				$resultado=$busca->fetchAll(PDO::FETCH_OBJ);
				$investimentos=array();
				foreach($resultado as $resul){
					$requi=$conexao->prepare("select * from projeto_has_investidor where projeto_idprojeto= :id and investimentoativo= false");
					$requi->execute(array(
						":id"=>$resul->idprojeto,
					));
					$projetovindo=$requi->fetchAll(PDO::FETCH_OBJ);
						$investimento[]=$projetovindo;
					}
					foreach($investimento as $inves){
						foreach($inves as $in){
							if(!count(get_object_vars($in)) == 0){
								$this->requisicoes_investimento[]=$in;
					}
				}
				} 	
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		} 
	public function adicionarInvestidor($idProjeto,$idInvestidor) : bool {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$add=$conexao->prepare("UPDATE projeto_has_investidor set investimentoativo= true where projeto_idprojeto=:idprojeto and investidor_idinvestidor=:idinvestidor");
			$add->execute(array(
				":idprojeto"=>$idProjeto,
				"idinvestidor"=>$idInvestidor
			));
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}	
	public function alterarDadosDoProjeto($idProjeto,$dados,$valores) : bool {
		$idProjeto=intval($idProjeto);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$query1=["update projeto set ","$dados"," = ","'$valores'","where idprojeto = ",$idProjeto];
		$ini=implode("",$query1); 
		try{
			$atualizar=$conexao->prepare($ini); 
			$atualizar->execute();
			return true;
		}catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
					 
	}
	public function excluirInvestidor(int $idInvestidor, int $idProjeto) : bool {
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$excluir=$conexao->prepare("DELETE from projeto_has_investidor where projeto_idprojeto=:idprojeto and investidor_idinvestidor=:idinvestidor");
			$excluir->execute(array(
				":idprojeto"=>$idProjeto,
				":idinvestidor"=>$idInvestidor
			));
			return true;
		} catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	public function excluirProjeto($idProjeto){
		$idProjeto=intval($idProjeto);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$excluirDependenciaProjeto_investidor_has_projeto=$conexao->prepare("DELETE FROM projeto_has_investidor where projeto_idprojeto= :id
			");
			$excluirDependenciaProjeto_investidor_has_projeto->execute(array(
				":id"=>$idProjeto,
			));
			$excluirdependencia1=$conexao->prepare("DELETE FROM avaliacao_investidor
			WHERE projeto_idprojeto= :id ;");
			$excluirdependencia1->execute(array(
				":id"=>$idProjeto,
			));
			$excluirdependencia2=$conexao->prepare("DELETE FROM avaliacao_empreendedor
			WHERE projeto_idprojeto= :id ;");
			$excluirdependencia2->execute(array(
				":id"=>$idProjeto,
			));
			$excluirProjeto=$conexao->prepare("DELETE FROM projeto where idprojeto=:id");
			$excluirProjeto->execute(array(
				":id"=>$idProjeto,
			));	
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function alterarDisponibilidadeDoProjeto($idProjeto,$valor){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
		   $mudar=$conexao->prepare("update projeto set disponibilidade_para_investimentos = :valor where idprojeto=:idProjeto");
			$mudar->execute(array(
				":valor"=>$valor,
				":idProjeto"=>$idProjeto
			));
		}catch(PDOException $e){

		}
	}
	public function avaliarProjetos($idProjeto,$avaliacao){
		$idProjeto=intval($idProjeto);
		$avaliacao=intval($avaliacao);
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		$update=$conexao->prepare("update Projeto Set avaliacao= avaliacao+ :avaliacao where idprojeto= :id;");
		try{
			$update->execute(array(
				":avaliacao" =>$avaliacao,
				":id"=>$idProjeto
			));
		$registraravaliacao=$conexao->prepare("INSERT INTO avaliacao_empreendedor(
			empreendedor_idempreendedor, projeto_idprojeto)
			VALUES (:idinvestidor,:idprojeto)");
			$registraravaliacao->execute(array(
				":idinvestidor"=>$this->idEmpreendedor,
				":idprojeto"=>$idProjeto,
			));
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	public function jsonSerialize() {
        return [
			'idEmpreendedor'=>$this->idEmpreendedor,
			'nome'=>$this->nome,
			'localizacao'=>$this->localizacao,
			'telefone'=>$this->telefone,
			'outrosmeiosdecontato'=>$this->outrosMeiosDecontato,
			'areainterese'=>$this->areaInteresse,
			'imagem'=>$this->imagem,
			'projeto'=>$this->projetos,
			'requisicoes'=>$this->requisicoes_investimento,
		];
	}
}
 
//$em=new Empreendedor('adasd@adsdas','fkonline','coxinha06','perto de ti','12312','sinal de fumaça','automotivo',4);
//$em= new Empreendedor('adsdsa','adsda','adsda','dasda','dsasda','212321','ddasd','asdas',1);
 //$em->cadastrar();
 //$projeto= new Projeto(1,'outrocoisa','caça e pesca',true,0,10,'informatica',1);
//$em->criarProjeto($projeto);
//$em->excluirInvestidor(2,2);
//$atualizar=['nome','email'];
//$dados=['pinheiro','eusdsad@gmail.com.br'];
//$em->atualizarDados($atualizar,$dados);
//$em->alterarDadosDoProjeto(12,$atualizar,$dados); 
//$em->excluirProjeto(12);
//$em->excluirInvestidor(3,2);
//$em->listarProjetos();
//$em->verificarRequisicoes();
//var_dump($em->__get('requisicoes_investimento'));
//$em->adicionarInvestidor(2,2);
//$em->verificarRequisicoes(); 
//$em->avaliarProjetos(4,10);
//$em->alterarDisponibilidadeDoProjeto(2,true);
//$em->buscarTudo("qualquer");
//$em->buscarPorProjeto("m");
//$em->buscarEmpreendedor("m");
//$em->buscarInvestidor("M");