const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('password2');
const firstname = document.getElementById('firstname');
const lastname = document.getElementById('lastname');
const middlename = document.getElementById('middlename');
const position = document.getElementById('position');
const form = document.getElementById('form')

form.addEventListener('submit', e =>{
    e.preventDefault()
    validateInputs()
})

const setError = element =>{
    const inputControl = element.parentElement
    const errorDisplay = inputControl.querySelector('.error')

    errorDisplay.innerText = ''
    inputControl.classList.add('error')
    inputControl.classList.remove('success')
}

const setSuccess = (element, message) =>{
    const inputControl = element.parentElement
    const errorDisplay = inputControl.querySelector('.error')

    errorDisplay.innerText = message
    inputControl.classList.add('success')
    inputControl.classList.remove('error')
}


function validateInputs() {
    const emailValue = email.value.trim()
    const passwordValue = password.value.trim()
    const password2Value = password2.value.trim()
    const firstnameValue = firstname.value.trim()
    const lastnameValue = lastname.value.trim()
    const middlenameValue = middlename.value.trim()
    const positionValue = position.value.trim()

    const sqlCheck = /(['"();])/;
    //email validation
    const emailRegex = /^[^\s@]+@dhvsu\.edu\.ph$/
    if(emailValue ==""){
        setError(email, 'Email is required')
    }
    else if (!emailRegex.test(String(emailValue).toLowerCase()) && sqlCheck.test(String(emailValue).toLowerCase())) {
        setError(email,'Invalid Email')
    }
    else{
        setSuccess(email)
    }
    
    //password validation
    if(passwordValue == ""){
        setError(password, 'Password is required')
    }
    else if (passwordValue.length < 8 && passwordValue.length > 33 && sqlCheck.test(passwordValue)) {
        setError(password,'Password must be 8 - 32 characters long');
    }
    else{
        setSuccess(password)
    }
    //confirm password
    if(password2Value == ""){
        setError(password2, 'Confirm Password is required')
    }
    else if(password2Value !== passwordValue){
        setError(password2,"Password do not match");
    }
    else{
        setSuccess(password2);
    }

    const nameRegex = /^[a-zA-Z]+$/;
    if(firstnameValue == ""){
        setError(firstname, 'First Name is required')
    }
    else if(!nameRegex.test(firstnameValue) && sqlCheck.test(firstnameValue)){
        setError(firstname, "First Name should only contain letters.")
    }
    else{
        setSuccess(firstname)
    }

    if(lastnameValue == ""){
        setError(lastname, 'Last Name is required')
    }
    if(!nameRegex.test(lastnameValue) && sqlCheck.test(lastnameValue)){
        setError(lastname, "Last Name should only contain letters.")
    }
    else{
        setSuccess(lastname)
    }

    if(!nameRegex.test(middlenameValue) && sqlCheck.test(middlenameValue)){
        setError(middlename, "Middle Name should only contain letters.")
    }
    else{
        setSuccess(middlename)
    }

    if (positionValue  === "") {
        setError(position,'Please select a position')
    }
    else{
        setSuccess(position)
    }
}

