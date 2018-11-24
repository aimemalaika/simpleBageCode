<?php
include 'print/php/bddconnect.php';
if(isset($_GET['id']!=0)){
    $jr = date("F d Y");
    $act = $con->prepare("INSERT INTO `userattendance`(`id_session`, `id_user`, `date_time`) VALUES (?,?,?)");
    $act->execute(array(1,$_GET['id'],$jr));
}
?>