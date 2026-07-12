<?php
try {
    // Get database connection parameters
    require 'config.php';
    
    // Connect to the inventory database
    $db = new PDO(
    "mysql:host=$dbHost;port=3306;dbname=$dbName",
    $dbUser,
    $dbPass
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Show all items in the inventory database
    $stmt = $db->query("SELECT * FROM items");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventory Items</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<div class="container">
<h1>Inventory Items</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Purchase Date</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['id']; ?></td>
            <td><?php echo $item['item_name']; ?></td>
            <td><?php echo $item['category']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['purchase_date']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
