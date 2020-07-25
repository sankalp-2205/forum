
<?php
    session_start();
    include('connection.php');
    echo "Here";
    exit;
    if(empty($_POST["registerusername"]))
    {
        echo "nousername";
        exit;
    }
    if(empty($_POST["registeremail"]))
    {
        echo "noemail";
        exit;
    }
        // else
        // {
        //     $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
        //     if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        //     {
        //         echo "invalidemail";
        //         exit;
        //     }
        // }
        if(empty($_POST["registerpassword"]))
        {
            echo "nopassword";
            exit;
        }
    // elseif(!(strlen($_POST["registerpassword"])>6 and preg_match('/[A-Z]/',$_POST["registerpassword"]) and preg_match('/[0-9]/',$_POST["registerpassword"])))
    // {
    //     echo "invalidpassword";
    //     exit;
    // }
    // else
    // {
    //     if(empty($_POST["password2"]))
    //     {
    //         $errors .= $nopassword2;
    //         echo "noconfirmpassword";
    //         exit;
    //     }
    //         elseif($_POST["password"] !== $_POST["password2"])
    //          {
    //              $errors .= $passworddidnotmatch;
    //              echo "passwordsdidnotmatch";
    //              exit;
    //          }
    //     }

    $username = $_POST["registerusername"];
    $password = $_POST["registerpassword"];
    $email = $_POST["registeremail"];


    
       $username = $link ->real_escape_string($username); 
        $password = $link ->real_escape_string($password);
        $email = $link ->real_escape_string($email);
            
            // verifying existing username
        $sql = "SELECT * FROM users WHERE username = '$username'";
        if($result = $link ->query($sql))
        {
            if($result->num_rows > 0)
            {
                echo "usernameexists";
                exit;
            }
        }
        else
        {
            echo "<div class = 'alert alert-danger'>Unable to run username query</div>";
        }

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password');";
        if($result = $link ->query($sql))
        {
            $_SESSION['username'] = $username;
            echo "success";
        }
            
            // verifying existing email
            
        // $sql = "SELECT * FROM users WHERE email = '$email'";
        //  if($result = $link ->query($sql))
        // {
        //     if($result->num_rows > 0)
        //     {
        //         echo "emailexists";
        //         // echo "<div class = 'alert alert-danger'>The email is already registered</div>";
        //     exit;
        //     }
        // }
        // else
        // {
        //     echo "<div class = 'alert alert-danger'>Unable to run email query</div>";
        // }
            
            //activation code
            
            // $activation_code = bin2hex(openssl_random_pseudo_bytes(16));
            // $sql = "INSERT INTO users (username,name, email, password, contact, state, city, locality, profilepicture,notification_clicked, activation) VALUES ('$username','$name','$email', '$password', '$contact','$state','$city','$locality','NULL' ,true,'$activation_code')";
            // if($link->query($sql))
            // {
            //     //sending mail 
                
            //     $message = "<p>Click on the link below to register your account on the online notes app</p>";
            //     $message .= "http://websh.offyoucode.co.uk/dog%20matrimony/activation.php?email=".urlencode($email). "&key=$activation_code";
            //     $header = "Content-type : text/html;";
                
            //         $sent_mail = mail($email, "Confirm your registration", $message, $header);
            //          if($sent_mail)
            //         {
            //             echo "<div class = 'alert alert-success'>Click on the link sent to your email address to register your account</div>";
            //         }
            //         else
            //         {
            //             echo "<div class = 'alert alert-danger'>Unable to register right now. Please try later</div>";
            //         }
                
            // }
            // else{

            //     echo "<div class = 'alert alert-danger'>Unable to run mail sending query</div>";
                    
            // }
?>