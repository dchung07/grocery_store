
let categoryLabel = document.querySelector('.categoryLabel');
let cartIcon = document.querySelector('.shoppingCartIcon');
let modal = document.querySelector('.modal');
let close = document.querySelector('.close');
let container = document.querySelector('.container');
let shopping = document.querySelector('.shopping');

let categoryDropdown = document.querySelector('.categoryDropdown');

let backdrop;

function resetPage() {
    let logoForm = document.getElementById('logoReset');
    logoForm.submit();
}

//Category 

shopping.addEventListener('click', function() {
    modal.style.display = "block";

    backdrop = document.createElement("div");
    backdrop.classList.add("backdrop");
    document.body.appendChild(backdrop);

    document.body.style.overflow = "hidden";
});

close.addEventListener('click', function() {
    modal.style.display = "none";
    backdrop.style.display = "none";
    document.body.style.overflow = "auto";
});

window.addEventListener('click', function(event) {
    if (event.target == backdrop) {
        modal.style.display = "none";
        backdrop.style.display = "none";
        document.body.style.overflow = "auto";
    }
});



function submitForm() {

    let form = document.getElementById('category');
    form.submit();
}

function submitAllForm() {
    let allForm = document.getElementById('allCategory');
    allForm.submit();
}

function submitFruitForm() {
    let fruitForm = document.getElementById('fruitCategory');
    fruitForm.submit();
}

function submitMeatForm() {
    let meatForm = document.getElementById('meatCategory');
    meatForm.submit();
}

function submitDrinkForm() {
    let drinkForm = document.getElementById('drinkCategory');
    drinkForm.submit();
}

//AJAX cart quantity change /

