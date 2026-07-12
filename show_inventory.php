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

/* Why I chose my items: I began with the items from the example code given, and assumed
they were office supplies, or things you might be able to purchase at office depot. I then
started to think of things around my desk, or items one might find around their desk.

How this could scale to real world inventory systems: This could scale to real world inventory
systems by adding more tables and complexity to the database. You could add tables for various
other record keeping needs related to inventory. You could add a table of product skus, or a table
for product prices. You could add data entry pages using PDO prepared statements to help prevent SQL
injection attacks. You could add report generation capabilities with download and export options. 

How using PDO protects from SQL injection: The method used priot to PDO utilized built SQL queries by
combining commands and user data together. PDO separates the SQL command into a prepared statement and
sends the data separately. If there were data entry within this simple application, a hacker could
attempt to send SQL code as input, but it would be separate from the prepared statement and processed
as data. */
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
