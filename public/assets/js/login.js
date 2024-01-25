function openModal(message) {
    const modal = document.getElementById('successModal');
    const successMessage = document.getElementById('successMessage');

    successMessage.innerHTML = message;
    modal.style.display = 'block';
}
function closeModal() {
    const modal = document.getElementById('successModal');
    modal.style.display = 'none';
}
function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
 }

function validateForm(event) {
    const email = document.getElementById('emailLogin').value;
    const password = document.getElementById('passwordLogin').value;
    const errorMessage = document.getElementById('errorMessageLogin');
    const emailError = document.getElementById('emailErrorLogin');
    const passwordError = document.getElementById('passwordErrorLogin');

    errorMessage.innerHTML = '';
    emailError.innerHTML = '';
    passwordError.innerHTML = '';

    isValid= true;
    // Password validation
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    if (email.trim() === '' && password.trim() === '') {
        isValid=false;
        errorMessage.innerHTML = '*Please fill out the form fields*';
        event.preventDefault();
    }else{
        if (email.trim() === '') {
            isValid=false;
            emailError.innerHTML = '*Email is required*';
            event.preventDefault();
        }if (!isValidEmail(email.trim())) {
            isValid=false;
            emailError.innerHTML = '*Enter a valid email*';
            event.preventDefault();
        }if (password.trim() === '') {
            isValid=false;
            passwordError.innerHTML = '*Password is required*';
            event.preventDefault();
        }if (!passwordRegex.test(password)) {
            isValid=false;
            passwordError.innerHTML = '*Password must be at least 8 characters, contain at least one capital letter, and have at least one special character*';
            event.preventDefault();
        }if(isValid){
             // If both fields are filled and password is valid
            // success message in the modal
            openModal('Login Successful!');
        }
     
    }
}
document.getElementById('emailLogin').addEventListener('input', function(){
    errorMessage = document.getElementById('errorMessageLogin').innerHTML="";
    emailError = document.getElementById('emailErrorLogin').innerHTML="";
});
document.getElementById('passwordLogin').addEventListener('input', function(){
    document.getElementById('passwordErrorLogin').innerHTML="";
    errorMessage = document.getElementById('errorMessageLogin').innerHTML="";
});
document.getElementById('loginButton').addEventListener('click', validateForm);
