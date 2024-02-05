function validateform(){

    //first name validation

    let firstname=document.getElementById("first_name").value;
    if(firstname==""){
        alert("First Name field cannot be empty");
        document.form1.fn.focus();
        return false;
    }
    else if(!preventnameSQLI(firstname)){
        alert("First Name should only contain alphabets");
        document.form1.fn.focus();
        return false;
    }

    //Last Name Validation

    let lastname=document.getElementById("last_name").value;
    if(lastname==""){
        alert("Last Name field cannot be empty");
        document.form1.ln.focus();
        return false;
    }
    else if(!preventnameSQLI(lastname)){
        alert("Last Name should only contain alphabets");
        document.form1.ln.focus();
        return false;
    }

    //Username Validation

    let username=document.getElementById("username").value;
    if(username==""){
        alert("Username field cannot be empty");
        document.form1.username.focus();
        return false;
    }
    else if(!preventusernameSQLI(username)){
        alert("Username can only contain alphabets, numbers and underscores");
        document.form1.username.focus();
        return false;
    }

    //Password Validation

    let password=document.getElementById("password").value;
    if(password==""){
        alert("Password field cannot be Empty");
        document.form1.ps.focus();
        return false;
    }
    else if(password.length < 6){
        alert("Password must be atleast 6 characters long.");
        document.form1.ps.focus();
        return false;
    }
    else if(!containsUppercase(password)){
        alert("First Character of Password field must be Uppercase.");
        document.form1.ps.focus();
        return false;
    }
    else if(!containsSpecialCharacter(password)){
        alert("Password must contain a Special Character.");
        document.form1.ps.focus();
        return false;
    }


    //Validation for Confirm password
    let confirmPassword=document.getElementById("Confirm_password").value;
    if(confirmPassword==""){
        alert("Confirm password field cannot be empty");
        document.form1.cps.focus();
        return false;
    }
    else if(confirmPassword!=password){
        alert("Confirm password doesn't match the entered password");
        document.form1.cps.focus();
        return false;
    }

    //Validation for Email
    let email=document.getElementById("email").value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(email==""){
        alert("Email field cannot be empty.");
        document.form1.email.focus();
        return false;
    }
    else if(!emailRegex.test(email)){
        alert("Invalid Email Format");
        document.form1.email.focus();
        return false;
    }

    //Validation of Phone Number
    var phone=document.getElementById("phone_number").value;
    var phoneRegex = /^\d{10}$/;
    if(phone==""){
        alert("Phone number field cannot be empty.");
        document.form1.pn.focus();
        return false;
    }
    else if(!phoneRegex.test(phone)){
        alert("Invalid Phone number format.");
        document.form1.pn.focus();
        return false;
    }

    //Validation of Address
    var address=document.getElementById("address").value;
    if(address==""){
        alert("Address is a required field.");
        document.form1.address.focus();
        return false;
    }
    else if(!preventaddressSQLI(address)){
        alert("Address should not contain any special character");
        document.form1.address.focus();
        return false;
    }

    //Validation for Checkbox
    if(!this.form1.check.checked){
        alert("You must agree to terms and conditions");
        document.form1.check.focus();
        return false;
    }
}
function containsUppercase(str){
    var passwordRegex = /^[A-Z]/;
    return passwordRegex.test(str);
}
function containsSpecialCharacter(str){
    var specialCharacterRegex = /[!@#$%^&*(),.?":{}|<>]/;
    return specialCharacterRegex.test(str);
}

function preventnameSQLI(str){
    var preventnamesqliRegex = /^[A-Za-z]+$/;
    return preventnamesqliRegex.test(str);
}

function preventaddressSQLI(str){
    var preventaddresssqliRegex = /^[A-Za-z0-9\s\-,.#]+$/;
    return preventaddresssqliRegex.test(str);
}

function preventusernameSQLI(str){
    var preventusernamesqliRegex = /^[a-zA-Z0-9_]*$/;
    return preventusernamesqliRegex.test(str);
}
