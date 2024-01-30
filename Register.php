
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MedTrack - Register</title>
	<link rel="stylesheet" href="style.css">
    
</head>
<body>
<script src="Registerscript.js"></script>
<div class="wrapper">
    <div class="title">
      Register
    </div>
    <form action="Register_process.php" method="POST" class="form" name="form1" id="registrationForm" onsubmit=" return validateform() ">
       <div class="inputfield" style="margin-bottom: 1px;">
          <label for="Firstname">First Name (*)</label>
          <input type="text" name="fn" id="first_name" class="input" placeholder="First Name">
       </div><br> 
        <div class="inputfield">
          <label for="Lastname">Last Name (*)</label>
          <input type="text" class="input" name="ln" id="last_name" placeholder="Last Name">
       </div>
       <div class="inputfield">
          <label for="Username">User Name (*)</label>
          <input type="text" class="input" name="username" id="username" placeholder="Username">
       </div>
       <div class="inputfield">
          <label for="Password">Password (*)</label>
          <input type="password" class="input" name="ps" id="password" placeholder="Password">
       </div>
      <div class="inputfield">
          <label for="Confirmpassword">Confirm Password(*)</label>
          <input type="password" class="input" name="cps" id="Confirm_password" placeholder="Confirm Password">
       </div>
       <div class="inputfield">
          <label>Date of Birth (*)</label>
          <input type="date" class="input" name="DOB" id="DOB">
       </div>
        <div class="inputfield">
          <label for="Gender">Gender</label>
          <div class="custom_select">
            <select name="gender">
              <option value="" name="default" id="gender">--Select--</option>
              <option value="male" id="gender">Male</option>
              <option value="female" id="gender">Female</option>
              <option value="secret" id="gender">Prefer Not to Say</option>
            </select>
          </div>
       </div>
        <div class="inputfield">
          <label for="Email">Email Address (*)</label>
          <input type="text" class="input" name="email" id="email" placeholder="Email">
       </div>
      <div class="inputfield">
          <label for="Phonenumber">Phone Number (*)</label>
          <input type="text" class="input" name="pn" id="phone_number" placeholder="Phone Number">
       </div>
      <div class="inputfield">
          <label for="Address">Address (*)</label>
          <textarea class="textarea" name="address" id="address" placeholder="Address"></textarea>
       </div> 
      <div class="inputfield terms">
          <label class="check">
            <input type="checkbox" class="input" name="check" id="check">
            <span class="checkmark"></span>
          </label>
          <p>Agreed to terms and conditions (*)</p>
       </div> 
      <div class="inputfield">
        <input type="submit" value="Register" class="btn">
      </div>
      <div class="inputfield">
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
    </form>
</div>	
</body>
</html>