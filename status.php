
<style type="text/css">
    .hidden {
      visibility: hidden;
    }
  </style>
<?php

 	include_once "inc/header.php";
    //require_once "session.php";
    require_once "connect.php"; 

    if(!isset($_SESSION['email'])) {
    header("location: login.php");
    $_SESSION['message'] = "You must Login to access the page!";
	$_SESSION['msg_type'] = "danger";
}
   ?>
   <div class="container">
 
 	<?php

		if(isset($_POST['search_button'])) {
			$search=trim($_POST['search']);
			$result = $db ->query("SELECT users.*, offline_switch.* FROM users, offline_switch WHERE users.names like '%$search%' && users.id=offline_switch.user_id") or die($db->error);
			
	}
		else {
			$result = $db ->query("SELECT users.*, offline_switch.* FROM users,offline_switch WHERE users.id=offline_switch.user_id ORDER BY date_time DESC") or die($db->error);
		} 

		?>
		 <table class="table">
		  	<thead >
			    <tr>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th scope="col"></th>
			      <th colspan="2">
			      	<form class="form-inline my-2 my-lg-0" action="" method="post">
      					<input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
      					<button class="btn btn-outline-success my-2 my-sm-0" name="search_button" type="submit">Search</button>
    				</form>
    			</th>
			  </thead>
			  <tbody>
			  <thead class="thead-light">
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Full Name</th>
			      <th scope="col">Last Seen</th>
			      <th scope="col">Returning Date</th>
			      <th scope="col">Returning Time</th>
			      <th scope="col">Status</th>
			      <th scope="col">Email</th>
			     </thead>
			  <tbody>
			  	<?php

			while($row = $result->fetch_assoc()):

        		$name = $row['names'];
        		$recieve_email = $row['email'];
        		$date_time = $row['date_time'];
        		$switch = $row['switch'];
				$date = $row['end_date'];
				$time = $row['end_time'];
				$id = $row['id'];

				if ($switch) {

					$switch = "On";
				}
	   ?>
			    <tr>
			    	<td>1</td>
			      	<td><?php echo $name;?></td>      
			       	<td><?php echo $date_time;?></td>
			     	<td><?php echo $date;?></td>
			       	<td><?php echo $time;?></td>
<!-- 			     <td style="color: green; font-weight: 900;"><?php echo $switch;?></td>
 -->			     <td>
				      	<label class="switch">
			      		<input name="switch" <? if ($switch) echo "checked"; ?> type="checkbox" disabled>
		  				<span  class="slider round"></span>
					</td>
					<td><form class="form-inline my-2 my-lg-0" action="" method="post">
      					<button class="btn btn-primary" name="send_email" type="submit">Email</button>
    				</form></td>
		   	 </tr>

				<?php endwhile;?>
			  </tbody>

		</table>	
</div>
 <?

/*		if(isset($_POST['send_email'])){
			echo "yes am hetre";
			$Sender_name=$_SESSION['name'];
            $firstname = strtok($Sender_name, ' ');

			$to = 'chukwuanthony1@gmail.com';
			$subject = 'Out of Offfice';
			$message = 'Hi,nn This is test email send by PHP Script'; 
			//$from = 'MrAnthony.chukuw1@gmail.com';
			$headers = "From: mranthony.chukwu1@gmail.com";*/

			 
			// Sending email
		/*	if(mail($to, $subject, $message,$headers)){

			   		 $_SESSION['message'] = "Your mail has been sent successfully";
					$_SESSION['msg_type'] = "success";
			} else{
			   		$_SESSION['message'] = "Unable to send email. Please try again.";
					$_SESSION['msg_type'] = "danger";
			}
		}
*/

?> 
<?php include_once "inc/footer.php";?>