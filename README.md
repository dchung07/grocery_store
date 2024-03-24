# grocery_store
A Grocery Store

    //Make dropdown Work //Resolved after just restarting xampp, and vscode
    //Add to Cart > Actually add to cart
    //Keep search results even if user adds to cart. Currently, when user adds to cart, the entire page refreshes
    //works with category but not with search
    //And search filters are reset
    //If customer tries to add more quantity than exists, send error, or max the quantity field to in_stock
    //2. I want to add functionality where both category and search filters can work at the same time.
    //3. Need to make so that the category name changes to the selected option value

    Things to work on

    -> When the modal opens, the rest of the screen should be blurred slightly. (Done) -> Create a backdrop div with slight opacity and then using z-index position it behind modal but above everything else
    -> Clicking elsewhere than the modal should close the modal. (Done if target of window is backdrop, close Modal and backdrop)
    -> Add Fruits (Done)
    -> Add All Category to display all the categories (Done) -> Added conditional statement so that if 'Category' is selected, it would display all
    Also removed the disabled from the dropdown category so it becomes a valid option.

    To-Do
    -> Look into the dropdown having sub-categories
    -> Add functionality to sub-categories
    Do this through a modal and js. Open up the sub-categories after putting display as none.
    Should loop through each of the different sub-categories, and attach each as an option

    -> If out of stock, don't let quantity to be moved up or down, and don't add the hover on click animation either (Done) -> Disabled hover over the out of stock items and disabled quantity input too.


