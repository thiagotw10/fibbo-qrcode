async function openCamera() {  
  //initializeCamera();  
  const video = document.querySelector('#camera')
  
  Quagga.init({
    inputStream: {
        name: "Live",
        type: "LiveStream",
        target: video, 
        constraints: {
          width: 640,
          height: 480,
          facingMode: "enviroment",
        }
    },
    decoder: {
        readers: ["code_128_reader"]
    }
  }, function (err) {
    if (err) {
        console.log(err);
        return
    }
    console.log("Initialization finished. Ready to start");
    Quagga.start();

  });

  Quagga.onDetected(function (data) {
      console.log(data.codeResult.code);

      if (data.codeResult.code){

        $("#exampleModal #close").click()
        
        document.querySelector('#resultado').value = data.codeResult.code  
        
        
        return;
      }
  });
   
}
