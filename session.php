<?php
//start the session
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

//check if the session is on then redirect the user
if (isset($_SESSION["email"]) && $_SESSION["email"] === true)
{
	header("location: dashboard.php");
	exit;
}

?>