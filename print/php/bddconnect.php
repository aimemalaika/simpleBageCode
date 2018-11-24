<?php
  $server = "localhost";
  $login = "theevent_pas";
  $pass = "17_pass";
  $con = new pdo("mysql:host=$server;dbname=theevent_participant",$login,$pass);
 


  $all = $con->query("SELECT * FROM user");
  
  ?>