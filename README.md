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

    ->Send added items to the cart
    ->Add a text next to the cart icon so it can be updated when the add_to_cart is clicked
    ->Add count of items (quantity) & total cost of items 


    ->Use associative array in following structure

    $cart = array(
        "product_id_1" => array(
            "quantity" => 2,
            "unit_price" => 3.00,
            "product_name" => "bread",
            "unit_quantity" => "1L"
        ),
        "product_id_2" => array(
            "quantity" => 2,
            "unit_price" => 3.00,
            "product_name" => "bread",
            "unit_quantity" => "1L"
        ),
    );

    ->Session lifecycle (Adjust time and destroy unused sessions after x period of time)

    -> Make remove functionality. Also change the variables to include sessions

    -> When appending the items to the cart modal, loop through the product_id's in the session cart array, and append items accordinly using the html template that is created

    -> Error when refreshing the page, another instance of the items is automatically added to the cart.

    -> Work on sending data to the next page

    -> Disable place order button if the cart is empty. Check if cart session is empty. If empty disable, else able to be clicked

    -> To-Do on main page
    -> Allow quantity change of items
    -> Allow removal of items

    -> Removal of Item
    -> Put the x button in the form
    -> Send through product_id.
    -> $_POST[''] -> $_SESSION['cart']['product_id]

    -> there is an error, 

    -> Figure out quantity selector
    Quantity Selector is weird case because submitting a form each time the indicator moves up or down would be too annoying, especially refreshing the page each time

    -> For convenience when removing an item from the cart, instantly create the modal

    -> Send session to the checkout page.

    -> only allow quantity max to be up to the in_stock value of the item

    -> Finish Aesthetic Layout of cart information in the checkout page.

    -> Style the checkout page. 
    -> Make submit button interactive (hover)

    -> Make font Better

    -> Add images to file and adjust sql database schema to include image field

    -> Style the remove btn (individual cart) + Quantity Increase/Decrease Buttons

    -> Design Choice
    -> Increment/Decrement sql immediately as it is put in cart? or leave it to the checkout page?

    Option 1 -> Increment/decrement immediately as added in cart
    -> Send sql query. 
    -> Would prevent others from selecting and further conflicts such as stock running out while on checkout page (more annoying for user)
    -> if remove item -> send sql query
    -> if remove all -> send sql query
    -> on checkout, there would be no sql query sent

    Option 2 -> sql query at checkout
    -> May have conflicts if other user purchases while an user is on checkout (can be frustrating)
    -> No sql query until checkout is made
    -> Less sql queries, less intensive but... not as good?

    
    Also add images for each food item.
    Check if image file exists, then if it exists, use that as the src, else, use generic croissant.
    or maybe a generic placeholder image.
    Use product_id's as the image path

    -> quantity Increase/Decrease
    -> if each time, the form is resubmitted
    -> Just change it to a normal quantity form
    -> Have the quantity changing above, and then a button below to submit the quantity change

    -> when delete individual item, re-open modal immediately?

    -> refactor the code to take into account $in_stock variable. Might have messed up not taking this into account earlier...