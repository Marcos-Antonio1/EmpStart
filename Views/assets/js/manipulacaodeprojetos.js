$(document).ready(function(){
    $('.cadastro-projeto').click(function(){       
        $('.formulario').hide();
        $('.cards-projetos').empty();
        $('.cards-projetos').append(`
        <div class="card border-0" style="margin: 40px" style="margin-top: 80px">
        <div class="h3 text-center"> Cadastre seu Projeto </div>
        <form class="container border-0" style="margin: 30px;" method="POST" action="../Controladores/cadastroDeProjeto.php" enctype="multipart/form-data">
          <div class="form-row border-0">
              <div class="form-group col-md-6">
                  <label for="nome">Nome do Projeto</label>
                  <input type="text" class="form-control" name ='nome' id="nome" placeholder="Digite o nome do projeto" required="required">
                </div>
            <div class="form-group col-md-4">
              <label for="area">Área do Projeto</label>
              <select id="area" class="form-control" required="required" name ='area'>
              <option value="" disabled selected> Selecione... </option>
                <option>Saúde</option>
                <option>Educação</option>
                <option>TI</option>
                <option>Mercado Imobiliário</option>
                <option>Mobilidade urbana</option>
                <option>Saúde</option>
                <option>Entreterimento</option>
              </select>
            </div>
            <div class="form-group col-md-9">
              <label for="descricao">Descrição do Projeto</label>
              <textarea class="form-control" id="descricao" rows="5" name ='descricao'  placeholder="Faça uma descrição sobre seu projeto"></textarea>
          </div>
          </div>
          <h6 for="">Inicar projeto com disponibilidade para investimentos: </h6>
          <div class="form-check-inline">
              <input class="form-check-input" type="radio" name="tipo" id="disponivel" value="true" checked>
              <label class="form-check-label" for="disponivel">
                Disponível
              </label>
            </div>
            <div class="form-check-inline">
              <input class="form-check-input" type="radio" name="tipo" id="indisponivel" value="false">
              <label class="form-check-label" for="indisponivel">
                Não disponível
              </label>
          </div>
          <br>
          <br>
          <div class="form-group">
            <label for="exampleFormControlFile1">insira uma imagem para seu projeto</label>
            <input type="file" class="form-control-file" id='imgprojeto' name='imagem'>
          </div>
          <br><br><button type="submit" class="cadastrar btn btn-info">Cadastrar Projeto</button>
        </form>
      </div>
      </body>`);
    })
})

