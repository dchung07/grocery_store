
let categoryLabel = document.querySelector('.categoryLabel');
let cartIcon = document.querySelector('.shoppingCartIcon');
let modal = document.querySelector('.modal');
let close = document.querySelector('.close');
let container = document.querySelector('.container');
let shopping = document.querySelector('.shopping');

let categoryDropdown = document.querySelector('.categoryDropdown');

//Category 

shopping.addEventListener('click', function() {
    modal.style.display = "block";
    document.body.style.overflow = "hidden";
});

close.addEventListener('click', function() {
    modal.style.display = "none";
    document.body.style.overflow = "auto";
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