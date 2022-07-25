
function login(){

  $("#btn-login").attr(`hidden`, true);

  const user = $("#user").val();
  const password = $("#password").val();
  let ret;
  const settings = {
    "url": "src/rules/auth.server.php",
    "method": "POST",
    "data": { 
      user,
      password
    }
  };

  ret = `<div class="alert alert-info" role="alert">
          Validando usuário...
        </div>`
    
  $("#return").html(ret);

  $.ajax(settings).done(function (response) {
    console.log(response);
    if (response == true){
      ret = `
        <div class="alert alert-success" role="alert">
          Ok, redirecionando...
        </div>`

        setTimeout(function(){
          $("#return").html(ret);
        }, 2000)
    
        setTimeout(function(){
          
          //location.href = `http://localhost/3wings/fibbo/solicitacao_avulsa/request.independent.php?user=${user}`
           location.href = `/request.independent.php?user=${user}`
        }, 3000)
    
    }else{
      ret = `
      <div class="alert alert-warning" role="alert">
        Usuário inválido, tente novamente.
      </div>`

      setTimeout(function(){
        $("#return").html(ret);
      }, 2000)
  
      setTimeout(function(){
        $("#return").html('');
        $("#btn-login").attr(`hidden`, false);
      }, 5000)
    }

    
    
  });

  
}