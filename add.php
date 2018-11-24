<?php
    include 'print/php/bddconnect.php';
    if(isset($_POST['sessionaddi'])){
        $aj = htmlspecialchars($_POST['sessionaddi']);
        $is = $con->prepare("INSERT INTO `sessionid`(`session_name`) VALUES (?)");
        $is->execute(array($aj));
        $ok =$aj." session is added";
       
    }
    ?>