<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="Views/assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="Views/assets/css/site.css">
  <title>EmpStart - Home</title>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img class="pequena img-fluid" src="Views/assets/imagens/Empstart_Logo3_2.png" alt="logo.png"> 
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Views/cadastro.php">Junte-se a nós</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--header -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container ">
      <div class="row">
      <div class="col-12 col-md-8 font-weight-bold ">
          <h1>Junte-se à nossa comunidade, para empreender e investir na nova economia de startups</h1>
          <h4 class="h4">Crie o perfil da sua startup, inscreva-se e tenha a oportunidade
            de fazer parcerias e negócios com grandes empresas e projetos inovadores.</h4>
        </div>
        <div class="col-12 col-md-4 ">
          <div class="container">
            <div id="login" class="signin-card ">
              <h1 class="display1">Entrar </h1>
              <p class="subhead">Logue e veja o que há de novo </p>
              <form action="Controladores/logar.php" method="post" class="login">
                <div id="form-login-username" class="form-group">
                  <input id="username" class="form-control" name="login" type="text" size="18" alt="login" required />
                  <span class="form-highlight"></span>
                  <span class="form-bar"></span>
                  <label for="username" class="float-label">login</label>
                </div>
                <div id="form-login-password" class="form-group">
                  <input id="passwd" class="form-control" name="senha" type="password" size="18" alt="password" required>
                  <span class="form-highlight"></span>
                  <span class="form-bar"></span>
                  <label for="password" class="float-label">senha</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline1" name="radio" class="custom-control-input" value="E">
                  <label class="custom-control-label" for="customRadioInline1">Empreendedor</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="customRadioInline2" name="radio" class="custom-control-input" value="I">
                  <label class="custom-control-label" for="customRadioInline2">Investidor</label>
                </div>
                <div>
                  <button class="btn btn-block btn-info ripple-effect mt-3" type="submit" name="Submit" alt="sign in">Entrar</button>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </header>
  <div class="container-fluid">
    <!-- Call to Action Well -->
    <div class="card text-white bg-secondary my-5 py-4 text-center">
      <div class="card-body">
        <p class="text-white m-0 font-weight-bold">Encontre investidores e mentores como você, que ajudem uns aos outros, fazendo networking, parcerias e negócios entre si e com o ecossistema.</p>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row">
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Comece agora!</h2>
            <p class="card-text">Crie o perfil da sua startup, ganhe visibilidade na comunidade e nas redes sociais, vire notícia e dê o seu start na nova economia.</p>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Procure Oportunidades</h2>
            <p class="card-text">Confira os projetos disponíveis e descubra oportunidades de investimento em startups na sua área de interesse e mais.</p>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Nossa Comunidade</h2>
            <p class="card-text">Procure e conheça pessoas com ideias semelhantes às suas e contribua para gerar novas parcerias e disseminar conhecimento na nossa comunidade.</p>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Empstart 2019</p>
    </div>
    <!-- /.container -->
  </footer>
  <script src="Views/assets/jquery-3.4.1.min.js"></script>
  <script src="Views/assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"> </script>
</body>

</html>