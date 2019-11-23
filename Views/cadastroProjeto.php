<<<<<<< HEAD
<?php
namespace Controladores;
spl_autoload_register(function($classname){
    $dir= str_replace("/Controladores","/",__DIR__);
    require_once $dir .str_replace("\\","/",$classname).".php";
});
=======
<?php include "template/header.php"?>

<div class="card" style="margin: 40px" style="margin-top: 80px">
  <form class="container" style="margin: 30px;" method="POST" action="#">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nome">Nome do Projeto</label>
            <input type="text" class="form-control" id="nome" placeholder="Digite o nome do projeto" required="required">
          </div>
      <div class="form-group col-md-4">
        <label for="area">Área do Projeto</label>
        <select id="area" class="form-control" required="required">
          <option selected>Selecione uma área</option>
          <option>...</option>
        </select>
      </div>
      <div class="form-group col-md-9">
        <label for="descricao">Descrição do Projeto</label>
        <textarea class="form-control" id="descricao" rows="5" placeholder="Faça uma descrição sobre seu projeto"></textarea>
    </div>
    </div>
    <h6 for="">Inicar projeto com disponibilidade para investimentos: </h6>
    <div class="form-check-inline">
        <input class="form-check-input" type="radio" name="tipo" id="Empreendedor" value="opcao1" checked>
        <label class="form-check-label" for="Empreendedor">
          Disponível
        </label>
      </div>
      <div class="form-check-inline">
        <input class="form-check-input" type="radio" name="tipo" id="Investidor" value="opcao2">
        <label class="form-check-label" for="Investidor">
          Não disponível
        </label>
    </div>
    <br><br><button type="submit" class="btn btn-info">Cadastrar Projeto</button>
  </form>
</div>
</body>
<?php include "template/footer.php"?>
>>>>>>> b4e976e6381b28176b70d0a31ed7b3a082cca2e0
