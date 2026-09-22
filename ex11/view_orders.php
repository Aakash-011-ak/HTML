<?php
    include "db_connect.php";

    $sql = "SELECT * FROM trekking_orders ORDER BY order_date DESC";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Orders - Trekking Store</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f7f6; }
        h2 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #2c3e50; color: white; }
        tr:hover { background-color: #f1f1f1; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 15px; background-color: #2980b9; color: white; text-decoration: none; border-radius: 4px; }
        .btn:hover { background-color: #1f618d; }
    </style>
</head>
<body>
    <h2>📋 Trekking Material Orders Dashboard</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Item Name</th>
            <th>Quantity</th>
            <th>Price ($)</th>
            <th>Order Date</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['item_name']); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>$<?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="7" style="text-align:center;">No orders found.</td></tr>
        <?php } ?>
    </table>

    <a class="btn" href="index.html">← Back to Store Form</a>
</body>
</html>

<?php $conn->close(); ?>