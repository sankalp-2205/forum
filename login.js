$("#login").click(function (event) {
  event.preventDefault();
  var datatopost = $("#loginform").serializeArray();
  console.log(datatopost);
  $.ajax({
    url: "/forum-tutorial/login.php",
    type: "POST",
    data: datatopost,
    success: function (data) {
      if (data == "nologinusername") {
        $("#loginusernameerror").text("Please enter the username");
        $("#loginusernameerror").show();
        $("#loginpassworderror").text("");
      } else if (data == "nologinpassword") {
        $("#loginusernameerror").text("");
        $("#loginpassworderror").text("Please enter the password");
        $("#loginpassworderror").show();
      } else if (data == "success") {
        location.reload(true);
      } else {
        $("#loginmessage").html(data);
        $("#loginmessage").hide();
        $("#loginmessage").fadeIn();
        $("#loginusername").val("");
        $("#loginpassword").val("");
        $("#loginusernameerror").text("");
        $("#loginpassworderror").text("");
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
