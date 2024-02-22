
function isValidPassword(password) {
    var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    return passwordRegex.test(password);
}
function passwordsMatch(password, confirmPassword) {
    
    return password === confirmPassword;

}
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
 }
 function space(input) {
    return /^\s*$/.test(input);
}
function validateSignup(event){
    let  newpassword, confirmPassword, email;
    email=document.getElementById('email').value;
    newpassword=document.getElementById('password').value;
    confirmPassword=document.getElementById('password-confirm').value;

    let newpassworderror, cpassworderror, emailerror;
    emailerror=document.getElementById('emailerror');
    newpassworderror=document.getElementById('newpasserror');
    cpassworderror=document.getElementById('cpasserror');

    isValid= true;

    if(!isValidEmail(email)){
        isValid=false;
        event.preventDefault();
        emailerror.innerHTML="*Please enter a valid email*"
    }if(space(email)){
        isValid=false;
        event.preventDefault();
        emailerror.innerHTML="*Please enter a email*"
    }if(email === ""){
        isValid=false;
        event.preventDefault();
        emailerror.innerHTML="*Please enter a email*"
    }if(!isValidPassword(newpassword)){
        isValid=false;
        event.preventDefault();
        newpassworderror.innerHTML="*Password must be at least 8 characters, contain at least one capital letter, and have at least one special character*"
    }if(newpassword===""){
        isValid=false;
        event.preventDefault();
        newpassworderror.innerHTML="*Please enter a password*";
    }if (!passwordsMatch(newpassword, confirmPassword)){
        isValid=false;
        event.preventDefault();
    }if(isValid){

    }
}
document.getElementById('password-confirm').addEventListener('input', function(){
    let password, confirmPassword, passworderror, cpassworderror;
    password=document.getElementById('password').value;
    confirmPassword=document.getElementById('password-confirm').value;
    passworderror=document.getElementById('newpasserror');
    cpassworderror=document.getElementById('cpasserror');

    if(password ==="" && confirmPassword === ""){
        passworderror.innerHTML="";
        cpassworderror.innerHTML="";
    }else{
        if(!passwordsMatch(password, confirmPassword)){
            cpassworderror.innerHTML="*Password does not match*"
            cpassworderror.style.color='red';
        }else{
            cpassworderror.innerHTML="*Password match*"
            cpassworderror.style.color='green';
        }
    }
})
document.getElementById('password-confirm').addEventListener('input', function(){
    let password, confirmPassword, passworderror, cpassworderror;
    password=document.getElementById('password').value;
    confirmPassword=document.getElementById('password-confirm').value;
    passworderror=document.getElementById('newpasserror');
    cpassworderror=document.getElementById('cpasserror');

    if(confirmPassword === ""){
        passworderror.innerHTML="";
        cpassworderror.innerHTML="";
    }else{
        if(!passwordsMatch(password, confirmPassword)){
            cpassworderror.innerHTML="*Password does not match*"
            cpassworderror.style.color='red';
        }else{
            cpassworderror.innerHTML="*Password match*"
            cpassworderror.style.color='green';
        }
    }
})

document.getElementById('password').addEventListener("input", function(){
    document.getElementById('newpasserror').innerHTML="";
});
document.getElementById('forgotpassword').addEventListener('click', validateSignup);