async function initializeCamera() {
  stopVideoStream();
  constraints.video.facingMode = useFrontCamera ? "user" : "environment";

  try {
    videoStream = await navigator.mediaDevices.getUserMedia(constraints);
    video.srcObject = videoStream;
  } catch (err) {
    alert("Could not access the camera");
  }
}



async function openCamera() {  
  initializeCamera();  
  Quagga.init({
    inputStream: {
        name: "Live",
        type: "LiveStream",
        target: document.querySelector('#camera'), 
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
