function validate(request){

  const settings = {
    "url": "api/index.php",
    "method": "POST",
    "data": { 
      op: "request",
      requestNumber: inputRequest
    }
  };
  
  $.ajax(settings).done(function (response) {

  });

  
}