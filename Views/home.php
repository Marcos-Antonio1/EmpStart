<?php 
require_once "../Controladores/autorizacao.php";
?>
<?php
  require_once("../Classes/Empreendedor.php");
  $user=unserialize($_SESSION['usuario']);  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Home</title>
  
  <link rel="stylesheet" href="assets/bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/sidebar.css">
  <link rel="stylesheet" href="assets/css_icons/all.min.css">
</head>
<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right " id="sidebar-wrapper">
      <div class="sidebar-heading text-center " > 
        <div class="text-center" id='imagem-perfil' "><img src="<?= $user->__get('imagem')?>" alt="..." class="img-thumbnail  rounded-circle img-propocional"></div><p class="nomeuser"><?= $user->__get('nome')?></p></div> 
      <div class="list-group list-group-flush" >
        <a href="#" class=" inicio list-group-item list-group-item-action "><i class="fas fa-desktop"></i> Inicio </a>
        <a href="#" class=" cadastro-projeto list-group-item list-group-item-action "><i class="fas fa-plus"></i> Cadastrar projeto</a>
        <a href="#" class=" mys-projects list-group-item list-group-item-action "><i class="fas fa-project-diagram"></i> Meus projeto</a>
        <a href="#" class=" mydados list-group-item list-group-item-action "><i class="fas fa-user-edit"></i> Meus Dados</a>
        <a href="#" class=" pedidos list-group-item list-group-item-action "><i class="fas fa-hand-holding-usd"></i> Ver pedidos de investimento</a>
        <a href="#" class=" listar-top-ten list-group-item list-group-item-action  "><i class="fas fa-cubes"></i> Top 10 projetos</a>
        <a href="../Controladores/sair.php" class="list-group-item list-group-item-action "><i class="fas fa-sign-out-alt"></i>Sair</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
  
    <!-- Page Content -->
    <div id="page-content-wrapper">
      
      <nav class="navbar navbar-expand-lg  border-bottom ">
        <button class="btn btn-primary" id="menu-toggle"><i class="fas fa-bars"></i></button>
        <button class=" dedo navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          <a class="navbar-brand" href="#">
          <a class="navbar-brand" href="#">
      </a>
      </a>
        </button>
        <img  class='pequena-black'src="assets/imagens/Empstart_Logo3_versaoblack2.png" alt="...">
      </nav> 
      <div class="container-fluid ml-5 mt-3">  
      <form class=" formulario form-inline my-2 my-lg-0 text-center">
      <form class=" formulario form-inline my-2 my-lg-0 text-center">
            <input class=" buscar col-8 form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" ><i class="fas fa-search"></i>        
      </form>
      
      </form>
      
        <div class="container">
            <div class="cards-projetos row flex-wrap">
              <div class="container contact-form">
                <div class="contact-image">
                    <img src="assets/imagens/rocket_contact.png" alt="rocket_contact"/>
                </div>
                <div class="inserirtexto">
                   <p class="aliamento"> Empstart sua plataforma de investimentos e inovação</p>
                   <button type="button" class=" pro btn btn-primary btn-lg ">Projetos</button>
                   <button type="button" class=" pessoas btn btn-primary btn-lg ml-2">Pessoas</button>
                  </div>  
              </div>
            </div>       
        </div>
    </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="assets/jquery-3.4.1.min.js"></script>
  
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  
  </script>
  <script src="assets/js/home.js"></script>
  <script src="assets/js/manipulacaodeprojetos.js"></script>
  <script src="assets/js/buscaParaEmpreendedor.js"></script>
  <script src ="assets/js/buscainicioEmpreendedor.js"></script>
 
 

</body>

</html>


