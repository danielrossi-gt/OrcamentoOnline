<?php
  session_start();
  $login = $_SESSION["login"];
  $tipus = $_SESSION["tipus"];

  if ($login == '') {
    header("Location: index.php?erro=1");
  }
?>
