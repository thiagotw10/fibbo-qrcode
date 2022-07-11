function validate(pRequest){

  const settings = {
    "url": "src/rules/validate.request.rule.php",
    "method": "POST",
    "data": { 
      request: pRequest
    }
  };
  
  $.ajax(settings).done(function (response) {
    return true;
  }).catch(() => {
    return false;
  });

  
}