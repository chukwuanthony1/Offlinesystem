<?php

 	include_once "inc/header.php";
    require_once "session.php";
    require_once "connect.php"; 

    if(!isset($_SESSION['email'])) {
    //die("You must Login to access the page!");
    header("location: login.php");
    $_SESSION['message'] = "You must Login to access the page!";
	$_SESSION['msg_type'] = "danger";
}

	$result = $db ->query("SELECT * FROM offline_switch WHERE user_id='{$_SESSION['id']}'") or die($db->error);
	if ($result->num_rows > 0) {

    	while ($row = $result->fetch_assoc()) {
        		$switch = $row['switch'];
				$date = $row['end_date'];
				$time = $row['end_time'];
				$id = $row['id'];
				$turnon = "On";
    }
   } else{

			$switch ="";
			$date = "";
			$time = "";
			$id = "";
    }

    $db->close();

    if ( isset($_POST["delete"])) {

    	$message = "Are sure you want delete?";
		echo "<script type='text/javascript'>alert('$message');</script>";
    }
 ?>



    <div class="container">
			<?$name=$_SESSION['name'];
            $firstname = strtok($name, ' ');
            ?>

	      <div class="jumbotron text-center"><h2> Welcome to my Laravel Class 2020</h2>
	            <p><a class="btn btn-primary btn-lg" href="logout.php" role="button">Logout</a>  <a class="btn btn-success btn-lg" href="status.php" role="button">View User</a></p>
	            <p>We teach any IT related courses here and it is very affordable</p>
	        </div>

		<table class="table">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">First Name</th>
		      <th scope="col">Switch</th>
		      <th scope="col">Coming Back Date</th>
		      <th scope="col">Coming Back Time</th>
		      <th scope="col">Actions</th>
		    </tr>
		  </thead>	

		<form action="connect.php" method="Post">		  
		  <tbody>	 
			
		    <tr>
		      <th scope="row">1</th>
		      <td><?echo $firstname;?></td>
			<td><label class="switch">
				<input type="checkbox" value="1" name="switch" <? if ($switch) echo "checked"; ?>>
				<div class="slider round">
				</div></label>
			</td>
	      	<td>  
		      	<label for="birthday">Date:</label>
  				<input type="date" id="birthday"  value="<?php echo $date;?>" name="date">
			</td>
			<td>  
		      	<label for="birthday">Time:</label>
  				<input type="time" id="appt" value="<?php echo $time;?>"  name="time">
			</td>
			<td  colspan="2">  
			<?php if ($result->num_rows > 0):?>
				<button type="submit" name="update" class="btn btn-warning">Update</button>
				<button type="submit" name="delete" class="btn btn-danger">Delete</button>
			<?php else:?>
				<button type="submit" name="office_switch" class="btn btn-primary">Save</button>
			<?php endif;?>
			</td>
	    </tr>
		  </tbody>
		</table>
	</form>
<?php include_once "inc/footer.php";?>


