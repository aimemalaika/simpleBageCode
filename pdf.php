<?php
    session_start();
    include 'print/php/bddconnect.php';
    $us = $con->prepare("SELECT * FROM `user`,userattendance WHERE user.ids=userattendance.id_user AND userattendance.id_session=?");
    $us->execute(array(1));
    include 'fpdf/fpdf.php';
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",11);
    $pdf->Cell(0,10,"THE EVENT FACTORY",0,1,'C');
    $pdf->Cell(0,10,"ATTENCE LIS OF DAY 1",0,1,'C');
    $pdf->Cell(0,10,"IN THE 4th EADSG CONGRESS & SCIENTIFIC SESSION",0,1,'C');
    $pdf->Cell(0,30,"",0,1,'C');
    $pdf->Cell(40,10,"First Name",1,0,'C');
    $pdf->Cell(40,10,"Last Name",1,0,'C');
    $pdf->Cell(50,10,"Category",1,0,'C');
    $pdf->Cell(60,10,"Sponsor",1,0,'C');
    while($as = $us->fetch()){
        $pdf->Cell(0,10,"",0,1,'C');
    $pdf->Cell(40,10,$as['fname'],1,0,'C');
    $pdf->Cell(40,10,$as['lname'],1,0,'C');
    $pdf->Cell(50,10,$as['category'],1,0,'C');
    $pdf->Cell(60,10,$as['sponsor'],1,0,'C');
    }
    $pdf->output();