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
  <link rel="stylesheet" href="./index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anek+Latin:wght@500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Anek Latin', sans-serif;
    }
  </style>
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
      <div class="row py-lg-5">
        <div class="row mb-3">
          <div class="col">
            <label for="firstName" class="form-label">Setor:</label>
            <select name="sectorId" class="form-control" id="sectorId">
              <option value="0"></option>
              <option value="1">Setor 1</option>
              <option value="2">Setor 2</option>
              <option value="3">Setor 3</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col">
            <label for="firstName" class="form-label">Matricula:</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
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

              <button href="#" style="border:1px solid black;" onclick="openCamera()" data-bs-toggle="modal"
                data-bs-target="#exampleModal" class="btn form-control">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                  <path
                    d="M22 22h-20c-1.104 0-2-.896-2-2v-16c0-1.104.896-2 2-2h20c1.104 0 2 .896 2 2v16c0 1.104-.896 2-2 2zm0-18h-20v16h20v-16zm-2 14h-1v-12h1v12zm-5 0h-1v-12h1v12zm-2 0h-1v-12h1v12zm-2 0h-2v-12h2v12zm-3 0h-1v-12h1v12zm10 0h-2v-12h2v12zm-12 0h-2v-12h2v12z" />
                </svg>
              </button>
            </div>
          </div>
        </div>


      </div>
      <div id="log">
        <div class="controls" hidden>
          <fieldset class="input-group">
            <button class="stop">Stop</button>
          </fieldset>
          <fieldset class="reader-config-group">
            <label>
              <span>Barcode-Type</span>
              <select name="decoder_readers">
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
            </label>
            <label>
              <span>Resolution (width)</span>
              <select name="input-stream_constraints">
                <option value="320x240">320px</option>
                <option selected="selected" value="640x480">640px</option>
                <option value="800x600">800px</option>
                <option value="1280x720">1280px</option>
                <option value="1600x960">1600px</option>
                <option value="1920x1080">1920px</option>
              </select>
            </label>
            <label>
              <span>Patch-Size</span>
              <select name="locator_patch-size">
                <option value="x-small">x-small</option>
                <option value="small">small</option>
                <option selected="selected" value="medium">medium</option>
                <option value="large">large</option>
                <option value="x-large">x-large</option>
              </select>
            </label>
            <label>
              <span>Half-Sample</span>
              <input type="checkbox" checked="checked" name="locator_half-sample" />
            </label>
            <label>
              <span>Workers</span>
              <select name="numOfWorkers">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option selected="selected" value="4">4</option>
                <option value="8">8</option>
              </select>
            </label>
            <label>
              <span>Camera</span>
              <select name="input-stream_constraints" id="deviceSelection">
              </select>
            </label>
            <label style="display: none">
              <span>Zoom</span>
              <select name="settings_zoom"></select>
            </label>
            <label style="display: none">
              <span>Torch</span>
              <input type="checkbox" name="settings_torch" />
            </label>
          </fieldset>
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



  <script src="vendor/jquery-1.9.0.min.js" type="text/javascript"></script>
  <!-- <script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script> -->
  <script src="vendor/quagga.js" type="text/javascript"></script>
  <script src="live_w_locator.js" type="text/javascript"></script>


  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"
    integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"
    integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy"
    crossorigin="anonymous"></script>
  <!-- <script src="frameworkLerQrCode.min.js"></script> -->

</body>

</html>