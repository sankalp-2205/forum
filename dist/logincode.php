<?php
session_start();
include ('../connection.php');
date_default_timezone_set("Asia/Kolkata");
if(empty($_POST["email"]))
    {
        echo "noemail";
        exit;
    }
if(empty($_POST["password"]))
        {
            echo "nopassword";
            exit;
        }
$email = $_POST["email"];
$password = $_POST["password"];
        $email = $link ->real_escape_string($email); 
        $password = $link ->real_escape_string($password);
        $sql = "SELECT * FROM admin WHERE admin_email = '$email' AND admin_password ='$password'";
        if($result = $link ->query($sql))
        {
             if($result->num_rows == 1)
             {
                $rows = $result -> fetch_array(MYSQLI_ASSOC);
                $_SESSION['adminemail'] = $rows['admin_email'];
                    echo "success";
             }
             else{
                echo "<div class='alert alert-danger'>Enter correct user id and password</div>";
            }
        }
       else
       {
           echo "<div class='alert alert-danger'>Could not run the query</div>";
       }
?>