<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
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
    <?php $getAllInfoByCustomerID = getAllInfoByCustomerID($_GET['customer_id']); ?>
    <h1>Customer Name: <?php echo $getAllInfoByCustomerID['customer_name']; ?></h1>
    <h1>Add New Reserved PC Part</h1>
    <form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
        <p>
            <label for="partName">PC Part Name</label>
            <input type="text" name="partName" required>
        </p>
        <p>
            <label for="partDetails">Part Details</label>
            <input type="text" name="partDetails" required>
            <input type="submit" name="insertNewPartBtn" value="Add Part">
        </p>
    </form>

    <table style="width:100%; margin-top: 50px;">
        <tr>
            <th>Part ID</th>
            <th>Part Name</th>
            <th>Part Details</th>
            <th>Reserved By</th>
            <th>Date Reserved</th>
            <th>Action</th>
        </tr>
        <?php $getReservedPartsByCustomer = getReservedPartsByCustomer($pdo, $_GET['customer_id']); ?>
        <?php foreach ($getReservedPartsByCustomer as $row) { ?>
            <tr>
                <td><?php echo $row['part_id']; ?></td>
                <td><?php echo $row['part_name']; ?></td>
                <td><?php echo $row['part_details']; ?></td>
                <td><?php echo $row['reserved_by']; ?></td>
                <td><?php echo $row['date_reserved']; ?></td>
                <td>
                    <a href="editPart.php?part_id=<?php echo $row['part_id']; ?>&customer_id=<?php echo $_GET['customer_id']; ?>">Edit</a>
                    <a href="deletePart.php?part_id=<?php echo $row['part_id']; ?>&customer_id=<?php echo $_GET['customer_id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
