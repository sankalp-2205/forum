<?php
	include ('layout_manager.php');
	include ('content_function.php');
	addview($_GET['cid'], $_GET['scid'], $_GET['tid']);
?>
<html>
<head><title>Inki's PHP Forum Tutorial</title></head>
<link href="/forum-tutorial/styles/style2.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
	.card-2{
     border-radius: 10px;
     width: 500px;
     padding: 20px;
     margin-top: 50px;
     margin-bottom: 50px
 }

 .profile-pic {
     width: 60px;
     height: 60px;
     border-radius: 50%;
     object-fit: contain;
     background-color: #E0E0E0
 }

 textarea {
     padding: 15px 20px;
     border-radius: 10px;
     box-sizing: border-box;
     color: #616161;
     border: 1px solid #F5F5F5;
     font-size: 16px;
     letter-spacing: 1px;
     height: 120px !important;
     width: 100%;
 }

 textarea:focus {
     -moz-box-shadow: none !important;
     -webkit-box-shadow: none !important;
     box-shadow: none !important;
     border: 1px solid #00C853 !important;
     outline-width: 0 !important
 }


 ::placeholder {
     color: #BDBDBD
 }

 :-ms-input-placeholder {
     color: #BDBDBD
 }

 ::-ms-input-placeholder {
     color: #BDBDBD
 }

 .btn-success {
     border-radius: 50px;
     padding: 4px 40px
 }


</style>
<body>
			<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="wrapper wrapper-content animated fadeInRight">
			
						<div class="ibox-content m-b-sm border-bottom">
							<div class="p-xs">
								<div class="pull-left m-r-md">
									<i class="fa fa-globe text-navy mid-icon"></i>
                                </div>
                                    <h2>Welcome to our forum</h2>
                                <span>Feel free to choose topic you arere interested in.</span>
                                           <span style = "float:right; margin-top: -40px;">
										   <?php			
				session_start();
				if (isset($_SESSION['username'])) {
					logout();
				} else {
					if (isset($_GET['status'])) {
						if ($_GET['status'] == 'reg_success') {
							echo "<h1 style='color: green;'>new user registered successfully!</h1>";
						} else if ($_GET['status'] == 'login_fail') {
							echo "<h1 style='color: red;'>invalid username and/or password!</h1>";
						}
					}
					loginform();
				}
			?></span>
							</div>
						</div>
		<div class="forumdesc">
			 <?php
				if (!isset($_SESSION['username'])) {
					echo "<p>please login first or <a href='/forum-tutorial/register'>click here</a> to register.</p>";
				}
			?>
		</div>
		<?php
			if (isset($_SESSION['username'])) {
				replytopost($_GET['cid'], $_GET['scid'], $_GET['tid']);
			}
		?> 
			<?php disptopic($_GET['cid'], $_GET['scid'], $_GET['tid']); ?>
			</div>
		</div>
		</div>
		</div>
		</div>
		</div>
	<script src="/forum-tutorial/login.js"></script>
</body>
</html>