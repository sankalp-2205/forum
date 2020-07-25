<?php
	session_start();
	session_destroy();
	header("Location: /forum-tutorial/index2.php");
?>