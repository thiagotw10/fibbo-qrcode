<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
      crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Latin:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <title>Registro de solicitações</title>
  </head>

<body>
  <header>
    <div class="navbar shadow-sm" style="background-color:#12A7BB;">
      <div class="container d-flex align-items-center">
        <a href="#" class="navbar-brand ">
          <img style="width:5em;"
            src="https://static.wixstatic.com/media/7bead1_f2549890dd6e4547bafe0834e12fd586~mv2.png/v1/fill/w_350,h_110,al_c,q_85,usm_0.66_1.00_0.01,enc_auto/7bead1_f2549890dd6e4547bafe0834e12fd586~mv2.png"
            alt="">
        </a>
      </div>
    </div>
  </header>

  <main>

    <section class="py-3 text-center container">
      <h3 class="fw-900">Registro de solicitações</h3>
    </section>
    <section class="py-2 container">
      <div class="row ">
        <div class="col text-secondary text-center">
          <p >
            Utilizar usuário e senha do seu Computador  
          </p> 
        </div>
      </div>
      <div class="row py-lg-5">
        <div class="row mb-3">
          <div class="col">
            <label for="firstName" class="form-label">Usuário:</label>
            <input type="text" class="form-control" id="user" required>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="firstName" class="form-label">Senha:</label>
            <input type="text" class="form-control" id="password" required>
          </div>
        </div>
        <div class="row p-3">
          <div class="col text-end">
            <button 
              type="submit" 
              id="btn-login"
              onclick="login()" 
              class="btn btn-login"
            >Entrar
            </button>
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col">
          <div id="return"></div>
        </div>
      </div>
   
    </section>

  </main>
  
  <div class="container footer-custom text-center">
  <footer class="py-2">
    <div class="d-flex flex-column flex-sm-row justify-content-between border-top r">
      <p class="py-1">© 2022 3wings, Todos os direitos reservados.</p>
      <!-- <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-dark" href="#">WebSite</a></li>
        <li class="ms-3"><a class="link-dark" href="#">Likedin</a></li>
        <li class="ms-3"><a class="link-dark" href="#">Instagram</a></li>
      </ul> -->
    </div>
  </footer>
</div>
  <script>
    //baseUrl = `http://localhost/3wings/fibbo/solicitacao_avulsa`
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
  <script src="src/controllers/login.controller.js"></script>
</body>

</html>