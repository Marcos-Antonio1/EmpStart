<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="Views/assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="Views/assets/css/site.css">
  <title>home</title>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img class="img-fluid" src="" alt=""> logo
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
            <a class="nav-link" href="#">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Projetos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="Views/cadastro.php">junte-se a nós</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--header -->
    
    <div class="container">
        <h3>alguma coisa e ajeitar área de pesquisa</h3> 
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2 col-8" type="search" placeholder="Pesquisar">
          <button class="btn btn-info my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
        <?php
        $pdo=new BD();
        $conexão=$pdo->abrirConexao();
        $buscar = $conexão->prepare("SELECT * FROM projeto");
        $buscar->execute();
        $Projetos=$buscar->fetchAll(PDO::FETCH_NUM);
        ?>
        <?php foreach($Projetos as $projeto) { ?>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src=".../100px180/" alt="Imagem de capa do card">
            <div class="card-body">
                <h5 class="card-title">Nome: <?=$projeto->_get('nome')?></h5>
                <p class="card-text">Descricao: <?=$projeto->_get('descricao')?></p>
                <a href="#" class="btn btn-primary">Visitar</a>
            </div>
        </div>
        <?php } ?>

    </div>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>
  <script src="Views/assets/jquery-3.4.1.min.js"></script>
  <script src="Views/assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"> </script>
</body>

</html>