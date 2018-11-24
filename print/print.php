<?php
  include 'php/bddconnect.php';
  //include 'add.php';
  $al = $con->prepare("SELECT * FROM user WHERE ids = ?");
  $al->execute(array($_GET['id']));
  $alb = $al->fetch();

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>The Event Factory</title>
		<link href="https://fonts.googleapis.com/css?family=Mukta+Malar:400,800|Open+Sans:400,800" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/styles.css">
		<style>
		    @page{
		       size : 337px 466px;
		       margin: 1px 0px 0px 0px;
            }
		    
		</style>
	</head>
	<body>
		<div class="badge" style="border: 1px dashed #d4cccc;">
			<div style="padding:4px 20px;">
				<div class="badge_logo">
					<img src="assets/img/finalogo.jpg" alt=""/>
				</div>
				<div>
				    <p style="font-size: 12px;margin-top: 1px;;margin-bottom: 0px;font-style: italic;" class="center_align badge_job_pos">March 11-14, 2018</p>
				    <!--<p style="font-size: 12px;margin-bottom: 0px;font-style: italic;" class="center_align badge_job_pos">Kigali Convention Center</p>-->
					<p style="font-size: 25px;font-weight:bold;margin-bottom: 14px;" class="center_align badge_name"><?=$alb['title']?> <?=$alb['fname']?> <?=$alb['lname']?></p>
					
				</div>
				<div class="center_align">
					<img id="badge_qr"/>
				</div>
				<?php if(strtolower($alb['category']) == "delegate" ){?>
                    <div class="row badge_footer" style="background:blue;">
                        <div class="col-md-12 nopad_nomag">
					            <p class="text-center mdc-bg-green-400"><?=$alb['category']?></p>
					</div>
				    </div>
                    <?php }elseif(strtolower($alb['category']) == "speaker"){?>
                    <div class="badge_footer" style="background:red;">
					<div class="col-md-12 nopad_nomag">
					            <p class="text-center mdc-bg-green-400"><?=$alb['category']?></p>
					</div>
				</div>
                    <?php }elseif(strtolower($alb['category']) == "organiser"){?>
                    <div class="badge_footer" style="background:green;">
					<div class="col-md-12 nopad_nomag">
					            <p class="text-center mdc-bg-green-400"><?=$alb['category']?></p>
					</div>
				</div>
                    <?php }elseif(strtolower($alb['category']) == "media"){?>
                    <div class="badge_footer" style="background:yellow;">
					<div class="col-md-12 nopad_nomag">
					            <p class="text-center mdc-bg-green-400"><?=$alb['category']?></p>
					</div>
				</div>
                    <?php } else{?>
                    <div class="badge_footer" style="background:chocolate;">
					<div class="col-md-12 nopad_nomag">
					            <p class="text-center mdc-bg-green-400"><?=$alb['category']?></p>
					</div>
				</div>
                <?php } ?>
			</div>
			<?php $ob = $_GET['id'];?>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#badge_qr").attr("src", "https://chart.googleapis.com/chart?cht=qr&chl=" + "https://theeventsfactory.biz/badge/li.php?id=<?=$ob?>" + "&chs=100x100&chld=L|0");
			});
		</script>
	</body>
	
</html>