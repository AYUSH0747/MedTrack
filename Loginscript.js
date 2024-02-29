function validateform(){

    //Email Validation
    let email = document.getElementById("email").value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if(email==""){
        alert("Email Field cannot be empty");
        document.login.email.focus();
        return false;
    }
    else if(!emailRegex.test(email)){
        alert("Invalid Email Format");
        document.login.email.focus();
        return false;
    }

    //Password Validation

    let password=document.getElementById("password").value;
    if(password==""){
        alert("Password field cannot be Empty");
        document.login.password.focus();
        return false;
    }
    else if(password.length < 6){
        alert("Password must be atleast 6 characters long.");
        document.login.password.focus();
        return false;
    }
    else if(!containsUppercase(password)){
        alert("First Character of Password field must be Uppercase.");
        document.login.password.focus();
        return false;
    }
    else if(!containsSpecialCharacter(password)){
        alert("Password must contain a Special Character.");
        document.login.password.focus();
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