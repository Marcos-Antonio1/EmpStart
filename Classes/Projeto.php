<?php  
namespace Classes;
spl_autoload_register(function($classname){
	require_once  str_replace("/Classes","/",__DIR__).str_replace("\\","/",$classname).".php";
});

use Classes\Bd;
use Classes\Usuario;
use Classes\Investidor;
use PDO;
use PDOException;

class Projeto{
	private $idprojeto;
	private $nome;
	private $descricao;
	private $disponibilidade_para_investimentos;
	private $orcamento;
	private $avaliacao;
	private $areaatuacao;
	private $fk_empreendedor;
	private $imagem;	
	private $investidores=array();
	
	public function __construct($idprojeto="", String $nome, String $descricao, bool $disponibilidade_para_investimentos,float $orcamento=0,$avaliacao,string $areaAtuacao,$fk_empreendedor_projeto,$imagem="") {
		$this->idprojeto=$idprojeto;
		$this->nome=$nome ;
		$this->descricao=$descricao ;
		$this->areaatuacao=$areaAtuacao;
		$this->avaliacao=$avaliacao;
		$this->disponibilidade_para_investimentos=$disponibilidade_para_investimentos;
		$this->orcamento = $orcamento;
		$this->investidores = array();
		$this->avaliacao = $avaliacao;
		$this->fk_empreendedor=$fk_empreendedor_projeto;
		$this->imagem=$imagem;
		if($idprojeto!=""){
			$this->setarInvestidoresAoObjetoProjeto();
		} 
	}

	public function setarInvestidoresAoObjetoProjeto(){
		$pdo=new Bd();
		$conexao=$pdo->abrirConexao();
		try{
			$buscar=$conexao->prepare("SELECT investidor_idinvestidor FROM projeto_has_investidor where projeto_idprojeto=:id and investimentoativo=true");
			$buscar->execute(array(
				":id"=> $this->idprojeto,
			));
			$id_investidores=$buscar->fetchAll(PDO::FETCH_OBJ);
			foreach($id_investidores as $id_investidor){
				$conexao=$pdo->abrirConexao();
				$selecionar=$conexao->prepare("SELECT * from investidor where idinvestidor=:id");
				$selecionar->execute(array(
					":id"=> $id_investidor->investidor_idinvestidor,
				));
				$investidores=$selecionar->fetchAll(PDO::FETCH_OBJ);
				  foreach($investidores as $investidor){
					 $inves=new Investidor($investidor->idinvestidor,$investidor->nome,$investidor->email,$investidor->login,$investidor->senha,$investidor->localizacao,$investidor->telefone,$investidor->outrosmeiosdecontato,$investidor->areaatuacao,$investidor->imagem,$investidor->disponibilidade,$investidor->orcamentoinvestido);
					 $this->investidores[]=$inves;
					}
			}
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function mostrarInvestidores(){
		var_dump($this->investidores); // implementar para interface gráfica depois
	}

	public function receberInvestimento() : void {

	}

	public function mostrarOrcamento() {

	}

	public function __get($name)
	{
		return $this->$name;
	}
		/* 
	public function adicionarInvestidor() : bool {

	}

	public function removerInvestidor() : bool {

	}
 */
}

/* $projeto=new Projeto(2,'sdas','dasda',true,12,'sadasd','21312',1);
$projeto->setarInvestidoresAoObjetoProjeto();
$projeto->mostrarInvestidores();
 */
?>