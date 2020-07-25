<?php
session_start();
include ('connection.php');
date_default_timezone_set("Asia/Kolkata");

//errors
$nousername ="<p><strong>Enter the username</strong></p>";
$nopassword = "<p><strong>Enter the password</strong></p>";

if(empty($_POST["usernameinput"]))
    {
        echo "nologinusername";
        exit;
    }
if(empty($_POST["passwordinput"]))
        {
            echo "nologinpassword";
            exit;
        }
$loginpassword = $_POST["passwordinput"];
$loginusername = $_POST["usernameinput"];

        $loginusername = $link ->real_escape_string($loginusername); 
        $loginpassword = $link ->real_escape_string($loginpassword);
        $sql = "SELECT * FROM users WHERE username = '$loginusername' AND password = '$loginpassword'";
        if($result = $link ->query($sql))
        {
             if($result->num_rows > 0)
             {
                $rows = $result -> fetch_array(MYSQLI_ASSOC);
                $_SESSION['username'] = $rows['username'];
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