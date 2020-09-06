<?php
     include_once "inc/header.php";
     require_once "connect.php";

?>

	 <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
                    <div class="panel-heading">
                        <div class="panel-title"><h2>Sign In<h2></div>
                    </div>     
                    <div style="padding-top:30px" class="panel-body" >
                    </div>
                            
                         <form action="connect.php" method="post" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                <span class="input-group-addon"><i class="glyphicon phicon-user"></i></span>
                                <input id="login-username" type="email" class="form-control" name="email" placeholder="Email" require>                                        
                        </div>                              
                                <div style="margin-bottom: 25px" class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="password" required>
                                </div>        
                            <div class="input-group">
                              <div class="checkbox">
                                <label>
                                    <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                </label>
                              </div>
                            </div>
                        <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                            <div class="col-sm-12 controls">
                               <input type="submit" name="login" class="btn btn-success" value="Login">
                               <div style="float:right; font-size: 80%; padding-top:13px"><a href="#">Forgot password?</a>
                               </div>
                            </div>
                   		 </div>

                            <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                            <a href="registration.php">Sign Up Here</a>
                                        </div>
                                    </div>
                           </div>
                        </div>                     
                 </div> 
<?php include_once "inc/footer.php";?>