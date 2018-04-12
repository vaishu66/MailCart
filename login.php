<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src = "login.js"></script>
<style>
	.cover{
    background-image: url(master.jpg);
    background-repeat: no-repeat;
    background-size: cover;
	}
	.btn-lg{min-width:100px;
		min-height:50px	
	}


</style>
</head>
<body class = "cover">
    <div class="container">    
        <div id="loginbox" style="margin-top:90px;opacity: 0.8" class="mainbox col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>     
		   <div id="signupalert" style="display:none" class="alert alert-danger">
                            <span id = "lerr"></span>
                   </div>
                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="email" placeholder = "Email-Id">                                      
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                                    </div>
                                    

                                                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">
                                      <button id="btn-login" type="button" class="btn btn-info" onClick="$('#loginbox').hide();$('#level2Login').show"> &nbsp Next</button>
				      
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-12 control">
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                            Don't have an account! 
                                        <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show(); $('#level2box').hide">
                                            Sign Up Here
                                        </a>
                                        </div>
                                    </div>
                                </div>    
                            </form>     



                        </div>                     
                    </div>  
        </div>
	<div id="level2login" style="display:none;margin-top:90px;opacity: 0.8;" class="mainbox col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Personal question</div>
                    </div>     
		<div id="level2alert" style="display:none" class="alert alert-danger">
                            <span id = "l2err"></span>
                   </div>
                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="level2-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="level2form1" class="form-horizontal" role="form">
                            <div style="margin-bottom: 25px" class="input-group">
                                  <input id="questionCheck" style="width:500px;" type="text" class="form-control" name="answer" placeholder="answer" readonly>
                                    </div>
                            <div style="margin-bottom: 25px" class="input-group">
                                  <input id="answer" type="text" class="form-control" name="answer" placeholder="answer">
                                    </div>

                                <div style="margin-top:10px" class="form-group">
				    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-level2" type="button" class="btn btn-info" onClick="$('#level2Login').hide();$('#level3Login').show">&nbsp Next</button>
                                    </div>
                                </div> 

  
                            </form>     



                        </div>                     
                    </div>  
        </div>
	<div id="level3login" style="display:none;margin-top:90px;opacity: 0.8;" class="mainbox col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Graphical Password</div>
                    </div>     
			<div id="level3alert" style="display:none" class="alert alert-danger">
                            <span id = "l3err"></span>
                   </div>
                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="level3-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="level3form" class="form-horizontal" role="form" action="try.php">
                             <p>Enter the color pattern</p>      
                            <div style="margin-bottom: 25px" class="input-group">
				<button id="" type="button" class="btn btn-primary btn-lg" onclick="generateString('00')">       </button>
  				<button id="" type="button" class="btn btn-success btn-lg" onclick="generateString('01')">        </button>
  				<button id="" type="button" class="btn btn-warning btn-lg" onclick="generateString('10')">        </button>
  				<button id="" type="button" class="btn btn-danger btn-lg" onclick="generateString('11')">         </button>
                             </div>
                             <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1" onclick="remember()"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
				   <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-level3" type="button" class="btn btn-info" onClick="document.location.href = #"><i class="icon-hand-right"></i> &nbsp Next</button>
                                    </div>
                                </div>

  
                            </form>     



                        </div>                     
                    </div>  
        </div>
        <div id="signupbox" style="display:none; margin-top:70px;opacity: 0.8" class="mainbox col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="signupform" action="loginCheck.php" method="POST" class="form-horizontal" role="form">
                                
                                <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <span id = "err"></span>
                                </div>
                                    
                                
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id = "email" name="email" placeholder="Email Address">
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id = "fname" name="firstname" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lastname" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id = "lname" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
				<div class="form-group">
                                    <label for="gender" class="col-md-3 control-label">Gender</label>
                                    <div class="col-md-9">
                                        <class="form-control">
						<select id = "gender" name="gender">
						<option value="female" > Female </option>
						<option value="male" > Male </option>
						<option value="other" > Other </option>
						</select>
                                    </div>
                                </div>
				<div class="form-group">
                                    <label for="alter_mail" class="col-md-3 control-label">Alternate email for password recovery</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id = "alt_email" name="alt_email" placeholder="Specify the alternative email id for password recovery">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id = "passwd" name="passwd" placeholder="Password">
                                    </div>
                                </div>
				<div class="form-group">
                                    <label for="repassword" class="col-md-3 control-label">Confirm Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id = "repasswd" name="repasswd" placeholder="re-enter Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="button" class="btn btn-info" onClick="addUser()"><i class="icon-hand-right"></i> &nbsp Next</button>
                                    </div>
                                </div>
                                
                            </form>
                         </div>
                    </div>

               
               
                
         </div> 
	<div id="level2box" style="display:none;margin-top:90px;opacity: 0.8;" class="mainbox col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Personal question</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="level2-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="level2form" class="form-horizontal" role="form">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
				 <select id="select_question" class="form-control">                                
                                        <option >Select a security question</option>
					<option>What was the name of your primary school?</option>
					<option>What time of the day were you born?</option>
					<option>What is your favorite movie?</option>
					<option>What is your birth place?</option>
					<option>Where is your dream vacation place?</option>
					<option>What is your favorite food?</option>
					<option>Who is your favorite musician?</option>
				</select>      
                              </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                  <input id="answer" type="text" class="form-control" name="answer" placeholder="answer">
                                    </div>

                                <div style="margin-top:10px" class="form-group">
				    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-level2" type="button" class="btn btn-info" onClick="addLevel2()">&nbsp Next</button>
                                    </div>
                                </div>

  
                            </form>     



                        </div>                     
                    </div>  
        </div>
	<div id="level3box" style="display:none;margin-top:90px;opacity: 0.8;" class="mainbox col-md-6 col-md-offset-4 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Graphical Password</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="level3-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="level3form" class="form-horizontal" role="form" action="try.php">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
				<button id="" type="button" class="btn btn-primary btn-lg" onclick="generateString('00')">       </button>
  				<button id="" type="button" class="btn btn-success btn-lg" onclick="generateString('01')">        </button>
  				<button id="" type="button" class="btn btn-warning btn-lg" onclick="generateString('10')">        </button>
  				<button id="" type="button" class="btn btn-danger btn-lg" onclick="generateString('11')">         </button>
                             </div>
                             <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1" onclick="remember()"> Remember me
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
				   <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-level3" type="button" class="btn btn-info" onClick="document.location.href = # ;addLevel3()"><i class="icon-hand-right"></i> &nbsp Next</button>
                                    </div>
                                </div>

  
                            </form>     



                        </div>                     
                    </div>  
        </div>
    </div>
   </body>
</html>
