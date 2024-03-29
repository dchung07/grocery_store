<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Grocery Store</title>
    <link rel="stylesheet" href="styles.css"/> 
    <script src="index.js" defer></script>
</head>
<body>

    <?php
        session_start();
            $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "grocery";

                $conn = new mysqli($servername, $username, $password, $dbname);

                $sql = "SELECT * FROM products";

                 //If select category option
                if (isset($_POST['categoryDropdown']) && !empty($_POST['categoryDropdown'])) {
                     $category = $_POST['categoryDropdown'];
                     //Set variable to the option value
                     $_SESSION['category'] = $category; 
                     $_SESSION['selected_category'] = $_POST['categoryDropdown'];
                     //Set session variable (category) to option value

                     //Should change the category option to $category
                    if($category == 'Category') {
                        $sql = "SELECT * FROM products";
                    } else {
                        $sql = "SELECT * FROM products WHERE category ='$category'";
                    }
                 } elseif(isset($_POST['searchSubmit']) && !empty($_POST['search'])) {
                     //If click on search, set variable to search value
                     //Set session variable (search) to search value
                     $search = $_POST['search'];
                     $_SESSION['search'] = $search; 
                     //Had to unset the session for category since it was messing with the
                     //Search session results as it had lower precedence in the conditional chain

                     unset($_SESSION['category']); 
                     //Perhaps we will get rid of the unset, so we can make both the category filter and search filter work together

                     $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";

                 } elseif(isset($_SESSION['category'])) {
                     //In the case of a form reset, the category previous selection will be
                     //Higher on prevalence.
                     $category = $_SESSION['category'];
                     if($category == 'Category') {
                        $sql = "SELECT * FROM products";
                    } else {
                        $sql = "SELECT * FROM products WHERE category ='$category'";
                    }
                 } elseif(isset($_SESSION['search'])) {
                    

                     $search = $_SESSION['search'];

                     $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
                 }

                 $selected_category = isset($_SESSION['selected_category']) ? $_SESSION['selected_category'] : '';

                    //Code for Add to Cart Functionality

                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }
                    
                    if (!isset($_SESSION['totalQuantity'])) {
                        $_SESSION['totalQuantity'] = 0;
                    }
                    
                    if (!isset($_SESSION['totalPrice'])) {
                        $_SESSION['totalPrice'] = 0.00;
                    }
                    
                    if (isset($_POST['add_to_cart'])) {
                        $product_id = $_POST['product_id'];
                        $product_name = $_POST['product_name'];
                        $quantity = $_POST['quantity'];
                        $unit_price = $_POST['unit_price'];
                        $unit_quantity = $_POST['unit_quantity'];
                    
                        $_SESSION['cart'][$product_id] = array(
                            "quantity" => $quantity,
                            "product_name" => $product_name,
                            "unit_price" => $unit_price,
                            "unit_quantity" => $unit_quantity
                        );
                    
                        $_SESSION['totalQuantity'] += $quantity;
                        $_SESSION['totalPrice'] += ($quantity * $unit_price);
                    }

                    if (isset($_POST['remove_all'])) {
                        $_SESSION['cart'] = array();
                        $_SESSION['totalQuantity'] = 0;
                        $_SESSION['totalPrice'] = 0.00;
                    }
                    


                    ?>


        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-content-header">
                    <h3>Your Cart</h3>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-content-content">
                    <h6><?php echo $_SESSION['totalQuantity'] . " item(s)" ?></h6>
                    <div class="modal-content-card-container-container">
                        <div class="modal-content-card-container">
                            <!-- <div class="modal-content-card">
                                <div class="modal-content-card-top">
                                    <div class="modal-logo-name">
                                        <img src="images/food-croissant.svg" alt="">
                                        <h6>Croissant</h6>
                                    </div>
                                    <h6>x</h6>
                                </div>
                                <div class="modal-content-card-bot">
                                    <div class="quantity-selector-container">
                                        <button>-</button>
                                        <input type="text" value="0">
                                        <button>+</button>
                                    </div>
                                    <h4>$3.61</h4>
                                </div>
                            </div> -->
                        </div>
                        <form class="remove-all-container" action = "index.php" method="POST">
                            <button type="submit" name="remove_all">Remove All<img src="images/delete_black_24dp.svg" alt="Delete Icon"></button>
                            
                        </form>
                    </div>
                </div>
        
                <div class="modal-content-footer">
                    <h5>Order Summary</h5>
                    <div class="checkout-info">
                        <h5>Price</h5>
                        <button>Place an order</button>
                    </div>
                </div>
        
            </div>
        </div>


    <div class="container">
        <div class="header">

            <div class="logo">
                <h3>Foodies</h3>
                <img src="images/food-croissant.svg" alt="logo">
            </div>

            <div class="header_middle">
                <form class="categoryForm" method="POST" onchange="submitForm()">
                    <select class="categoryDropdown" name="categoryDropdown" id="category">
                    <option value="Category" <?php if($selected_category == 'Category') echo 'selected'; ?>>Category</option>
                    <option value="Fruit" <?php if($selected_category == 'Fruit') echo 'selected'; ?>>Fruit</option>
                    <option value="Drinks" <?php if($selected_category == 'Drinks') echo 'selected'; ?>>Drinks</option>
                    <option value="Meat" <?php if($selected_category == 'Meat') echo 'selected'; ?>>Meat</option>
                    </select>
                </form>
    
                <form class="searchbar" action="index.php" method="POST">
                    <input type="search" placeholder = "Search Products..." name="search"/>
                    <button type="submit" name="searchSubmit" value="true" style="border: none; background: url('images/search_black_24dp.svg') no-repeat; width: 24px; height: 24px; cursor: pointer;"></button>
                </form>
            </div>
                
            <form class="shopping" action="index.php" method="POST">
                <div class="cart_update_top">
                    <img class="shoppingCartIcon" src="images/cart.svg" alt="shopping cart">
                    <h4><?php echo $_SESSION['totalQuantity']; ?></h4>
                </div>
                <h3><?php echo "$" . $_SESSION['totalPrice']; ?></h3>
            </form>

        </div>

        <div class="content">   
            <div class="card-container">

                <!-- <div class="card">
                    <img src="images/food-croissant.svg" alt="">
                    <h4>$3.61/1kg</h4>
                    <h5>Croissant</h5>
                    <button>Add to Cart</button>
                </div> -->

                <div class="card-container">
                    <?php
                    
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<div class="content">';
                                echo '<div class="card-container">';
                                echo '<div class="card">';
                                // echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">';
                                echo '<img src="images/food-croissant.svg" alt="">';
                                echo '<form class="card_submit_form" action="index.php" method="post">';
                                echo '<h4>' . $row['unit_price'] . '/' . $row['unit_quantity'] . '</h4>';
                                echo '<h5>' . $row['product_name'] . '</h5>';
                                echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
                                echo '<input type="hidden" name="product_name" value="' . $row['product_name'] . '">';
                                echo '<input type="hidden" name="unit_price" value="' . $row['unit_price'] . '">';
                                echo '<input type="hidden" name="unit_quantity" value="' . $row['unit_quantity'] . '">';
                                
                                
                                    if($row['in_stock'] == 0) {
                                        echo 'Quantity: <input type="number" name="quantity" disabled><br>';
                                        echo '<button class="outOfStockBtn" type="button" disabled>Out of Stock</button>';
                                    } else {
                                        echo 'Quantity: <input type="number" name="quantity" value="0" min="1"><br>';
                                        echo '<button class="addCartBtn" type="submit" name="add_to_cart">Add to Cart</button>';
                                    }

                                echo '</form>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo "0 results";
                        }
                        $conn->close();
                    ?> 

            </div>
        </div>
    </div>
    
</body>
</html>