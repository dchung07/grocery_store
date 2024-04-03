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

<?php
                session_start();

                $_SESSION['confirmation_details'] = array();
                $_SESSION['user_details'] = array();
                $_SESSION['form_submitted'] = false;

                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
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

                    if(isset($_SESSION['confirmation_details']) && isset($_SESSION['user_details'])) {
                        unset($_SESSION['confirmation_details']);
                        unset($_SESSION['user_details']);
                    } else {
                        $_SESSION['confirmation_details'] = array();
                        $_SESSION['user_details'] = array();
                    }

                    if(isset($_POST['first_name'])) {
                        $first_name = $_POST['first_name'];
                    }
                    if(isset($_POST['last_name'])) {
                        $last_name = $_POST['last_name'];
                    }
                    if(isset($_POST['street'])) {
                        $street = $_POST['street'];
                    }
                    if(isset($_POST['city'])) {
                        $city = $_POST['city'];
                    }
                    if(isset($_POST['state'])) {
                        $state = $_POST['state'];
                    }
                    if(isset($_POST['phone'])) {
                        $phone = $_POST['phone'];
                    }
                    if(isset($_POST['email'])) {
                        $email = $_POST['email'];
                    }

                    $_SESSION['user_details'] = array(
                        "first_name" => $first_name,
                        "last_name" => $last_name,
                        "street" => $street,
                        "city" => $city,
                        "state" => $state,
                        "phone" => $phone,
                        "email" => $email
                    );

                    $_SESSION['confirmation_details'] = $cart;
                    
                    $_SESSION['form_submitted'] = true; 
                    // $_SESSION['cart'] = array();
                    // $_SESSION['totalQuantity'] = 0;
                    // $_SESSION['totalPrice'] = 0.00;

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

            <?php

            if($_SESSION['form_submitted'] === true) {

                //If form is submitted.

                $cart = $_SESSION['cart'];
                if (!empty($cart) && is_array($cart)) {

                    $left_arrow_image_src = "images/chevron_left_black_24dp.svg";
                    $logo_image_src = "images/food-croissant.svg";
                    
                    echo '<div class="order_details">';

                        echo '<div class="header">';
                            echo '<div class="left-side">';
                                echo '<img src="' . $left_arrow_image_src . '" alt="Left Arrow">';
                                echo '<h3>Continue Shopping</h3>';
                            echo '</div>';
                            echo '<div class="logo-container">';
                                echo '<div class="logo">';
                                    echo '<h3>Foodies</h3>';
                                    echo '<img src="' . $logo_image_src . '" alt="logo">';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';

                        echo '<div class="order_content">';

                            echo "<h2 class='cart-content'>Cart Contents:</h2>";
                            echo "<ul class='checkout-ul'>";
                            foreach ($cart as $product_id => $item) {
                                echo "<li>{$item['product_name']} - Quantity: {$item['quantity']}, Unit Price: {$item['unit_price']}, Unit Quantity: {$item['unit_quantity']}</li>";
                            }
                            echo "</ul>";
                            echo "<h2>Total Price: $" . $_SESSION['totalPrice'] . "</h2>";
                            echo "<h3>Order details have been emailed to " . $email . "</h3>";
                            echo "<h3>Thank you " . $first_name . " " . $last_name. "</h3>";
                            echo "<h3>Order is being sent to address: " . $street . ", " . $city . ", " . $state . "</h3>";
                        
                        echo '</div>';

                    echo '</div>';

                }

                $_SESSION['cart'] = array();
                $_SESSION['totalQuantity'] = 0;
                $_SESSION['totalPrice'] = 0.00;
                $_SESSION['form_submitted'] = false;

            } else {

            }

            ?>

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

        </div>
    </div>
</body>
</html>