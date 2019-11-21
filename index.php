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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
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
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!--header -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4  ">
          <div class="container">
            <div id="login" class="signin-card text-white">
              <h1 class="display1">Entrar </h1>
              <p class="subhead">Logue e veja o que há de novo </p>
              <form action="" method="" class="" role="form" class="login">
                <div id="form-login-username" class="form-group">
                  <input id="username" class="form-control" name="username" type="text" size="18" alt="login" required />
                  <span class="form-highlight"></span>
                  <span class="form-bar"></span>
                  <label for="username" class="float-label">login</label>
                </div>
                <div id="form-login-password" class="form-group">
                  <input id="passwd" class="form-control" name="password" type="password" size="18" alt="password" required>
                  <span class="form-highlight"></span>
                  <span class="form-bar"></span>
                  <label for="password" class="float-label">password</label>
                </div>
                <div>
                  <button class="btn btn-block btn-info ripple-effect" type="submit" name="Submit" alt="sign in">Sign in</button>
                </div>
            </div>
            </form>
          </div>
        </div>
        <div class="col-12 col-md-8 texto">
          <h1>informações</h1>
          <h4 class="h4"> besteiras escrita</h2>
        </div>
      </div>
    </div>
    </div>
  </header>
  <div class="container-fluid">
    <!-- Call to Action Well -->
    <div class="card text-white bg-secondary my-5 py-4 text-center">
      <div class="card-body">
        <p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p>
      </div>
    </div>

    <!-- Content Row -->
    <div class="row">
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Card One</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary btn-sm">More Info</a>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Card Two</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tenetur ex natus at dolorem enim! Nesciunt pariatur voluptatem sunt quam eaque, vel, non in id dolore voluptates quos eligendi labore.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary btn-sm">More Info</a>
          </div>
        </div>
      </div>
      <!-- /.col-md-4 -->
      <div class="col-md-4 mb-5">
        <div class="card h-100">
          <div class="card-body">
            <h2 class="card-title">Card Three</h2>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary btn-sm">More Info</a>
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
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <script src="Views/assets/jquery-3.4.1.min.js"></script>
  <script src="Views/assets/bootstrap-4.3.1-dist/js/bootstrap.min.js"> </script>
</body>

</html>