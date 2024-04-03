<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="checkout_styles.css">
    <script src="checkout.js" defer></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="left-side">
                <img src="images/chevron_left_black_24dp.svg" alt="Left Arrow">
                <h3>Continue Shopping</h3>
            </div>
            <div class="logo-container">
                <div class="logo">
                    <h3>Foodies</h3>
                    <img src="images/food-croissant.svg" alt="logo">
                </div>
            </div>
        </div>
        <div class="content">
            <form class="checkout-form" action="checkout.php" method="POST">
                <div class="name-container">
                    <div class="sub-form">
                        <label for="first_name">First Name:</label>
                        <input class="first_name" type="text" name="first_name" maxlength = "25" required placeholder="Tom...">
                    </div>
                    <div class="sub-form">
                        <label for="last_name">Last Name:</label>
                        <input class="last_name" type="text" name="last_name" maxlength = "25" required placeholder="Smith...">
                    </div>
                </div>
                
                <div class="address-top-container">
                    <div class="sub-form">
                        <label for="street">Street:</label>
                        <input class="street" type="text" name="street" required placeholder="...">
                    </div>
                </div>

                <div class="address-bot-container">
                    <div class="sub-form">
                        <label for="city">City/Suburb:</label>
                        <input class="city" type="text" name="city" required placeholder="...">
                    </div>
                    <div class="sub-form">
                    <label for="states">State:</label>
                        <select required name="state">
                            <option value="VIC">VIC</option>
                            <option value="ACT">ACT</option>
                            <option value="NSW">NSW</option>
                            <option value="NT ">NT</option>
                            <option value="QLD">QLD</option>
                            <option value="SA ">SA</option>
                            <option value="TAS">TAS</option>
                            <option value="WA ">WA</option>
                        </select>
                    </div>
                </div>

                <div class="phone-email-container">
                    <div class="sub-form">
                        <label for="phone">Phone Number:</label>
                        <input class="phone" type="tel" name="phone" required placeholder="0401112342">
                    </div>
                    <div class="sub-form">
                        <label for="email">Email:</label>
                        <input class="email" type="email" name="email" required placeholder="tomsmith@gmail.com">
                    </div>
                </div>

                <input id="submit" type="submit" name="submit" value="Confirm Order" disabled>

            </form>

            <?php
                session_start();

                // on click of the submit btn, we wil check once more, that the contents of the cart exists. We will get its quantity, and send
                // an sql query where we subtract the quantity from the in_Stock field of each product_id. 
                // After the sql query is executed, an email will be sent (fake email) 
                // & then the cart session will be emptied. The session variables for the total price, and quantity will also be emptied. 
                // Perhaps have a popup modal where the email details confirmation of the order are sent
                // The email details confirmation would include all the product_names, quantity, and the total price of the transaction. Also date the transaction was made.
                // Perhaps even have some details such as "Hello {name}, your order {order_details} have been delivered to {address}.


                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "place_order") {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "grocery";
    
                    $conn = new mysqli($servername, $username, $password, $dbname);
    
                    $sql = "SELECT * FROM products";
    
                    $result = $conn->query($sql);
                    $cart = $_SESSION['cart'];


                    //Check if cart is not empty (See if users cart is actually filled for some reason e.g. user loaded checkout page directly bypassing index)
                    if(!empty($cart) && is_array($cart)) {
                        foreach($cart as $product_id => $item) {
                            //Will loop through each item in the cart.
                            $quantity = $item['quantity'];
    
                            $update_sql = "UPDATE products SET in_stock = in_stock - $quantity WHERE product_id = $product_id";
                            $conn->query($update_sql);

                        }
                    }
                    $conn->close(); 

                    $_SESSION['cart'] = array();
                    $_SESSION['totalQuantity'] = 0;
                    $_SESSION['totalPrice'] = 0.00;

                    // header("Location: ".$_SERVER['REQUEST_URI']);
                    // exit();

                }



                // $cart = unserialize($_POST['cart']);
                // if (!empty($cart) && is_array($cart)) {
                //     echo "<h2 class='cart-content'>Cart Contents:</h2>";
                //     echo "<ul class='checkout-ul'>";
                //     foreach ($cart as $product_id => $item) {
                //         echo "<li>{$item['product_name']} - Quantity: {$item['quantity']}, Unit Price: {$item['unit_price']}, Unit Quantity: {$item['unit_quantity']}</li>";
                //     }
                //     echo "</ul>";
                // } else {
                //     echo "<p>Cart is empty or invalid.</p>";
                // }

                
            ?>

        </div>
    </div>
</body>
</html>