
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form id = "loginform" method = "POST">
                                            <div id = "loginmessage"></div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="email">Email</label>
                                                <input name = "email" class="form-control py-4" id="email" type="email" placeholder="Enter email address" />
                                                 <br>
									           <span class="valid-feedback mb3" id = "emailerror" style = "color: red"></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="[inputP]assword">Password</label>
                                                <input name = "password" class="form-control py-4" id="password" type="password" placeholder="Enter password" />
                                                 <br>
									           <span class="valid-feedback mb3" id = "passworderror" style = "color: red"></span>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <input type = "button" class="btn btn-primary" id = "login" value = "Login" />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; The Website belongs to <a href = "https://findinteriordesign.com/">findinteriordesign.com</a></div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            $("#login").click(function (event) {
  event.preventDefault();
  var datatopost = $("#loginform").serializeArray();
  console.log(datatopost);
  $.ajax({
    url: "logincode.php",
    type: "POST",
    data: datatopost,
    success: function (data) {
      if (data == "noemail") {
        $("#emailerror").text("Please enter the email");
        $("#emailerror").show();
        $("#passworderror").text("");
      } else if (data == "nopassword") {
        $("#emailerror").text("");
        $("#passworderror").text("Please enter the password");
        $("#passworderror").show();
      } else if (data == "success") {
        location.href = "../admin.php";
      } else {
        $("#loginmessage").html(data);
        $("#loginmessage").hide();
        $("#loginmessage").fadeIn();
        $("#email").val("");
        $("#password").val("");
        $("#emailerror").text("");
        $("#passworderror").text("");
      }
    },
    error: function () {
      $("#loginmessage").html(
        "<div class = 'alert alert-danger'>Issue with ajax call.Plz try later </div>"
      );
      $("#loginmessage").hide();
      $("#loginmessage").fadeIn();
    },
  });
});     
        </script>
    </body>
</html>
