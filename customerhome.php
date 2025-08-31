<?php
// Start session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "store");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch categories
$categories = $conn->query("SELECT * FROM categories");

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: clogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            position: relative;
        }
        .logout-button {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: red;
            color: white;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }
        .cart-button {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: yellow;
            color: black;
            padding: 8px 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
        }
        .search-container {
            margin: 10px 0;
            text-align: center;
        }
        .search-container input {
            padding: 8px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-container button {
            padding: 8px 15px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .main-container {
            display: flex;
            max-width: 1000px;
            margin: auto;
            background: white;
            box-shadow: 0px 0px 10px gray;
        }
        .sidebar {
            width: 30%;
            background: #f8f9fa;
            padding: 20px;
            border-right: 2px solid #ddd;
        }
        .content {
            width: 70%;
            padding: 20px;
        }
        .category {
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            background: white;
        }
        .category img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        .medicine {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            background: #fafafa;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }
        .medicine img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        button {
            padding: 5px 10px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="customerhome.php?logout=true"><button class="logout-button"> Logout</button></a>
    Welcome to Madanayake Pharmacy
    <a href="cart.php"><button class="cart-button">🛒 Cart</button></a>
</div>

<!-- Search Bar -->
<div class="search-container">
    <input type="text" id="searchQuery" placeholder="Search for medicines...">
    <button onclick="searchMedicines()"> Search</button>
</div>

<div class="main-container">
    <!-- Sidebar for Categories -->
    <div class="sidebar">
        <h3>Categories</h3>
        <?php while ($row = $categories->fetch_assoc()) { ?>
            <div class="category" onclick="showMedicines(<?php echo $row['id']; ?>)">
                <img src="<?php echo $row['pic']; ?>" alt="Category Image">
                <span><?php echo $row['name']; ?></span>
            </div>
        <?php } ?>
    </div>

    <!-- Medicines Display -->
    <div class="content">
        <h3>Available Medicines</h3>
        <div id="medicine-list">
            <p>Select a category or search for medicines.</p>
        </div>
    </div>
</div>

<script>
    function showMedicines(categoryId) {
        let medicineList = document.getElementById("medicine-list");
        medicineList.innerHTML = "<p>Loading medicines...</p>";

        fetch("get_medicines.php?category_id=" + categoryId)
            .then(response => response.text())
            .then(data => {
                medicineList.innerHTML = data;
            });
    }

    function searchMedicines() {
        let query = document.getElementById("searchQuery").value;
        let medicineList = document.getElementById("medicine-list");

        if (query.trim() === "") {
            medicineList.innerHTML = "<p>Please enter a search term.</p>";
            return;
        }

        medicineList.innerHTML = "<p>Searching...</p>";

        fetch("search_medicines.php?query=" + query)
            .then(response => response.text())
            .then(data => {
                medicineList.innerHTML = data;
            });
    }
    function addToCart(id, name, price) {
        fetch("add_to_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${id}&name=${encodeURIComponent(name)}&price=${price}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Show success message
        });
    }
</script>

</body>
</html>
