<?php
include 'print/php/bddconnect.php';
if(isset($_GET['id'])){
    $act = $con->prepare("DELETE FROM userattendance WHERE id_user = 62");
    $act->execute(array($_GET['id']));
    header('Location:attendence.php?session='.$_GET['session']);
}else{
    echo "string";
}
?>