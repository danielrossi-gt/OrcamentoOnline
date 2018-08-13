<?php 
  
  require_once('Connections/MySQLConn.php'); 

  //Cria um dataset básico
  function Dataset($tabela, $filtro, $ordem) {
   $tabela = strtolower($tabela);
  
   $SQL = 'SELECT * FROM ' . $tabela ;
   
   //Aplica o filtro
   if ($filtro != '') {$SQL .= ' WHERE ' . $filtro; }
   
   //Aplica ordenação
   if ($ordem != '') { $SQL .= ' ORDER BY ' . $ordem; }
   
   $dsUsuarios = mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");;

//   echo $SQL;

   return $dsUsuarios;
  }

  //Usuários
  function InsUsuario ($nomusu, $tipusu, $passwd, $descri, $codfor) {
    
	$SQL = "INSERT INTO usuarios (NOMUSU, TIPUSU, PASSWD, DESCRI, CODFOR) VALUES ('$nomusu', '$tipusu', '$passwd', '$descri', $codfor)";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");
  
  }
  
  function DelUsuario ($codigo) {
    
	$SQL = "DELETE FROM usuarios WHERE CODIGO = " . $codigo;
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");
  
  }
  
  function UpdUsuario ($codigo, $nomusu, $tipusu, $passwd, $descri, $codfor) {

	$SQL =  "UPDATE usuarios SET NOMUSU = '$nomusu', TIPUSU = '$tipusu', PASSWD = '$passwd', DESCRI = '$descri', CODFOR = $codfor ";
	$SQL .= "WHERE CODIGO = $codigo";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");
  
  }

  //Produtos
  function InsProduto ($descri, $unimed) {

	$SQL = "INSERT INTO produtos (DESCRI, UNIMED) VALUES ('$descri', '$unimed')";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }
  
  function DelProduto ($codigo) {

	$SQL = "DELETE FROM produtos WHERE CODIGO = " . $codigo;
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }

  function UpdProduto ($codigo, $descri, $unimed) {

	$SQL =  "UPDATE produtos SET DESCRI = '$descri', UNIMED = '$unimed' ";
	$SQL .= "WHERE CODIGO = $codigo";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }

  //Fornecedores
  function InsFornecedor ($razsoc, $nrcnpj, $endere, $bairro, $cidade,
                          $estado, $numcep, $tlfone, $e_mail, $weburl) {

    $SQL = "INSERT INTO fornecedores ( " .
           "  RAZSOC, NRCNPJ, ENDERE, BAIRRO, CIDADE, " .
           "  ESTADO, NUMCEP, TLFONE, E_MAIL, WEBURL )" .
           "VALUES (" .
           "  '$razsoc', '$nrcnpj', '$endere', '$bairro', '$cidade', " .
           "  '$estado', '$numcep', '$tlfone', '$e_mail', '$weburl' )";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }
  
  function DelFornecedor ($codigo) {

  	$SQL = "DELETE FROM fornecedores WHERE CODIGO = " . $codigo;
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }
  
  function UpdFornecedor ($codigo, $razsoc, $nrcnpj, $endere, $bairro,
                          $cidade, $estado, $numcep, $tlfone, $e_mail, $weburl) {

    $SQL = "UPDATE fornecedores SET " .
           "  RAZSOC = '$razsoc', NRCNPJ = '$nrcnpj', ENDERE = '$endere', BAIRRO = '$bairro', CIDADE = '$cidade', " .
           "  ESTADO = '$estado', NUMCEP = '$numcep', TLFONE = '$tlfone', E_MAIL = '$e_mail', WEBURL = '$weburl' " .
           "WHERE CODIGO = $codigo";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");
           
  }
  
  //Empresa
  function InsEmpresa ($razsoc, $nrcnpj, $endere, $bairro,
                       $cidade, $estado, $numcep, $tlfone, $e_mail, $weburl) {

    $SQL = "INSERT INTO empresa ( " .
           "  RAZSOC, NRCNPJ, ENDERE, BAIRRO, CIDADE, " .
           "  ESTADO, NUMCEP, TLFONE, E_MAIL, WEBURL )" .
           "VALUES (" .
           "  '$razsoc', '$nrcnpj', '$endere', '$bairro', '$cidade', " .
           "  '$estado', '$numcep', '$tlfone', '$e_mail', '$weburl' )";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }

  function DelEmpresa ($codigo) {

  	$SQL = "DELETE FROM empresa WHERE CODIGO = " . $codigo;
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }

  function UpdEmpresa ($codigo, $razsoc, $nrcnpj, $endere, $bairro,
                          $cidade, $estado, $numcep, $tlfone, $e_mail, $weburl) {

    $SQL = "UPDATE empresa SET " .
           "  RAZSOC = '$razsoc', NRCNPJ = '$nrcnpj', ENDERE = '$endere', BAIRRO = '$bairro', CIDADE = '$cidade', " .
           "  ESTADO = '$estado', NUMCEP = '$numcep', TLFONE = '$tlfone', E_MAIL = '$e_mail', WEBURL = '$weburl' " .
           "WHERE CODIGO = $codigo";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }
  
  //Orçamentos
  function InsOrcamento ( $descri, $datorc ) {
  
    $datorc = gravaData ($datorc);
	$SQL = "INSERT INTO orcamentos (DESCRI, DATORC) VALUES ('$descri', '$datorc')";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");
    $codigo = mysql_insert_id();
    return $codigo;
  }

  function DelOrcamento ($codigo) {

	$SQL = "DELETE FROM orcamentos WHERE CODIGO = " . $codigo;
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }

  function UpdOrcamento ($codigo, $descri, $datorc) {

	$SQL =  "UPDATE orcamentos SET DESCRI = '$descri', DATORC = '$datorc' ";
	$SQL .= "WHERE CODIGO = $codigo";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }
  
  //orcprod
  function InsOrcProd ( $codorc, $codpro, $quanti ) {

	$SQL = "INSERT INTO orcprod (CODORC, CODPRO, QUANTI) VALUES ('$codorc', '$codpro', $quanti)";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");
    $codigo = mysql_insert_id();
    return $codigo;
  }

  function DelOrcProd ($codigo, $codpro) {

	$SQL = "DELETE FROM orcprod WHERE CODORC = " . $codigo . " AND CODPRO = " . $codpro;
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }
  
  //orcforn
  function InsOrcForn ( $codorc, $codfor ) {

	$SQL = "INSERT INTO orcforn (CODORC, CODFOR) VALUES ('$codorc', '$codfor')";
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");
    $codigo = mysql_insert_id();
    return $codigo;
  }

  function DelOrcForn ($codigo, $codfor) {

	$SQL = "DELETE FROM orcforn WHERE CODORC = " . $codigo . " AND CODFOR = " . $codfor;
	mysql_query($SQL) or die ("<b>ERRO! Instrução Inválida: </b><br/><i>\"" . $SQL . "\"</i>");

  }

  //Funções Auxiliares
  function EscreveEstado($estado, $value) {
    echo "<option value='$estado'";
    if ($value == $estado) echo " selected=\"selected\" ";
    echo ">$estado</option>";
  }
  
  function EscreveFornecedor($value, $tipo) {
    if ($tipo == 1) {
      $SQL = "SELECT RAZSOC FROM fornecedores WHERE CODIGO = $value";
      $dsf = mysql_query($SQL);
      if (mysql_num_rows($dsf) > 0) {
        echo mysql_result($dsf, 0, "RAZSOC");
      }
      else {
        echo "Nenhum";
      }
    }
    
    if ($tipo == 2) {
      $SQL = "SELECT CODIGO, RAZSOC FROM fornecedores";
      $dsf = mysql_query($SQL);
      $nrf = mysql_num_rows($dsf);
      
      for ($i = 0; $i < $nrf; $i ++) {
        $codigo = mysql_result($dsf, $i, "CODIGO");
        $razsoc = mysql_result($dsf, $i, "RAZSOC");

        echo "<option value='$codigo'";
        if ($value == $codigo) { echo " selected=\"selected\" "; }
        echo ">$razsoc</option>";
      }
    }
  }
  
  // Passando data do banco "AAAA-MM-DD" para "DD/MM/AAAA"
  function mostraData ($data) {
  if ($data!='') {
   return (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
  }
  else { return ''; }
  }

  // Passando data do text box "DD/MM/AAAA" para "AAAA-MM-DD"
  function gravaData ($data) {
  if ($data != '') {
    return (substr($data,6,4).'-'.substr($data,3,2).'-'.substr($data,0,2));
  }
  else { return ''; }
  }
  
  function gravaMoeda ($valor) {

    $valor = str_replace('.', '',$valor);
    $valor = str_replace(',','.',$valor);

    return $valor;

  }

?>
