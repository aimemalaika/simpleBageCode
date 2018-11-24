<?php 
  if(!isset($_GET['id'])){
    $alb['fname'] = "WRONG BUDGE";
    header('Location:li.php?id=0');
  }
   include 'add.php';
  include 'print/php/bddconnect.php';
  $al = $con->prepare("SELECT * FROM user WHERE ids = ?");
  $al->execute(array($_GET['id']));
  $alb = $al->fetch();

    $jr = date("F d Y");
    $act = $con->prepare("INSERT INTO `userattendance`(`id_session`, `id_user`, `date_time`) VALUES (?,?,?)");
    $act->execute(array(4,$_GET['id'],$jr));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Mukta+Malar:400,800|Open+Sans:400,800" rel="stylesheet">
		<link rel="stylesheet" href="print/assets/css/styles.css">
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
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <!-- Example DataTables Card-->
      <div class="card mb-3">
            <div class="badge">
              <div>
                <div class="badge_logo">
                  <img src="print/assets/img/finalogo.jpg" alt=""/>
                </div>
                <div>
                  <p class="center_align badge_name" style="font-size:20px"><?=$alb['fname']?> <?=$alb['lname']?></p>
                </div>
                <div style="padding-top: 21px;" class="center_align">
                  <img id="badge_qr"/>
                </div>
                <div class="badge_footer">
                  <p><?=$alb['category']?></p>
                </div>
                <div>
                    <p style="padding-top: 41px;" class="center_align badge_comp_name"><?=$alb['sponsor']?></p>
                </div>
              </div>
            </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © TCL</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add session</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="text" name="sessionaddi" placeholder="ADD SESSION">
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <input name="add" type="submit" class="btn btn-primary">
          </div>
        </div>
        </form>
      </div>
    </div>
    <!-- Logout Modal-->
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#badge_qr").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + "https://theeventsfactory.biz/badge/print.php?id=<?=$alb['ids']?>" + "&chs=100x100&chld=L|0");
			});
		</script>
    <script>
$(document).ready(function(){
    $("#vi").click(function(){
        $("#changes").fadeToggle("slow");
        $("#badge").fadeToggle("slow");
    });
});

    </script>
  </div>
</body>

</html>
