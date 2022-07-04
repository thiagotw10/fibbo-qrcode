async function openCamera() {
    

    if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
        console.log("enumerateDevices() not supported.");
        return;
      }
      
      // List cameras and microphones.
      
      navigator.mediaDevices.enumerateDevices()
      .then(function(devices) {
        console.log(devices)
        $('#res').html(JSON.stringify(devices));
      })
      .catch(function(err) {
        console.log(err.name + ": " + err.message);
      });


    Quagga.init({
      inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector('#camera'), 
          constraints: {
            video: { facingMode: { exact: "environment" } }
          },
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
