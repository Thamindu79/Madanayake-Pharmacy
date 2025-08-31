<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "store");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]); // Ensure ID is an integer

    // Ensure the session cart exists
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    // Fetch medicine details from the inventories table
    $stmt = $conn->prepare("SELECT id, name, price, pic, description FROM inventeries WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $medicine = $result->fetch_assoc();

        // Add the medicine to the cart session
        $_SESSION["cart"][] = [
            "id" => $medicine["id"],
            "name" => $medicine["name"],
            "price" => floatval($medicine["price"]), // Ensure price is numeric
            "pic" => $medicine["pic"],
            "description" => $medicine["description"]
        ];

        echo "Item added to cart!";
    } else {
        echo "Medicine not found!";
    }

    $stmt->close();
}

$conn->close();
?>
