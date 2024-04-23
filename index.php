<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Grocery Store</title>
    <link rel="stylesheet" href="styles.css" />
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

    function sanitize($input)
    {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    $currentNavigation = 'Home';

    if (isset($_POST['allButton'])) {
        unset($_SESSION['search']);
        $_SESSION['category'] = 'all';
        $sql = "SELECT *FROM products";
    }

    if (isset($_POST['fruitCategoryDropdown'])) {
        unset($_SESSION['search']);
        $category = $_POST['fruitCategoryDropdown'];
        $_SESSION['category'] = $category;


        if ($category == 'Fruit') {

            $sql = "SELECT * FROM products WHERE category = 'Fruit'";
        } else {

            $sql = "SELECT * FROM products WHERE sub_category ='$category'";
        }
    }

    if (isset($_POST['meatCategoryDropdown'])) {
        unset($_SESSION['search']);
        $category = $_POST['meatCategoryDropdown'];
        $_SESSION['category'] = $category;


        if ($category == 'Meat') {

            $sql = "SELECT * FROM products WHERE category = 'Meat'";
        } else {

            $sql = "SELECT * FROM products WHERE sub_category ='$category'";
        }
    }

    if (isset($_POST['drinkCategoryDropdown'])) {
        unset($_SESSION['search']);
        $category = $_POST['drinkCategoryDropdown'];
        $_SESSION['category'] = $category;


        if ($category == 'Drinks') {

            $sql = "SELECT * FROM products WHERE category = 'Drinks'";
        } else {
            $sql = "SELECT * FROM products WHERE sub_category ='$category'";
        }
    }

    if (isset($_POST['searchSubmit'])) {

        $search = sanitize($_POST['search']);

        $_SESSION['search'] = $search;

        unset($_SESSION['category']);

        $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
    }

    if (isset($_SESSION['category'])) {

        $category = $_SESSION['category'];
        if ($category == 'Fruit') {
            $sql = "SELECT * FROM products WHERE category = 'Fruit'";
        } elseif ($category == 'Drinks') {
            $sql = "SELECT * FROM products WHERE category = 'Drinks'";
        } elseif ($category == 'Meat') {
            $sql = "SELECT * FROM products WHERE category = 'Meat'";
        } elseif ($category == 'all') {
            $sql = "SELECT * FROM products";
        } else {
            $sql = "SELECT * FROM products WHERE sub_category ='$category'";
        }
    }

    if (isset($_SESSION['search'])) {


        $search = $_SESSION['search'];

        $sql = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
    }



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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $unit_price = $_POST['unit_price'];
        $unit_quantity = $_POST['unit_quantity'];
        $in_stock = $_POST['in_stock'];

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        } else {
            $_SESSION['cart'][$product_id] = array(
                "quantity" => $quantity,
                "product_name" => $product_name,
                "unit_price" => $unit_price,
                "unit_quantity" => $unit_quantity,
                "in_stock" => $in_stock
            );
        }

        $_SESSION['totalQuantity'] = 0;
        $_SESSION['totalPrice'] = 0;

        foreach ($_SESSION['cart'] as $product_id => $content) {
            $_SESSION['totalQuantity'] += $content['quantity'];
            $_SESSION['totalPrice'] += ($content['quantity'] * $content['unit_price']);
        }

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_all'])) {
        $_SESSION['cart'] = array();
        $_SESSION['totalQuantity'] = 0;
        $_SESSION['totalPrice'] = 0.00;
    }

    if (isset($_POST['deleteItem'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $unit_price = $_POST['unit_price'];

        $quantity = $_SESSION['cart'][$product_id]['quantity'];
        $unit_price = $_SESSION['cart'][$product_id]['unit_price'];

        $_SESSION['totalQuantity'] -= $_SESSION['cart'][$product_id]['quantity'];
        $_SESSION['totalPrice'] -= ($quantity * $unit_price);

        unset($_SESSION['cart'][$product_id]);

        header("Location: " . $_SERVER['REQUEST_URI']);
        exit();
    }


    if (isset($_POST['change_quantity'])) {
        $product_id = $_POST['product_id'];
        $unit_price = $_POST['unit_price'];
        $new_quantity = $_POST['new_quantity'];

        $unit_price = $_SESSION['cart'][$product_id]['unit_price'];
        $original_quantity = $_SESSION['cart'][$product_id]['quantity'];
        $difference_quantity = $original_quantity - $new_quantity;

        $_SESSION['totalQuantity'] -= $difference_quantity;

        $difference_price = $difference_quantity * $unit_price;

        $_SESSION['totalPrice'] -= $difference_price;

        $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
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

                        <?php
                        foreach ($_SESSION['cart'] as $product_id => $content) {
                            echo '<div class="modal-content-card">';
                            echo '<div class="modal-content-card-top">';
                            echo '<div class="modal-logo-name">';

                            $imagePath = "food_images/" . $product_id . ".jpg";
                            if (file_exists($imagePath)) {
                                echo '<img src="' . $imagePath . '" alt="">';
                            } else {
                                echo '<img src="" alt="">';
                            }

                            echo '<h6>' . $content['product_name'] . '</h6>';
                            echo '</div>';

                            echo '<form action="index.php" method="POST">';
                            echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                            echo '<input type="hidden" name="unit_price" value="' . $content['unit_price'] . '">';
                            echo '<input type="hidden" name="quantity" value="' . $content['quantity'] . '">';
                            echo '<input type="submit" name="deleteItem" class="deleteItem" value="">';
                            echo '</form>';

                            echo '</div>';

                            echo '<div class="modal-content-card-bot">';


                            echo '<form id="cartForm" action="index.php" method="POST">';
                            echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                            echo '<input type="hidden" name="unit_price" value="' . $content['unit_price'] . '">';

                            echo '<div class="quantity-selector-container">';


                            echo '<input type="number" name="new_quantity" value="' . $content['quantity'] . '" min="1" max="' . $content['in_stock'] . '"><br>';
                            echo '<button class="changeQuantityBtn" type="submit" name="change_quantity">Change Quantity</button>';


                            echo '</div>';

                            echo '</form>';

                            echo '<h4>' . '$' . $content['unit_price'] . ' Each' . '</h4>';
                            echo '</div>';
                            echo '</div>';
                        };
                        ?>

                    </div>
                    <form class="remove-all-container" action="index.php" method="POST">
                        <?php

                        if ($_SESSION['cart'] === array()) {
                            echo '<button type="submit" name="remove_all" disabled>Remove All<img src="images/delete_black_24dp.svg" alt="Delete Icon"></button>';
                        } else {
                            echo '<button type="submit" class="remove_all_enabled" name="remove_all">Remove All<img src="images/delete_black_24dp.svg" alt="Delete Icon"></button>';
                        }

                        ?>
                    </form>
                </div>
            </div>

            <div class="modal-content-footer">
                <h5>Order Summary</h5>
                <div class="checkout-info">
                    <h5><?php echo 'Total Price: $' . $_SESSION['totalPrice']; ?></h5>

                    <?php
                    if (empty($_SESSION['cart'])) {
                        echo "<button type='button' disabled>Nothing to order</button>";
                    } else {
                        echo '<form action="checkout.php" method="POST">';

                        echo '<input type="hidden" name="action" value="place_order">';
                        echo "<button type='submit'>Place an order</button>";
                        echo '</form>';
                    }
                    ?>

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

                <form class="searchbar" action="index.php" method="POST">
                    <input type="search" placeholder="Search Products..." name="search" />
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

        <div class="category-bar">

            <form class="categoryForm" method="POST" onclick="submitAllForm()" id="allCategory">
                <input class="categoryDropdown" type="submit" name="allButton" value="All Items" />
            </form>

            <form class="categoryForm" method="POST" onchange="submitFruitForm()" id="fruitCategory">
                <select class="categoryDropdown" name="fruitCategoryDropdown">
                    <option value="Fruit" selected>Fruit</option>
                    <option value="Fruit">Fruit</option>
                    <option value="Grape">Grape</option>
                    <option value="Apple">Apple</option>
                    <option value="Pear">Pear</option>
                </select>
            </form>

            <form class="categoryForm" method="POST" onchange="submitMeatForm()" id="meatCategory">
                <select class="categoryDropdown" name="meatCategoryDropdown">
                    <option value="Meat" selected>Meat</option>
                    <option value="Meat">Meat</option>
                    <option value="Beef">Beef</option>
                    <option value="Pork">Pork</option>
                    <option value="Lamb">Lamb</option>
                </select>
            </form>

            <form class="categoryForm" method="POST" onchange="submitDrinkForm()" id="drinkCategory">
                <select class="categoryDropdown" name="drinkCategoryDropdown">
                    <option value="Drinks" selected>Drinks</option>
                    <option value="Drinks">Drinks</option>
                    <option value="Juices">Juices</option>
                    <option value="Sodas">Sodas</option>
                    <option value="Teas">Teas</option>
                    <option value="Water">Water</option>
                    <option value="Energy">Energy</option>
                </select>
            </form>
        </div>


        <div class="content">

            <div class="card-container">
                <?php

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="content">';
                        echo '<div class="card-container">';
                        echo '<div class="card">';

                        $imagePath = "food_images/" . $row['product_id'] . ".jpg";
                        if (file_exists($imagePath)) {
                            echo '<img src="' . $imagePath . '" alt="">';
                        } else {
                            echo '<img src="" alt="">';
                        }

                        echo '<form class="card_submit_form" action="index.php" method="post">';
                        echo '<h4>' . '$' . $row['unit_price'] . '/' . $row['unit_quantity'] . '</h4>';
                        echo '<h5>' . $row['product_name'] . '</h5>';
                        echo '<input type="hidden" name="product_id" value="' . $row['product_id'] . '">';
                        echo '<input type="hidden" name="product_name" value="' . $row['product_name'] . '">';
                        echo '<input type="hidden" name="unit_price" value="' . $row['unit_price'] . '">';
                        echo '<input type="hidden" name="unit_quantity" value="' . $row['unit_quantity'] . '">';
                        echo '<input type="hidden" name="in_stock" value="' . $row['in_stock'] . '">';


                        if ($row['in_stock'] == 0) {
                            echo 'Quantity: <input type="number" name="quantity" disabled><br>';
                            echo '<button class="outOfStockBtn" type="button" disabled>Out of Stock</button>';
                        } else {
                            echo 'Quantity: <input type="number" name="quantity" value="0" min="1" max="' . $row['in_stock'] . '"><br>';
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

</body>

</html>