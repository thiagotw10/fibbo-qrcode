<?php

include '../commons/connect.pg.php';

$sqlSectors = "
  select 
    local.loc_country as cd_setor,
    local.loc_state as nm_setor ,
    local.loc_city  as cd_loc_leito,--
    local.loc_neighborhood as nm_loc_leito,--
    local.loc_id,
    local.loc_integrationid as cd_setor_loc_leito,
    local.loc_description as ds_setor_loc_leito,				
    local.loc_observation,
    local.loc_street,
    local.loc_active,
    localtype.lty_integrationid				
  from	
    u26347.local
    inner join u26347.localtype on localtype.lty_id =  local.lty_id
   where 
  local.loc_active='1' 
  
  and localtype.lty_integrationid  in ('STR')
  order by local.loc_neighborhood asc
  ";

  $sectors = pg_query($conexao, $sqlSectors);	

  $arrSectors = [];

  while($sector = pg_fetch_array($sectors)) {
    array_push($arrSectors, [
      'code' => $sector['cd_setor_loc_leito'],
      'description' => $sector['nm_setor'].' | '.$sector['nm_loc_leito']
    ]);
  }

  echo json_encode($arrSectors);
