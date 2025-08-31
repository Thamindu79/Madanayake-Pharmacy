<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = isset($_GET['query']) ? $_GET['query'] : "";

if ($query != "") {
    $stmt = $conn->prepare("SELECT * FROM inventeries WHERE name LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="medicine">
                    <img src="' . $row["pic"] . '" alt="Medicine Image">
                    <span>' . $row["name"] . ' - $' . $row["price"] . '</span>
                    <button onclick="addToCart(' . $row["price"] . ')">Add to Cart</button>
                </div>';
        }
    } else {
        echo "<p>No medicines found.</p>";
    }
}
?>
