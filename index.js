function listDevices(){
  
  if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
    console.log("enumerateDevices() not supported.");
    return false;
  }
  
  // List cameras and microphones.
  
  navigator.mediaDevices.enumerateDevices()
  .then(function(devices) {
    devices.forEach(element => {
      let cam = element.label.split(' ')
      if (cam[3] === 'back'){
        return element.deviceId
      }else{
        return false
      }
    });
    
  })
  .catch(function(err) {
    console.log(err.name + ": " + err.message);
  });

}

async function openCamera() {    

  const deviceId = listDevices();

  if (!deviceId){
    console.log(`!deviceId`)
    return false;
  }
    

    Quagga.init({
      inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector('#camera'), 
          constraints: {
            facingMode: "environment",
            deviceId: deviceId
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
