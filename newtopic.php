<?php
	include ('layout_manager.php');
	include ('content_function.php');
?>
<html>
<head><title>Inki's PHP Forum Tutorial</title></head>
<style>
	.contact-us {
	padding: 50px;
    background-color: #ffffff;
    box-shadow: -2px 40px 34px -24px rgba(0, 0, 0, 0.2);
    border-radius: 255px 15px 225px 15px/15px 225px 15px 255px;
    border: solid 7px #4c9cef;
    border-left-color: #f7639a;
    border-right-color: #f7639a;
}

.contact-us-detail {
    position: absolute;
    left: 83%;
    top: -4%;
    background-color: #4c9cef;
    padding: 10px 20px;
    border-radius: 5px;
    font-weight: 600;
}

.contact-us-detail:hover {
	background-color: #f7639a;
}

.contact-us-detail a {
	color: #ffffff;
}

.contact-us-detail a:hover {
	color: #ffffff;
}

.form-group {
	margin-bottom: 25px;
}

.form-control {
	border: 2px solid transparent;
	width: 100%;
	min-height: 50px;
	border-radius: 2px; -webkit-border-radius: 2px; -moz-border-radius: 2px; -ms-border-radius: 2px; -o-border-radius: 2px;
	-webkit-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
	   -moz-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
	    -ms-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
		 -o-box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
			box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
	-webkit-transition:all 150ms ease-in-out 0s;
	   -moz-transition:all 150ms ease-in-out 0s;
	    -ms-transition:all 150ms ease-in-out 0s;
	     -o-transition:all 150ms ease-in-out 0s;
		    transition:all 150ms ease-in-out 0s;
}
.form-control:focus {
	border-color: #171717;
	-webkit-box-shadow: none;
	   -moz-box-shadow: none;
	    -ms-box-shadow: none;
		 -o-box-shadow: none;
			box-shadow: none;
}

.form-control:focus {
	border-color: #4c9cef;
	border-width: 2px;
}

.margin-top-bottom {
    margin-top: 100px;
    margin-bottom: 100px;
}

.custom-margin {
    margin-top: 80px;
}

.button {
	border: none;
	border-radius: 5px;
	font-family: inherit;
	font-size: 17px;
	color: inherit;
	background: none;
	cursor: pointer;
	padding: 20px 60px;
	display: inline-block;
	text-transform: uppercase;
	letter-spacing: 1px;
	font-weight: 700;
	outline: none;
	position: relative;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

.button:after {
	content: '';
	position: absolute;
	z-index: -1;
	-webkit-transition: all 0.3s;
	-moz-transition: all 0.3s;
	transition: all 0.3s;
}

.button-style {
	border: 3px solid #fff;
	color: #fff;
}

.button-style:hover,
.button-style:active,
.button-style:focus {
	color: #ffffff;
	background: #4c9cef;
}

.button-style-color-2:hover,
.button-style-color-2:active,
.button-style-color-2:focus {
	color: #ffffff;
	background: #f7639a;
}

.button-style-dark {
	border: 3px solid #000000;
	color: #000000;
}

.pattern-bg {
	background: url(https://s23.postimg.org/klq72xovv/pattern_bg.png);
	background-repeat: repeat;
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
			<?php 
				if (isset($_SESSION['username'])) {
					echo 
					"<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700'>
					<div class='row margin-top-bottom' style = 'margin-left: 20%; margin-right: 20%;' >
             <div class='col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-8'>   
                 <div class='row'>
                  <form class='contact-us pattern-bg' action='/forum-tutorial/addnewtopic.php?cid=".$_GET['cid']."&scid=".$_GET['scid']."'
				  method='POST'>     
                        <div class='col-sm-12'>
						  <div class='form-group'>
							<input type='text' id='title'  name='topic' class='form-control' placeholder='Title'>
						   </div>
                          </div>		
                       <div class='col-sm-12'>
					    <div class='textarea-message form-group'>
					      <textarea id='content' name='content' class='textarea-message form-control' placeholder='Content' rows='10'></textarea>
						  </div>
                         </div>
                    <div class='text-center col-sm-6'>      
		               <button type='submit' class='button button-style button-style-dark button-style-color-2'>Post</button>
	                  </div>     
                  </form>
                </div>
			  </div>
            </div>
        </div>";
				} else {
					echo "<p>please login first or <a href='/forum-tutorial/register.html'>click here</a> to register.</p>";
				}
			?>
		</div>
	</div>
	<script src = "/forum-tutorial/login.js"></script>
</body>
</html>