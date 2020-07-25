<?php
	function loginform() {
		  echo '<a href="#" data-toggle="modal" data-target="#login-modal">Login</a>

		  <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
						  <div class="loginmodal-container">
							  <h1>Login to Your Account</h1><br>
							  <form id="loginform"  action="/forum-tutorial/validatelogin.php" method="POST">
							  <div id = "loginmessage"></div>
							  <div>
									  <input type="text" id="usernameinput" name="usernameinput" placeholder="username">
									  <br>
									  <span class="valid-feedback mb3" id = "loginusernameerror" style = "color: red"></span>
							</div>
							<div>
							<input type="password" id="passwordinput" name="passwordinput"   placeholder="password">
							<br>
									  <span class="valid-feedback mb3" id = "loginpassworderror" style = "color: red"></span>
							</div>
							<input type="button" id="login" value="LOGIN" class="login loginmodal-submit form-control">
							</form>
							<div class="login-help">
							  <a href="#">Register</a> - <a href="#">Forgot Password</a>
							</div>
						  </div>
					  </div>
					</div>';

// 	echo "<form id='loginform' class='text-center border border-light p-5' action='/forum-tutorial/validatelogin.php' method='POST'>
// 	<h2 class='h4 mb-5 heading'>USER LOGIN</h2>
// 	   <div id = 'loginmessage'></div>
// 	  <div class='form-group'>
// 		  <label for='username'>Username:</label>
// 		  <input type='text' id='usernameinput' name='usernameinput' class='form-control' placeholder='username'>
// 		  <div class='valid-feedback mb3' id = 'loginusernameerror' style = 'color: red'></div>
// 	   </div>
// 	   <div class='form-group'>
// 	   <label for='username'>Password:</label>
// 		  <input type='password' id='passwordinput' name='passwordinput' class='form-control'  placeholder='password'>
// 		  <div class='valid-feedback mb3' id = 'loginpassworderror' style = 'color: red'></div>
// 	   </div>
// 		   <br>
	 
//   <div class='col-md-12'>
// 	<input type='button' id='login' value='LOGIN' class='btn btn-dark btn-md text-white'>
//   </div>
// </form>";
	}
	
	function logout() {
		echo ("<form action='/forum-tutorial/logout.php' method='GET'>
				<input type='submit' value='Logout' /></form>");
	}
?>