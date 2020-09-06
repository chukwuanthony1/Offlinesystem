
    <?php 
        include_once "inc/header.php";
        require_once "connect.php"; 

    ?>
    <div class="container">

        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="form">
                <div class="note">
                    <h2><p>Registration Forms.</p></h2>

                </div>
            <div style="padding-top:30px" class="panel-body" >

            <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                <form action="connect.php" method="Post" class="form-horizontal" role="form">
                <div class="form-content">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" id="name" class="form-control" name="name" value="" placeholder="Your Full Name *" required>                  
                     </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class="form-control" name="email" value="" placeholder="Email *" required>                                        
                     </div>
                      <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="Password *" required>
                        </div>
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="confirm_password" placeholder="Confirm password *" required>
                        </div>
                        </div>
                    </div>
                    <div style="padding-top:20px" class="input-group">
                        <input type="submit" name="submit" class="btn btn-success" value="Submit">
                    </div>
                </div>
            </div>
        </div>
	</div>
<?php include_once "inc/footer.php";?>