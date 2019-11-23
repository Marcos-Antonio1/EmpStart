<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="Views/assets/css/site.css">
  <title>home</title>
</head>
<div class="card" style="margin: 40px">
  <form class="container" style="margin: 30px;" method="POST" action="#">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" required="required">
          </div>
        <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" required="required">
      </div>
      <div class="form-group col-md-6">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" placeholder="Login" required="required">
      </div>
      <div class="form-group col-md-6">
        <label for="senha">Senha</label>
        <input type="password" class="form-control" id="senha" placeholder="Senha" required="required">
      </div>
      <div class="form-group col-md-6">
        <label for="inputAddress2">Telefone</label>
        <input type="text" class="form-control" id="telefone" placeholder="Informe seu telefone. Ex: (84) 9999-9999">
      </div>
      <div class="form-group col-md-6">
        <label for="outromeiodecontato">Outros contatos</label>
            <input type="text" class="form-control" id="outromeiodecontato" placeholder="facebook, twitter, etc.">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="cidade">Cidade</label>
        <input type="text" class="form-control" id="cidade" required="required">
      </div>
      <div class="form-group col-md-4">
        <label for="areainteresse">Area de Interesse</label>
        <select id="areainteresse" class="form-control" required="required">
          <option selected>Area de Interesse</option>
          <option>...</option>
        </select>
      </div>
    </div>
    <div class="form-check-inline">
        <input class="form-check-input" type="radio" name="tipo" id="Empreendedor" value="opcao1" checked>
        <label class="form-check-label" for="Empreendedor">
          Empreendedor
        </label>
      </div>
      <div class="form-check-inline">
        <input class="form-check-input" type="radio" name="tipo" id="Investidor" value="opcao2">
        <label class="form-check-label" for="Investidor">
          Investidor
        </label>
    </div>
    <br><br><button type="submit" class="btn btn-info">Cadastrar</button>
  </form>
</div>
<script src="Views/assets/jquery-3.4.1.min.js"></script>
<script src="Views/assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"> </script>
</body>
</html>