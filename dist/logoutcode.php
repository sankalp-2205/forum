<?php
session_start();
if(array_key_exists("adminemail",$_SESSION) && $_POST['logout']=="true")
   {
        session_destroy();
   }
?>
