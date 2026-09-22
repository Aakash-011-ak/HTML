<?php
    include "db_connect.php";

    $customer_name = $_POST['customer_name'] ?? '';
    $email         = $_POST['email'] ?? '';
    $item_name     = $_POST['item_name'] ?? '';
    $quantity      = $_POST['quantity'] ?? 0;
    $price         = $_POST['price'] ?? 0;

    $sql = "INSERT INTO trekking_orders (customer_name, email, item_name, quantity, price) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssid", $customer_name, $email, $item_name, $quantity, $price);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - Apex Trekking Store</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 480px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 15px;
            font-size: 24px;
        }
        .success {
            color: #27ae60;
        }
        .error {
            color: #c0392b;
        }
        p {
            color: #555;
            margin-bottom: 25px;
            font-size: 15px;
            line-height: 1.5;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            justify-content: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #2980b9;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.2s;
        }
        .btn:hover {
            background-color: #1f618d;
        }
        .btn-secondary {
            background-color: #27ae60;
        }
        .btn-secondary:hover {
            background-color: #219653;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if ($stmt->execute()) {
            echo "<h2 class='success'>Order Placed Successfully! 🎒</h2>";
            echo "<p>Thank you, <strong>" . htmlspecialchars($customer_name) . "</strong>. Your purchase for <strong>" . htmlspecialchars($item_name) . "</strong> has been saved securely to the database.</p>";
            echo "<div class='btn-group'>";
            echo "<a href='view_orders.php' class='btn btn-secondary'>View All Orders</a>";
            echo "<a href='index.html' class='btn'>Back to Store</a>";
            echo "</div>";
        } else {
            echo "<h2 class='error'>Oops! Order Failed</h2>";
            echo "<p>Error: " . htmlspecialchars($stmt->error) . "</p>";
            echo "<div class='btn-group'>";
            echo "<a href='index.html' class='btn'>Try Again</a>";
            echo "</div>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>