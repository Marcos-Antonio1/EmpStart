<?php include "template/header.php"?>

<div class="card" style="margin: 40px" style="margin-top: 80px">
  <form class="container" style="margin: 30px;" method="POST" action="../Controladores/cadastroUsuario.php" enctype="multipart/form-data" >
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required="required">
          </div>
        <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required">
      </div>
      <div class="form-group col-md-6">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" name="login" placeholder="Login" required="required">
      </div>
      <div class="form-group col-md-6">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required="required">
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Informe seu telefone. Ex: (84) 9999-9999">
      </div>
      <div class="form-group col-md-6">
        <label for="outromeiodecontato">Outros contatos</label>
            <input type="text" class="form-control" id="outromeiodecontato" name="outromeiodecontato" placeholder="facebook, twitter, etc.">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" id="cidade" placeholder="Informe sua cidade. Ex: Rio De Janeio" name="cidade" required="required">
      </div>
      <div class="form-group col-md-4">
        <label for="areainteresse">Area de Interesse</label>
        <select id="areainteresse" name="areainteresse" class="form-control" required="required">
          <option selected>Area de Interesse</option>
            <option>Saúde</option>
            <option>Educação</option>
            <option>TI</option>
            <option>Mercado Imobiliário</option>
            <option>Mobilidade urbana</option>
            <option>Saúde</option>
            <option>Outros</option>
        </select>
      </div>
    </div>
    <div class="form-group mt-3">
      <label for="exampleFormControlFile1">Insira uma imagem de perfil </label>
      <input type="file" class="form-control-file" id='imgprojeto' name='imagem'>
    </div>
    <div class="form-check-inline">
        <input class="form-check-input" type="radio" name="radio" id="empreendedor" value="E" checked>
        <label class="form-check-label" for="Empreendedor">
          Empreendedor
        </label>
      </div>
      <div class="form-check-inline">
        <input class="form-check-input" type="radio" name="radio" id="investidor" value="I">
        <label class="form-check-label" for="Investidor">
          Investidor
        </label>
    </div>
    <br><br><button type="submit" name="Submit" class=" cadastro btn btn-info">Cadastrar</button>
  </form>
</div>
<script>
    $('.cadastro').click(function(){
      alert('Usuário cadastrado com sucesso')
    })
</script>
</body>
<?php include "template/footer.php"?>