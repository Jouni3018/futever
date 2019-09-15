<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8" />
  <title>futever</title>
  <link rel="stylesheet" type="text/css" href="/css/session.css">
  <link rel="stylesheet" type="text/css" href="/css/default.css">
  <link rel="stylesheet" type="text/css" href="/css/prognose.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar">
    <a class="navbar-brand" href="/">Futever</a>
    <?php
    if (($_SESSION['logged_in']) != 0){
      if ($_SESSION['userID'] == 1){
        if($_SESSION['adminpage']==false){
          echo "<a href='/session/admin'>Neuer Match eintragen</a>";
        }else {
          echo "<a href='/'>Home</a>";
        }
      }
      echo "<a href='/session/dologout'>Log out</a>";
    }?>
  </nav>
