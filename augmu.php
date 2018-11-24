<?php 
   include 'add.php';
  include 'print/php/bddconnect.php';
  $al = $con->prepare("SELECT * FROM user WHERE ids = ?");
  $al->execute(array($_GET['id']));
  $alb = $al->fetch();


  if(isset($_POST['submit'])){
   $reg_no = htmlspecialchars($_POST['reg_no']);
   $title = htmlspecialchars($_POST['title']);
   $fname = htmlspecialchars($_POST['fname']);
   $lname = htmlspecialchars($_POST['lname']);
   $category = htmlspecialchars($_POST['category']);
   $sponsor = htmlspecialchars($_POST['sponsor']);

   $bla = $con->prepare("INSERT INTO `user`(`reg_no`, `title`, `fname`, `lname`, `category`, `sponsor`) VALUES (?,?,?,?,?,?)");
   $bla->execute(array($reg_no,$title, $fname, $lname, $category, $sponsor));
   header('Location:index.php');
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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="augmu.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Add participant</span>
          </a>
        </li>
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">All participant</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>
            <span class="nav-link-text">Add session</span></a>
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
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Participant</div>
        <div class="card-body" style="display:inline-flex">
          <div class="table-responsive" id="badge">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                 <th>Title</th>
                  <th>First name</th>
                  <th>Last Name</th>
                  <th>Reg Number</th>
                  <th>Category</th>
                  <th>Sponsor</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <form method="post">
                    <td><input name="title" type="text" placeholder="title" ></td>
                    <td><input name="fname" type="text" placeholder="first name" ></td>
                    <td><input name="lname" type="text" placeholder="last name" ></td>
                    <td><input name="reg_no" type="text" placeholder="Reg number" ></td>
                    <td><input name="category" type="text" placeholder="category" ></td>
                    <td><input name="sponsor" type="text" placeholder="sponsor" ></td>
              
                </tr>
              </tbody>
            </table>
            <center>
            <input type="submit" name="submit" value="Add">
              </center>
              </form>
          </div>
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
				$("#badge_qr").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + "https://theeventsfactory.biz/badge/print.php?id=<?=$alb['id']?>" + "&chs=100x100&chld=L|0");
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
