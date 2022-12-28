<?php
date_default_timezone_set('America/Sao_Paulo');

include('../rules/meta/connect_mv.php'); 

// POST
  $requestsConcat = $_POST['requestsConcat'];
  $requests = $_POST['requests'];
  $sector = $_POST['sector'];
  $userCode = $_POST['userCode'];
  $user = $_POST['user'];

// var of xml content
  $team = 'eqp_farmacia';
  $date = date('Y-m-d');
  $hour = date('H:i');
  $activityAlternativeIdentifier = 'atv_far_farmacia_avulso';
  $accept = 'atv_far_avulso_aceitar';
  $observation = '';
  $priority = '';
  $cd_paciente = '';
  $nm_paciente = '';
  $sn_vip = '';
  $cd_convenio = '';
  $nm_convenio = '';
  $cd_login = $user; //cd_usuario
  $desc = '';
  $cd_atendimento = '';
  $dt_nascimento = '';
  $classif = '';
  $nm_solic = ''; //NM_USUARIO
  $tsk_o2 = '';
  $tsk_checkout = '';
  $tsk_carrinho = '';
  $tsk_higienizado = '';
  $tsk_completo = '';
  $tsk_ramal = '';
  $tsk_nm_classificacao = '';
  $tsk_cd_classificacao = '';
  $tsk_enfermeiro = '';
  $tsk_familiar = '';
  $tsk_prioridade = '1';
  $cad_solic_concatenados = $requestsConcat;
  $matricula_recebedor = $userCode;

// struct of xml content
  $conteudoXML = '
    <schedule>    
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
          <alternativeIdentifier>'.$activityAlternativeIdentifier.'</alternativeIdentifier>                       
        </activity> 
        <activity>
          <alternativeIdentifier>'.$accept.'</alternativeIdentifier>
        </activity> 
      </activityRelationship>                     
      <observation>'.$observation.'</observation> 
      <priority>'.$priority.'</priority> 
      <customFields>
        <pac.cd_paciente>'.$cd_paciente.'</pac.cd_paciente>
        <pac.nm_paciente>'.$nm_paciente .'</pac.nm_paciente>
        <pac.sn_vip>'.$sn_vip.'</pac.sn_vip>
        <con.cd_convenio>'.$cd_convenio.'</con.cd_convenio>
        <con.nm_convenio>'.$nm_convenio.'</con.nm_convenio>
        <usr.cd_login>'.$cd_login.'</usr.cd_login>
        <tarefa.desc>'.$desc.'</tarefa.desc>
        <pac.cd_atendimento>'.$cd_atendimento.'</pac.cd_atendimento>
        <pac.dt_nascimento>'.$dt_nascimento.'</pac.dt_nascimento>
        <tarefa.classif>'.$classif.'</tarefa.classif>
        <cmp.nm_solic>'.$nm_solic.'</cmp.nm_solic>   
        <tsk_o2>'.$tsk_o2.'</tsk_o2>
        <tsk_checkout>'.$tsk_checkout.'</tsk_checkout>
        <tsk_carrinho>'.$tsk_carrinho.'</tsk_carrinho>
        <tsk_higienizado>'.$tsk_higienizado.'</tsk_higienizado>
        <tsk_completo>'.$tsk_completo.'</tsk_completo>
        <tsk_ramal>'.$tsk_ramal.'</tsk_ramal>
        <tsk_nm_classificacao>'.$tsk_nm_classificacao.'</tsk_nm_classificacao>
        <tsk_cd_classificacao>'.$tsk_cd_classificacao.'</tsk_cd_classificacao>
        <tsk_enfermeiro>'.$tsk_enfermeiro.'</tsk_enfermeiro>
        <tsk_familiar>'.$tsk_familiar.'</tsk_familiar>
        <tsk_prioridade>'.$tsk_prioridade.'</tsk_prioridade >
        <cad_solic_concatenados>'.$cad_solic_concatenados.'</cad_solic_concatenados>
        <tsk.matricula_recebedor>'.$matricula_recebedor.'</tsk.matricula_recebedor>
      </customFields>                     
    </schedule>  
  ';

// open task  
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

  $resultado = preg_replace('/\/(.*?)\//', "" , $result);
  $pontos = array("schedule", ".","xml");
  $tarefa = str_replace($pontos, "" , $resultado);

  $tarefa =  substr($tarefa,55,20);
  $pontos2 = array("<", "/","resourceI");
  $tarefa = str_replace($pontos2, "" , $tarefa);  

// se task true, add rows in aux table, attr agent and close task
  if ($tarefa){ 

    $names = array_filter($requests);

    foreach ($names as $key => $value) {
      $select= oci_parse($connMV, "
                  SELECT DISTINCT										      
                    SOLICITACAO,
                    CD_ATENDIMENTO,
                    to_char(min(DT_PRIM_NECESS),'DD/MM/YYYY HH24:MI') as DT_PRIM_NECESS,
                    MAX(SN_URGENTE_ITPRESC) AS SN_URGENTE_ITPRESC, --PARA CONSIDERAR AS TAREFAS QUE TIVEREM URGENTE = S 
                    MIN(
                    CASE
                    WHEN (FREQUENCIA_ITPRESC = 'AGORA') THEN '1.AGORA'
                    ELSE FREQUENCIA_ITPRESC
                    END) AS FREQUENCIA_ITPRESC, --PARA TRAZER A FREQUENCIA AGORA COMO PRIORIDADE, CASO HOUVER

                    to_char(MIN(DH_INICIAL_ITPRESC),'DD/MM/YYYY') as DT_INICIAL_ITPRESC,
                    to_char(MIN(DH_INICIAL_ITPRESC),'HH24:MI')    as HR_INICIAL_ITPRESC,													 
                    to_char(MIN(DH_FINAL_ITPRESC),'DD/MM/YYYY')   as DT_FINAL_ITPRESC,
                    to_char(MIN(DH_FINAL_ITPRESC),'HH24:MI')      as DH_FINAL_ITPRESC

                  FROM 
                    DBAHMV.WINGS_VI_FARMACIA   
                  WHERE 
                    SOLICITACAO = $value
                    AND CD_SETOR = $sector	
                    GROUP BY
                    SOLICITACAO,
                    CD_ATENDIMENTO");	

      oci_execute($select);

      while (($qrow = oci_fetch_row($select)) != false) {									
        $arrData = $qrow[1];//atendimento
        $primNec = $qrow[2];//DT_PRIM_NECESS 
        $dataPrimNec = substr($primNec,0,10);
        $horaPrimNec = substr($primNec,11,5);
        
        $SN_URGENTE_ITPRESC = $qrow[3];
        $FREQUENCIA_ITPRESC = $qrow[4];
        $DT_INICIAL_ITPRESC = $qrow[5];
        $HR_INICIAL_ITPRESC = $qrow[6];
        $DT_FINAL_ITPRESC   = $qrow[7];
        $DH_FINAL_ITPRESC   = $qrow[8];
        
        $dthrchave = date('dmYHis');
        $length = 4;
        for($i = 0; $i < $length; $i ++) {
          $key .= chr(mt_Rand(33, 126));
        }
        $chaveUnica = $arrData.$value.$dthrchave;
        $xmlItemFarm = 
          '<customEntityEntry>
            <description>'.$chaveUnica.'</description>
            <alternativeIdentifier>'.$chaveUnica.'</alternativeIdentifier>
            <customFields>    
              <cad_cd_atendime>'.$arrData.'</cad_cd_atendime>
              <cad_cd_solic>'.$value.'</cad_cd_solic>
              <cad_cd_task>'.$tarefa.'</cad_cd_task>														
              <cad_data_tarefa>'.$date.'</cad_data_tarefa>
              <cad_hora_tarefa>'.$hour.'</cad_hora_tarefa>
              <cmp_dt_necessidade>'.$dataPrimNec.'</cmp_dt_necessidade>
              <cmp_hr_necessidade>'.$horaPrimNec.'</cmp_hr_necessidade>

              <sn_urgente_itpresc>'.$SN_URGENTE_ITPRESC.'</sn_urgente_itpresc>
              <frequencia_itpresc>'.$FREQUENCIA_ITPRESC.'</frequencia_itpresc>
              <dt_inicial_itpresc>'.$DT_INICIAL_ITPRESC.'</dt_inicial_itpresc>
              <hr_inicial_itpresc>'.$HR_INICIAL_ITPRESC.'</hr_inicial_itpresc>
              <dt_final_itpresc>'.$DT_FINAL_ITPRESC.'</dt_final_itpresc>
              <hr_final_itpresc>'.$DH_FINAL_ITPRESC.'</hr_final_itpresc>	
              
            </customFields>
          </customEntityEntry>
        ';
        
        $url_dataItemFarm = "https://api.umov.me/CenterWeb/api/26347e33d181559023ab7b32150ca3bfbc572e/customEntity/alternativeIdentifier/cad_solic_farm_rastreio/customEntityEntry.xml";
        $chItemFarm = curl_init();// Inicia a sessão cURL	
        curl_setopt($chItemFarm, CURLOPT_SSL_VERIFYPEER, false);//ignorar os certificados ssl
        curl_setopt($chItemFarm, CURLOPT_SSL_VERIFYPEER, false);//ignorar os certificados ssl
        curl_setopt( $chItemFarm, CURLOPT_URL, $url_dataItemFarm);// Informa a URL onde será enviada a requisição
        curl_setopt ($chItemFarm, CURLOPT_POST, 1); // Seta a requisição como sendo do tipo POST
        $parametrosItemFarm = 'data=';// Monta os parâmetros da requisição
        curl_setopt ($chItemFarm, CURLOPT_POSTFIELDS, $parametrosItemFarm.$xmlItemFarm);// Seta os parâmetros para session cURL
        curl_setopt($chItemFarm, CURLOPT_RETURNTRANSFER, true);// Se true retorna o conteúdo em forma de string para uma variável
        $result = curl_exec($chItemFarm);// Envia a requisição
        curl_close($chItemFarm);// Finaliza a sessão
        //var_dump($result); // Exibe o retorno da requisição
        //die;				
      }		
    }				
  
// send agent
  $conteudoXMLAGENTE = '
    <schedule>
      <agent>
        <alternativeIdentifier>master</alternativeIdentifier>
      </agent>
    </schedule>
  ';
  
  $url_dataAGENTE = "https://api.umov.me/CenterWeb/api/26347e33d181559023ab7b32150ca3bfbc572e/schedule/".$tarefa.".xml";	
  $chAGENTE = curl_init();// Inicia a sessão cURL	
  curl_setopt( $chAGENTE, CURLOPT_URL, $url_dataAGENTE);// Informa a URL onde será enviada a requisição
  curl_setopt ($chAGENTE, CURLOPT_POST, 1); // Seta a requisição como sendo do tipo POST
  $parametrosAGENTE = 'data=';// Monta os parâmetros da requisição
  curl_setopt ($chAGENTE, CURLOPT_POSTFIELDS, $parametrosAGENTE.$conteudoXMLAGENTE);// Seta os parâmetros para session cURL
  curl_setopt($chAGENTE, CURLOPT_RETURNTRANSFER, true);// Se true retorna o conteúdo em forma de string para uma variável
  $resultAGENTE = curl_exec($chAGENTE);// Envia a requisição
  curl_close($chAGENTE);// Finaliza a sessão

// clse task

  $conteudoXML = '
    <schedule>
      <situation><id>50</id></situation>
    </schedule>';
      
  $url_data = "https://api.umov.me/CenterWeb/api/26347e33d181559023ab7b32150ca3bfbc572e/schedule/".$tarefa.".xml";	
  $ch = curl_init();// Inicia a sessão cURL	
  curl_setopt( $ch, CURLOPT_URL, $url_data);// Informa a URL onde será enviada a requisição
  curl_setopt ($ch, CURLOPT_POST, 1); // Seta a requisição como sendo do tipo POST
  $parametros = 'data=';// Monta os parâmetros da requisição
  curl_setopt ($ch, CURLOPT_POSTFIELDS, $parametros.$conteudoXML);// Seta os parâmetros para session cURL
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);// Se true retorna o conteúdo em forma de string para uma variável
  $result = curl_exec($ch);// Envia a requisição
  curl_close($ch);// Finaliza a sessão

  /*Concluindo*/

  echo $tarefa;
  return true;
  
}else{
  echo false;
  return false;
}