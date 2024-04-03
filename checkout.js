const backToHome = document.querySelector('.left-side');

backToHome.addEventListener('click', function() {
    window.location.href = "index.php";
});

//Form Validation Client Side

//First-Last Name Input Box Validation
// const first_name = document.querySelector('.first_name');
// const last_name = document.querySelector('.last_name');
// const phone = document.querySelector('.phone');
// const email = document.querySelector('.email');
// const street = document.querySelector('.street');
// const city = document.querySelector('.city');
// const submit = document.getElementById('submit');


// const letterOnlyRegex = /^[A-Za-z]+$/;
// const integerOnlyRegex = /^[0-9]+$/;

// function lettersOnlyInput(input) {
//     input.addEventListener('input', function() {
//         if(!letterOnlyRegex.test(input.value)) {
//             input.style.borderColor = "red";
//         } else {
//             input.style.borderColor = "grey";
//         }
//     });
// }

// function integerOnlyInput(input) {
//     input.addEventListener('input', function() {
//         if(!integerOnlyRegex.test(input.value)) {
//             input.style.borderColor = "red";
//         } else {
//             input.style.borderColor = "grey";
//         }
//     });
// }

// lettersOnlyInput(first_name);
// lettersOnlyInput(last_name);
// integerOnlyInput(phone);


//For the submit  button
//Check if inputs are empty or filled, and disable/undisable submit button as necessary

function checkForm() {

    let firstName = document.querySelector('.first_name');
    let lastName = document.querySelector('.last_name');
    let email = document.querySelector('.email');
    let phone = document.querySelector('.phone');
    let street = document.querySelector('.street');
    let city = document.querySelector('.city');
    let submitBtn = document.getElementById('submit');

    if (firstName.value !== "" && lastName.value !== "" && email.value !== "" && phone.value !== "" && street.value !== "" && city.value !== "") {
        submitBtn.disabled = false; 
        document.getElementById('submit').classList.add('submit_hover')
    } else {
        submitBtn.disabled = true; 
        document.getElementById('submit').classList.remove('submit_hover');
    }
}

document.addEventListener("DOMContentLoaded", function() {
    let formInputs = document.querySelectorAll('.checkout-form input');
    formInputs.forEach(function(input) {
        input.addEventListener("change", checkForm);
    });
});

