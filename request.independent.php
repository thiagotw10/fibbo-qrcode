<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
  <title>Registro de solicitaçoes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anek+Latin:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Anek Latin', sans-serif;
    }
  </style>
</head>

<body>
  <input type="text" id='user' hidden value="<?php echo $_GET['user']; ?>">
  <header style="position: fixed; width: 100%; z-index: 999;">
    <div class="navbar shadow-sm" style="background-color:#2d82a6;">
      <div class="container d-flex align-items-center">
        <a href="#" class="navbar-brand ">
          <img style="width:5em;"
            src="assets/logo_branca.png"
            alt="">
        </a>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512" 
        data-bs-toggle="modal" data-bs-target="#modalConfigurations"><!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M495.9 166.6C499.2 175.2 496.4 184.9 489.6 191.2L446.3 230.6C447.4 238.9 448 247.4 448 256C448 264.6 447.4 273.1 446.3 281.4L489.6 320.8C496.4 327.1 499.2 336.8 495.9 345.4C491.5 357.3 486.2 368.8 480.2 379.7L475.5 387.8C468.9 398.8 461.5 409.2 453.4 419.1C447.4 426.2 437.7 428.7 428.9 425.9L373.2 408.1C359.8 418.4 344.1 427 329.2 433.6L316.7 490.7C314.7 499.7 307.7 506.1 298.5 508.5C284.7 510.8 270.5 512 255.1 512C241.5 512 227.3 510.8 213.5 508.5C204.3 506.1 197.3 499.7 195.3 490.7L182.8 433.6C167 427 152.2 418.4 138.8 408.1L83.14 425.9C74.3 428.7 64.55 426.2 58.63 419.1C50.52 409.2 43.12 398.8 36.52 387.8L31.84 379.7C25.77 368.8 20.49 357.3 16.06 345.4C12.82 336.8 15.55 327.1 22.41 320.8L65.67 281.4C64.57 273.1 64 264.6 64 256C64 247.4 64.57 238.9 65.67 230.6L22.41 191.2C15.55 184.9 12.82 175.3 16.06 166.6C20.49 154.7 25.78 143.2 31.84 132.3L36.51 124.2C43.12 113.2 50.52 102.8 58.63 92.95C64.55 85.8 74.3 83.32 83.14 86.14L138.8 103.9C152.2 93.56 167 84.96 182.8 78.43L195.3 21.33C197.3 12.25 204.3 5.04 213.5 3.51C227.3 1.201 241.5 0 256 0C270.5 0 284.7 1.201 298.5 3.51C307.7 5.04 314.7 12.25 316.7 21.33L329.2 78.43C344.1 84.96 359.8 93.56 373.2 103.9L428.9 86.14C437.7 83.32 447.4 85.8 453.4 92.95C461.5 102.8 468.9 113.2 475.5 124.2L480.2 132.3C486.2 143.2 491.5 154.7 495.9 166.6V166.6zM256 336C300.2 336 336 300.2 336 255.1C336 211.8 300.2 175.1 256 175.1C211.8 175.1 176 211.8 176 255.1C176 300.2 211.8 336 256 336z" fill="white"/></svg>
    </div>
  </header>

  <main>

    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
      </symbol>
      <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
      </symbol>
      <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
          d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
      </symbol>
    </svg>

    <section class="text-center container" style="padding-top: 5rem!important;">

    </section>
    
    <section class="py-2 container">
      

        <div class="row mb-3">
          <div class="col-md-12">
            <label for="firstName" class="form-label">Tipo do leitor:</label>
            <div class="controls">
              <fieldset class="reader-config-group">
                <select name="decoder_readers" class="form-control">
                  <option value="code_128" selected="selected">Etiqueta</option>
                  <option value="code_39">Boleta</option>
                  <!-- <option value="code_39_vin">Code 39 VIN</option>
                  <option value="ean">EAN</option>
                  <option value="ean_extended">EAN-extended</option>
                  <option value="ean_8">EAN-8</option>
                  <option value="upc">UPC</option>
                  <option value="upc_e">UPC-E</option>
                  <option value="codabar">Codabar</option>
                  <option value="i2of5">Interleaved 2 of 5</option>
                  <option value="2of5">Standard 2 of 5</option>
                  <option value="code_93">Code 93</option> -->
                </select>
              </fieldset>  
            </div>
          </div>
          </div>

          <div class="row mb-3">
          <div class="col-md-12">
            <label for="firstName" class="form-label">Setor:</label>
            <select name="sectors" class="form-control js-example-basic-single" id="sectors">
              <option value="0"></option>
            </select>
          </div>
          </div>

        <div id="logsLabel" class="container mb-2" hidden>
          cont: <input type="number" value="1" id="cont"><br />
          Logs:
          <div id="logs" style="border: 1px solid rgb(226, 226, 226)">
            &nbsp;
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label for="firstName" class="form-label">Solicitações:</label>
          </div>
        </div>

        <div id="requests">
          <div class="row">

            <div class="col-9">
              <input type="text" disabled class="form-control" id="request1" />
            </div>
            <div class="col-3">

              <button href="#" style="border:1px solid black;" onclick="openCamera('request')" class="btn form-control"
                id="btnBarCode1" data-bs-toggle="modal" data-bs-target="#exampleModal">

                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                  <path
                    d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z" />
                </svg>
              </button>

              <!-- <button href="#" style="border:1px solid black;" onclick="openCameraTest('request')" class="btn form-control"
                id="btnBarCode1">

                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                  <path
                    d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z" />
                </svg>
              </button> -->

            </div>
          </div>
        </div>


        <div class="row mt-2">
          <div class="col">
            <label for="firstName" class="form-label">Matricula:</label>
          </div>
        </div>

        <div id="userCode">
          <div class="row mb-3">
            <div class="col-9">
              <input type="text" class="form-control" id="inputUserCode" placeholder="" required>
            </div>
            <div class="col-3">
              <!-- <button href="#" style="border:1px solid black;" onclick="openCamera('user_code')" class="btn form-control"
                id="btnBarCodeForUserCode" data-bs-toggle="modal" data-bs-target="#exampleModal">

                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                  <path
                    d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z" />
                </svg>
              </button> -->
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col text-center">
          <button class="btn form-control" style="background-color:#12A7BB; color: #fff" id='btn_confirm' onclick="confirmRequests()">Confirmar</button>
    
          <div class="alert alert-danger" id='labelReturnConfirmDanger' hidden role="alert">
            Erro no registro, recarregando ...
          </div>

          <div class="alert alert-success" id='labelReturnConfirmSuccess' hidden role="alert">
            Registrado com sucesso, recarregando ...
          </div>

          <div class="alert alert-info" id='labelReturnConfirmInfo' hidden role="alert">
            Verifique se todos os campos foram preenchidos.
          </div>

        </div>
      </div>
    </section>

  </main>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Escanear solicitação</h5>
          <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <!-- result da camera -->
          <div id="result_strip">
            <ul class="collector"></ul>
          </div>
          <div id="interactive" class="viewport"></div>
          <!-- fim result da camera -->

        </div>

      </div>
    </div>
  </div>

  <!-- Modal for configurations -->
  <div class="modal fade" id="modalConfigurations" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Configurações</h5>
          <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="controls">

                <div class="row mb-2">
                  <!-- <div class="col">
                    <span>Tipo</span>
                    <fieldset class="reader-config-group">
                      <select name="decoder_readers" class="form-control">
                        <option value="code_128" selected="selected">Code 128</option>
                        <option value="code_39">Code 39</option>
                        <option value="code_39_vin">Code 39 VIN</option>
                        <option value="ean">EAN</option>
                        <option value="ean_extended">EAN-extended</option>
                        <option value="ean_8">EAN-8</option>
                        <option value="upc">UPC</option>
                        <option value="upc_e">UPC-E</option>
                        <option value="codabar">Codabar</option>
                        <option value="i2of5">Interleaved 2 of 5</option>
                        <option value="2of5">Standard 2 of 5</option>
                        <option value="code_93">Code 93</option>
                      </select>
                    </fieldset>  
                  </div> -->
                  <div class="col">
                  <fieldset class="reader-config-group">
                    <span>Camera</span>
                    <select name="input-stream_constraints" id="deviceSelection" class="form-control">
                    </select>
                  </fieldset>  
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col">Sair</div>
                </div>

                <!-- <div class="row">
                  <div class="col">
                    <fieldset class="input-group">
                      <button class="stop btn btn-danger form-control">Parar camera</button>
                    </fieldset>
                  </div>
                </div> -->

              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

    <!-- Modal for Central de mensagens -->
    <!-- <div class="modal fade" id="modalReturnOnConfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Central de mensagens</h5>
          <button type="button" class="btn-close" id="close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
             123
            </div>
          </div>

        </div>

      </div>
    </div>
  </div> -->

  <!-- <script src="vendor/jquery-1.9.0.min.js" type="text/javascript"></script> -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
  <!-- <script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script> -->
  <!-- <script src="vendor/quagga.js" type="text/javascript"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"
    integrity="sha512-bCsBoYoW6zE0aja5xcIyoCDPfT27+cGr7AOCqelttLVRGay6EKGQbR6wm6SUcUGOMGXJpj+jrIpMS6i80+kZPw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- <script src="src/controllers/validate.request.controller.js" type="text/javascript"></script> -->
  <script src="index.js" type="text/javascript"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- <script src="frameworkLerQrCode.min.js"></script> -->

</body>

</html>