const backToHome = document.querySelector('.left-side');

backToHome.addEventListener('click', function() {
    window.location.href = "index.php";
});

//Form Validation Client Side

//First-Last Name Input Box Validation
const first_name = document.querySelector('.first_name');
const last_name = document.querySelector('.last_name');
const phone = document.querySelector('.phone');

const letterOnlyRegex = /^[A-Za-z]+$/;
const integerOnlyRegex = /^[0-9]+$/;
// if(letterOnlyRegex.test(first_name.value)) {
//     first_name.style.borderColor = "green";
// }

// first_name.addEventListener('input', function() {
//     if(!letterOnlyRegex.test(first_name.value)) {
//         first_name.style.borderColor = "red";
//     } else {
//         first_name.style.borderColor = "grey";
//     }
// });

function lettersOnlyInput(input) {
    input.addEventListener('input', function() {
        if(!letterOnlyRegex.test(input.value)) {
            input.style.borderColor = "red";
        } else {
            input.style.borderColor = "grey";
        }
    });
}

function integerOnlyInput(input) {
    input.addEventListener('input', function() {
        if(!integerOnlyRegex.test(input.value)) {
            input.style.borderColor = "red";
        } else {
            input.style.borderColor = "grey";
        }
    });
}

lettersOnlyInput(first_name);
lettersOnlyInput(last_name);
integerOnlyInput(phone);