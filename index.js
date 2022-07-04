function listDevices(){
  
  if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) {
    console.log("enumerateDevices() not supported.");
    $('#log').html(`enumerateDevices() not supported.`)
    return false;
  }
  
  // List cameras and microphones.
  
  navigator.mediaDevices.enumerateDevices()
  .then(function(devices) {
    devices.forEach(element => {
      let cam = element.label.split(' ')
      if (cam[3] === 'back'){
        $('#log').html(`element.deviceId: ${element.deviceId}`)
        return element.deviceId
      }
    });
    
  })
  .catch(function(err) {
    $('#log').html(err.name + ": " + err.message)
    console.log(err.name + ": " + err.message);
    return false
  });

  $('#log').html(`enumerateDevices() not supported.`)
  return false

}

async function openCamera() {    

  const deviceId = listDevices();

  if (!deviceId){
    console.log(`!deviceId`)
    $('#log').html(`no device id`)
    return false;
  }
    

    Quagga.init({
      inputStream: {
          name: "Live",
          type: "LiveStream",
          target: document.querySelector('#camera'), 
          constraints: {
            facingMode: "environment",
            //deviceId: deviceId
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
