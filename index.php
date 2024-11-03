<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome To Reserved PC Parts Management System. Add new Customers!</h1>
    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="customer_name">Customer Name</label>
            <input type="text" name="customer_name" required>
        </p>
        <p>
            <label for="phone_number">Contact Number</label>
            <input type="text" name="phone_number" required>
        </p>
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </p>
        <p>
            <label for="address">Address</label>
            <input type="text" name="address" required>
        </p>
        <p>
            <input type="submit" name="insertCustomerBtn">
        </p>
    </form>

    <h2>Existing Customers</h2>
    <?php $getAllCustomers = getAllCustomers($pdo); ?>
    <?php foreach ($getAllCustomers as $customer) { ?>
        <div class="container" style="border-style: solid; width: 50%; height: auto; margin-top: 20px; padding: 10px;">
            <h3>Customer Name: <?php echo $customer['customer_name']; ?></h3>
            <h3>Contact Number: <?php echo $customer['phone_number']; ?></h3>
            <h3>Email: <?php echo $customer['email']; ?></h3>
            <h3>Address: <?php echo $customer['address']; ?></h3>

            <div class="editAndDelete" style="float: right; margin-right: 20px;">
                <a href="viewReservedParts.php?customer_id=<?php echo $customer['customer_id']; ?>">View Reserved Parts</a>
                <a href="editCustomer.php?customer_id=<?php echo $customer['customer_id']; ?>">Edit</a>
                <a href="deleteCustomer.php?customer_id=<?php echo $customer['customer_id']; ?>">Delete</a>
            </div>
        </div>
    <?php } ?>
</body>
</html>
