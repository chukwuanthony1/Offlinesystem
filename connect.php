<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'root');
define('DBPASSWORD', '');
define('DBNAME', 'offline_system');

//connecting to database here
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

//Checking the connection
if($db === false)
{
	die("Error : connection error. ".mysqli_connect_error());
}

// registrations code
    if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["submit"])) 
    {
    	//$_SESSION['message']='';

        $fullname = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $confirm_password = trim($_POST["confirm_password"]);

		$password_hash = password_hash($password, PASSWORD_BCRYPT);
	
		if ($query = $db->prepare("SELECT * FROM users WHERE email = ?")) 
        {

            $query->bind_param('s', $email);
            $query->execute();
            $query->store_result();

            if ($query->num_rows > 0)
            {
               // $error.='<p class="error"> The email address has been used!</p>';
            	header("location: registration.php");
                $_SESSION['message'] = "The email address has been used!";
				$_SESSION['msg_type'] = "danger";
            }
            else
            {
                if (strlen($password)<6)
                {
                    //$error.='<p class="error"> The password must have atleast 6 character!</p>';
                    header("location: registration.php");
                    $_SESSION['message'] = "The password must have atleast 6 character!";
					$_SESSION['msg_type'] = "danger";
                }
            }

            if (empty($confirm_password))
            {
               // $error.='<p class="error"> Please confirm your password!</p>';
            	$_SESSION['message'] = "Please confirm your password!";
				$_SESSION['msg_type'] = "danger";
            }

            else
            {
               if (empty($_SESSION['message']) && ($password !=$confirm_password ))
               {
                    //$error.='<p class="error"> The password does not match!</p>';
               		header("location: registration.php");
               		$_SESSION['message'] = "The password does not match!";
					$_SESSION['msg_type'] = "danger";
               }
            }
            if (empty($_SESSION['message'])) 
            {
                $insertQuery = $db->prepare("INSERT INTO users (names, email, password) VALUES (?,?,?);");
                $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
                $result = $insertQuery->execute();
                if ($result)
                {
        			$_SESSION['message'] = "Succssfully Registered";
					$_SESSION['msg_type'] = "success";
					header("location: login.php");
					exit;
        		}
                else 
                {
                    //$error.='<p class="error"> Something went wrong!</p>';
                    header("location: registration.php");
                    $_SESSION['message'] = "Something went wrong!";
					$_SESSION['msg_type'] = "danger";
                }
            }
        
}
        $query->close();
        //close DB connection
        mysqli_close($db);

    }

//Login page 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){
       
       $email = trim($_POST["email"]);
       $password = trim($_POST["password"]);

    	/*$email = mysqli_real_escape_string($db,$_POST['email']);
    	$password = mysqli_real_escape_string($db,$_POST['password']);*/

        //validate if the email is not empty
        if (empty($email)){

        	//$error.='<p class="error"> Please provide your email!</p>';
        	$_SESSION['message'] = "Please provide your email!";
			$_SESSION['msg_type'] = "danger";
        }
        //validate if the password is not empty
        if (empty($password)){

        	//$error.='<p class="error"> Please provide your password!</p>';
        	$_SESSION['message'] = "Please provide your password!";
			$_SESSION['msg_type'] = "danger";
        }
        if (empty($_SESSION['message'])){

        	if ($query = $db->prepare("SELECT id, password, names FROM users WHERE email = ?")){
		        $query->bind_param('s', $_POST['email']);
		        $query->execute();
		       	//$row = $query->fetch();
		       	$query->store_result();

	       		if ($query->num_rows > 0){
	       			$query->bind_result($id, $password, $name);
					$query->fetch();

					if (password_verify($_POST['password'], $password)){
						session_regenerate_id();
	            		$_SESSION['loggedin'] = TRUE;
	            		$_SESSION['email'] = $email;
	            		$_SESSION['name'] = $name;
						$_SESSION['id'] = $id;
			      		//Direct the user to dashboard
	            		header("location: dashboard.php");
	            		exit;
	            	} else {
	            		
	            		$_SESSION['message'] = "Invalid password!!";
						$_SESSION['msg_type'] = "danger";
						header("location: login.php");
	            	}

	            	} else {
	            		
	            		$_SESSION['message'] = "Incorrect details!";
						$_SESSION['msg_type'] = "danger";
						header("location: login.php");

	            	}
        }

        $query->close();
        //close DB connection
      }
        mysqli_close($db);
    }

	$switch = "";
	$date = "";
	$time = "";
	$turnon = "Off";


 
    //Switch part
     if ( isset($_POST["office_switch"]) && ($_POST["switch"]!="1")) {

    		$_SESSION['message'] = "Please turn-on the switch before saving";
			$_SESSION['msg_type'] = "danger";
			header("location: dashboard.php");
    	# code...
    }
    elseif (isset($_POST["office_switch"]) && ($_POST["switch"]=="")) {

    		$_SESSION['message'] = "Please choose the date saving";
			$_SESSION['msg_type'] = "danger";
			header("location: dashboard.php");
    	# code...
    }
    elseif (isset($_POST["office_switch"]) && ($_POST["time"]=="")) {

    		$_SESSION['message'] = "Please choose the time saving";
			$_SESSION['msg_type'] = "danger";
			header("location: dashboard.php");
    }
    else{

    	if (isset($_SESSION['id']) && isset($_POST["office_switch"]) && ($_POST["switch"]=="1")) {  

	    	$date_time = date('Y-m-d H:i:s');
	    	$switch = $_POST['switch'];
			$date = $_POST['date'];
			$time = $_POST['time'];

			$db ->query("INSERT INTO offline_switch (date_time, end_date, end_time, user_id, switch) VALUES ('$date_time','$date', '$time', '{$_SESSION['id']}', '$switch')") or die($db->error);
			$_SESSION['message'] = "You have set your out of office succssfully";
			$_SESSION['msg_type'] = "success";
			header("location: dashboard.php");		
    	}
   }
  

  			//Delete Out of office
   		if ( isset($_POST["delete"])) {

				$db->query("DELETE FROM offline_switch WHERE user_id='{$_SESSION['id']}'") or die($db->error);
				$_SESSION['message'] = "Your are now available";
				$_SESSION['msg_type'] = "danger";
				header("location: dashboard.php");	
			}

//The update button
if (isset($_POST['update'])){

	$date_time = date('Y-m-d H:i:s');
	$switch = $_POST['switch'];
	$date = $_POST['date'];
	$time = $_POST['time'];

		if ($_POST["switch"]!="1"){

			$_SESSION['message'] = "Please turn-on the switch before updating";
			$_SESSION['msg_type'] = "danger";
			header("location: dashboard.php");
		# code...
		}
		elseif ($_POST["date"]=="") {

			$_SESSION['message'] = "Please choose the new date before updating";
			$_SESSION['msg_type'] = "danger";
			header("location: dashboard.php");
		# code...
		}
		elseif  ($_POST["$time"]=="") {

			$_SESSION['message'] = "Please choose the new time before updating";
			$_SESSION['msg_type'] = "danger";
			header("location: dashboard.php");
		}
		else{

			$db->query("UPDATE offline_switch SET end_date='$date', end_time='$time', switch='$switch' WHERE user_id='{$_SESSION['id']}'") or die($db->error);

			$_SESSION['message'] = "Your out of Office has been updated";
			$_SESSION['msg_type'] = "warning";
			header("location: dashboard.php");
		}
}

?>