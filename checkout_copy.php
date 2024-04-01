<?php

function sanitize_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $street = sanitize_input($_POST["street"]);
    $city = sanitize_input($_POST["city"]);
    $state = sanitize_input($_POST["state"]);
    $phone = sanitize_input($_POST["phone"]);
    $email = sanitize_input($_POST["email"]);

    echo "<h2>Form Data:</h2>";
    echo "First Name: $first_name<br>";
    echo "Last Name: $last_name<br>";
    echo "Street: $street<br>";
    echo "City: $city<br>";
    echo "State: $state<br>";
    echo "Phone: $phone<br>";
    echo "Email: $email<br>";


    // $to = $email;
    // $subject = "Foodies Grocery Order";
    // $message = "This is a test";
    // $headers = "From: foodies@gmail.com";
    
    // if(mail($to, $subject, $message, $headers)) {
    //     echo "Email sent!";
    // } else {
    //     echo "Email send failed.";
    // }

}

?>

<!-- 
    Sanitise php form inputs before sending to database
 -->