<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; }
        .navbar { background-color: #007bff; color: white; padding: 15px; text-align: center; font-size: 22px; font-weight: bold; }
        .container { max-width: 800px; margin: auto; background: white; padding: 20px; box-shadow: 0px 0px 10px gray; }
        .cart-item { display: flex; justify-content: space-between; padding: 10px; background: #fafafa; border: 1px solid #ddd; margin-bottom: 10px; }
        .remove-btn { padding: 5px 10px; background: red; color: white; border: none; cursor: pointer; }
        .back-btn { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; font-size: 16px; border-radius: 5px; text-align: center; display: inline-block; }
        .place-order-btn { padding: 10px 20px; background-color: #25D366; color: white; border: none; cursor: pointer; font-size: 16px; border-radius: 5px; text-align: center; display: inline-block; margin-top: 20px; }
    </style>
</head>
<body>

<div class="navbar">Your Cart</div>

<div class="container">
    <h2>Cart Items</h2>
    <div id="cart-items">
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total = 0;
            foreach ($_SESSION['cart'] as $index => $item) {
                echo "<div class='cart-item'>
                        <span>{$item['name']}</span>
                        <span>\${$item['price']}</span>
                        <button class='remove-btn' onclick='removeFromCart({$index})'>Remove</button>
                      </div>";
                $total += $item['price'];
            }
            echo "<h3>Total: \$$total</h3>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>

    <!-- Back Button -->
    <a href="customerhome.php"><button class="back-btn">Back to Home</button></a>

    <!-- Place Order Button -->
    <?php
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $token = rand(1000, 9999); // Generate a simple random token for the order

        // Prepare order details
        $order_details = "Order Token: $token\n\n";
        foreach ($_SESSION['cart'] as $item) {
            $order_details .= "Medicine: {$item['name']} - \${$item['price']}\n";
        }
        $order_details .= "\nTotal Amount: \$$total\n";
        $order_details .= "\nIf you have a prescription, please submit it here.";

        // URL encode the order details for WhatsApp
        $order_details_encoded = urlencode($order_details);
        $whatsapp_number = '+94740680747'; // The pharmacy WhatsApp number
        $whatsapp_url = "https://wa.me/$whatsapp_number?text=$order_details_encoded";
        ?>
        <a href="<?php echo $whatsapp_url; ?>" target="_blank">
            <button class="place-order-btn">Place Order via WhatsApp</button>
        </a>
    <?php } ?>
</div>

<script>
    function removeFromCart(index) {
        fetch("remove_from_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `index=${index}`
        })
        .then(response => response.text())
        .then(data => {
            location.reload(); // Reload the page to update the cart
        });
    }
</script>

</body>
</html>
