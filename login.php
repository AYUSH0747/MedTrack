<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>MedTrack-Login</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><link rel="stylesheet" href="./login_style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<h1>Med<br>Track</h1><br>
		<p>Track your medical history effectively</p>
		<span>
			<p>login with social media</p>
			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		</span>
		</div>
	</div>
	
		<script src="script.js"></script>
		<div class="right">
		<h5 align="center">Login</h5>
		
    <form action="login_process.php" method="POST" class="login"	name="login" id="loginform" onsubmit="return validateform()">
      <div class="inputs">
        <input type="text" class="email" name="email" id="email"placeholder="Email">
        <br>
        <input type="password" class="Password" name="password" id="password"placeholder="password">
      </div>
        
      <br><br>
      <p>Don't have an account? <a href="Register.php">Create Your Account</a> it takes less than a minute</p>
        
      <div class="remember-me--forget-password">
          <!-- Angular -->
        <label>
          <input type="checkbox" name="item" checked/>
          <span class="text-checkbox">Remember me</span>
        </label>
          <p>forget password?</p>
        </div>
        
        <br>
        <button type="submit">Login</button>
      </div>
    </form>
	
</div>
<!-- partial -->
  
</body>
</html>
