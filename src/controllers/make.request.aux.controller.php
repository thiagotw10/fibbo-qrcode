<?php

$requests = $_POST['requests'];
$sector = $_POST['sector'];
$img = '
  <image>
    <id>6278447</id>
    <description>normal</description>
    <mediaType>1</mediaType>
    <publicUrl>https://louvre.umov.me/media/show/6278447?1591042617427</publicUrl>
      <status>2</status>
  </image>
';	

$conteudoXML = '
  <schedule>  
    '.$img.'    
    <serviceLocal>
      <alternativeIdentifier>'.$sector.'</alternativeIdentifier>
    </serviceLocal>
    <team>
      <alternativeIdentifier>'.$team.'</alternativeIdentifier>    
    </team> 
    
    <activitiesOrigin>4</activitiesOrigin>
    <teamExecution >1</teamExecution >
    <date>'.$date.'</date>
    <hour>'.$hour.'</hour>
    <activityRelationship>
      <activity>
        <alternativeIdentifier>'.$verOqueEisso.'</alternativeIdentifier>                       
      </activity> 
      <activity>
        <alternativeIdentifier>'.$accept.'</alternativeIdentifier>
      </activity> 
      '.$abremaisatividade.'
    </activityRelationship>                     
    <observation>'.$observation.'</observation> 
    <priority>'.$priority.'</priority> 
    <customFields>
      
      <pac.cd_paciente>'.$CD_PACIENTE.'</pac.cd_paciente>
      <pac.nm_paciente>'.$NM_PACIENTE .'</pac.nm_paciente>
      <pac.sn_vip>'.$vipPaciente.'</pac.sn_vip>
      <con.cd_convenio>'.$CD_CONVENIO.'</con.cd_convenio>
      <con.nm_convenio>'.$NM_CONVENIO.'</con.nm_convenio>
      <usr.cd_login>'.$mnt_usr_login_resp.'</usr.cd_login>
      <tarefa.desc>'.$descri.'</tarefa.desc>
      <pac.cd_atendimento>'.$CD_ATENDIMENTO.'</pac.cd_atendimento>
      <pac.dt_nascimento>'.$DT_NASCIMENTO.'</pac.dt_nascimento>
      <tarefa.classif>'.$aviso_precaucao.'</tarefa.classif>
      <cmp.nm_solic>'.$nomesolic.'</cmp.nm_solic>   
      <tsk_o2>'.$necessitao2.'</tsk_o2>
      <tsk_checkout>'.$checkoutreal.'</tsk_checkout>
      <tsk_carrinho>'.$carrinhobag.'</tsk_carrinho>
      <tsk_higienizado>'.$higienizado.'</tsk_higienizado>
      <tsk_completo>'.$completo.'</tsk_completo>
      <tsk_ramal>'.$ramal.'</tsk_ramal>
      <tsk_nm_classificacao>'.$ds_tip_presc.'</tsk_nm_classificacao>
      <tsk_cd_classificacao>'.$cd_tip_presc.'</tsk_cd_classificacao>
      <tsk_enfermeiro>'.$necesenf.'</tsk_enfermeiro>
      <tsk_familiar>'.$presfamilia.'</tsk_familiar>
      <tsk_prioridade>'.$mnt_prioridade.'</tsk_prioridade >
      <cad_solic_concatenados>'.$cmpConcatSolicFarm.'</cad_solic_concatenados>
      <tsk.matricula_recebedor>'.$matrReceb.'</tsk.matricula_recebedor>
      
    </customFields>                     
  </schedule>  
';

$url_data = "https://api.umov.me/CenterWeb/api/26347e33d181559023ab7b32150ca3bfbc572e/schedule.xml";             
$ch = curl_init();// Inicia a sessão cURL
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//ignorar os certificados ssl
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//ignorar os certificados ss
curl_setopt( $ch, CURLOPT_URL, $url_data);// Informa a URL onde será enviada a requisição
curl_setopt ($ch, CURLOPT_POST, 1); // Seta a requisição como sendo do tipo POST
$parametros = 'data=';// Monta os parâmetros da requisição
curl_setopt ($ch, CURLOPT_POSTFIELDS, $parametros.$conteudoXML);// Seta os parâmetros para session cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Se true retorna o conteúdo em forma de string para uma variável
$result = curl_exec($ch);// Envia a requisição
curl_close($ch);// Finaliza a sessão
//var_dump($result); // Exibe o retorno da requisição
//>>>>>>>> TRATANDO MENSAGEM RETORNO 
$resultado = preg_replace('/\/(.*?)\//', "" , $result);//tirar os caracteres especiais
$pontos = array("schedule", ".","xml");
$tarefa = str_replace($pontos, "" , $resultado);
//AQUI PARA PEGAR SÓ O NÚMERO DA SOLICITAÇÃO
$tarefa =  substr($tarefa,55,20);
$pontos2 = array("<", "/","resourceI");
$tarefa = str_replace($pontos2, "" , $tarefa);  