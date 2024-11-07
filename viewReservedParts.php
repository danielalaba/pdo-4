<?php
require_once 'core/models.php';
require_once 'core/dbConfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserved PC Parts</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Return to home</a>
    <?php
    if(isset($_GET['customer_id'])) {
        $customer_id = $_GET['customer_id'];
        $customerInfo = getAllInfoByCustomerID($customer_id);
        if($customerInfo) {
    ?>
        <h1>Customer Name: <?php echo htmlspecialchars($customerInfo['customer_name']); ?></h1>

        <h1>Add New Reserved PC Part</h1>
        <form action="core/handleForms.php" method="POST">
            <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
            <p>
                <label for="part_name">PC Part Name</label>
                <input type="text" name="part_name" required>
            </p>
            <p>
                <label for="partDetails">Part Details</label>
                <input type="text" name="partDetails" required>
                <input type="submit" name="insertReservedPcPartBtn" value="Add Part">
            </p>
        </form>

        <table style="width:100%; margin-top: 50px;">
            <tr>
                <th>Reservation ID</th>
                <th>Part Name</th>
                <th>Category</th>
                <th>Brand</th>
            </tr>
            <?php
            echo "Customer ID: " . $customer_id . "<br>";
            $reservedParts = getReservedPartsByCustomer($pdo, $customer_id);
            var_dump($reservedParts);
            if($reservedParts) {
                foreach ($reservedParts as $row) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['reservation_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['part_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['brand']); ?></td>
                    <td>
                        <a href="editReservedPcPart.php?part_id=<?php echo $row['part_id']; ?>&customer_id=<?php echo $customer_id; ?>">Edit</a>
                        <a href="deleteReservedPcPart.php?part_id=<?php echo $row['part_id']; ?>&customer_id=<?php echo $customer_id; ?>">Delete</a>
                    </td>
                </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No reserved parts found</td></tr>";
            }
            ?>
        </table>
    <?php
        } else {
            echo "<h1>Customer not found</h1>";
        }
    } else {
        echo "<h1>No customer ID provided</h1>";
    }
    ?>
</body>
</html>
