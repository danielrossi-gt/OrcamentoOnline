<?php
  require_once('Connections/MySQLConn.php');
  include("dm.php");

  //Dados do login
  $login = $_POST["login"];
  $senha = $_POST["senha"];

  $ds = Dataset("usuarios", "NOMUSU = '$login' AND PASSWD = '$senha'", "");
  $nr = mysql_num_rows($ds);
  
  
  if ($nr > 0) {
    session_start();
    $_SESSION["login"] = $login;
    $_SESSION["tipus"] = mysql_result($ds, 0, "TIPUSU");
    $_SESSION["descri"] = mysql_result($ds, 0, "DESCRI");
    $_SESSION["codfor"] = mysql_result($ds, 0, "CODFOR");
    
    if ($_SESSION["tipus"] == 'F') {
      header("Location: menu_forn.php");
    }
    else {
      header("Location: menu.php");
    }
  }
  else {
    header("Location: index.php?erro=1");
  }

?>

