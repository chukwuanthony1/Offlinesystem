<?php
//start the session
session_start();

//check if the session is on then redirect the user
if(session_destroy())
{
	header("location: index.php");
	exit;
}

?>