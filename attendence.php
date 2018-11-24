<?php
     session_start();
        if(!isset($_SESSION['user'])){
            header('Location:login.php');
        }
    include 'print/php/bddconnect.php';
    $us = $con->prepare("SELECT * FROM `user`,userattendance WHERE user.ids=userattendance.id_user AND userattendance.id_session=?");
    $us->execute(array($_GET['session']));
    if(isset($_POST['down'])){
         session_start();
        include 'print/php/bddconnect.php';
        $us = $con->prepare("SELECT * FROM `user`,userattendance WHERE user.ids=userattendance.id_user AND userattendance.id_session=?");
        $us->execute(array($_GET['session']));
        include 'fpdf/fpdf.php';
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(0,10,"THE EVENT FACTORY",0,1,'C');
        $pdf->Cell(0,10,"ATTENDENCE LIST OF DAY ".$_GET['session'],0,1,'C');
        $pdf->Cell(0,10,"IN THE 4th EADSG CONGRESS & SCIENTIFIC SESSION",0,1,'C');
        $pdf->Cell(0,10,"",0,1,'C');
        $pdf->Cell(40,10,"First Name",1,0,'C');
        $pdf->Cell(60,10,"Last Name",1,0,'C');
        $pdf->Cell(50,10,"Category",1,0,'C');
        $pdf->Cell(40,10,"Sponsor",1,0,'C');
        while($as = $us->fetch()){
            $pdf->Cell(0,10,"",0,1,'C');
        $pdf->Cell(40,10,$as['fname'],1,0,'C');
        $pdf->Cell(60,10,$as['lname'],1,0,'C');
        $pdf->Cell(50,10,$as['category'],1,0,'C');
        $pdf->Cell(40,10,$as['sponsor'],1,0,'C');
        }
        $pdf->output();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>attendence</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">All participant</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Add session</a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="li.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Session List</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Check attendance</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            
            <?php 
              $al = $con->query("SELECT * FROM `sessionid`");
              while($dip = $al->fetch()){?>
                  <li>
                      <a href="attendence.php?session=<?=$dip['id']?>"><?=$dip['session_name']?></a>
                  </li>
              <?php } ?>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Tables</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <form method="post"><input type="submit" name="down" value="Download the list"></form> </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>First name</th>
                  <th>Last Name</th>
                  <th>Category</th>
                  <th>Sponsor</th>
                 <th>Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
              while($as = $us->fetch()){
                ?>
                <tr>
                  <td><?=$as['fname']?></td>
                  <td><?=$as['lname']?></td>
                  <td><?=$as['category']?></td>
                  <td><?=$as['sponsor']?></td>
                  <th><a href="del.php?id=<?=$as['ids']?>&session=<?=$_GET['session']?>">Delete</a></th>
                </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
  </div>
</body>

</html>
