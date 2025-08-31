<?php
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$category_id = $_GET['category_id'];
$medicines = $conn->query("SELECT * FROM inventeries WHERE catId = $category_id");

while ($row = $medicines->fetch_assoc()) {
    echo "<div class='medicine'>
            <img src='{$row['pic']}' alt='Medicine Image'>
            <span>{$row['name']} - {$row['unit']} - $ {$row['price']}</span>
            <button onclick='addToCart({$row['price']})'>Add to Cart</button>
          </div>";
}
?>
