
let categoryLabel = document.querySelector('.categoryLabel');
let cartIcon = document.querySelector('.shoppingCartIcon');
let modal = document.querySelector('.modal');
let close = document.querySelector('.close');
let container = document.querySelector('.container');
let shopping = document.querySelector('.shopping');

let categoryDropdown = document.querySelector('.categoryDropdown');

let backdrop;

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

//Category Selection


// document.addEventListener('DOMContentLoaded', function() {
//     var categoryDropdown = document.getElementById('category');

//     categoryDropdown.addEventListener('change', function() {
//         var selectedCategory = categoryDropdown.value;
//         window.location.href = 'index.php?categoryDropdown=' + encodeURIComponent(selectedCategory);
//     });
// });



function submitForm() {

    var form = document.querySelector('.categoryForm');
    form.submit();
}