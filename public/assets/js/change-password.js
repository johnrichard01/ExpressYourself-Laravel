
function isValidPassword(password) {
    var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    return passwordRegex.test(password);
}
function passwordsMatch(password, confirmPassword) {
    
    return password === confirmPassword;

}

function validateSignup(event){
    let  oldpass, newpassword, confirmPassword;
    oldpass=document.getElementById('old_password').value;
    newpassword=document.getElementById('new_password').value;
    confirmPassword=document.getElementById('confirm_password').value;

    let oldpasserror, newpassworderror, cpassworderror;
    oldpasserror=document.getElementById('oldpasserror');
    newpassworderror=document.getElementById('newpasserror');
    cpassworderror=document.getElementById('cpasserror');

    isValid= true;

    if(!isValidPassword(oldpass)){
        isValid=false;
        event.preventDefault();
        oldpasserror.innerHTML="*Password must be at least 8 characters, contain at least one capital letter, and have at least one special character*"
    }if(oldpass===""){
        isValid=false;
        event.preventDefault();
        oldpasserror.innerHTML="*Please enter a password*";
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
document.getElementById('confirm_password').addEventListener('input', function(){
    let password, confirmPassword, passworderror, cpassworderror;
    password=document.getElementById('new_password').value;
    confirmPassword=document.getElementById('confirm_password').value;
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
document.getElementById('new_password').addEventListener('input', function(){
    let password, confirmPassword, passworderror, cpassworderror;
    password=document.getElementById('new_password').value;
    confirmPassword=document.getElementById('confirm_password').value;
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
document.getElementById('old_password').addEventListener("input", function(){
    document.getElementById('oldpasserror').innerHTML="";
});
document.getElementById('new_password').addEventListener("input", function(){
    document.getElementById('newpasserror').innerHTML="";
});
document.getElementById('update_password').addEventListener('click', validateSignup);