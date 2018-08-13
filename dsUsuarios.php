<?php 
  
  require_once('Connections/MySQLConn.php'); 

  function Dataset($tabela, $filtro, $ordem) {
   $SQL = 'SELECT * FROM ' . $tabela ;
   
   //Aplica o filtro
   if ($filtro != '') {
     $SQL .= ' WHERE ' . $filtro;
   }
   
   //Aplica ordenação
   if ($ordem != '') {
     $SQL .= ' ORDER BY ' . $filtro;
   }
   
// echo $SQL;
   $dsUsuarios = mysql_query($SQL);
   return $dsUsuarios;
  }

?>
