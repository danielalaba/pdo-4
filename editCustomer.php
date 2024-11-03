<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit User</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getCustomerByID = getCustomerByID($pdo, $_GET['customer_id']); ?>
	<h1>Edit the User!</h1>
	<form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
		<p>
			<label for="customer_name">Customer Name</label>
			<input type="text" name="customer_name" value="<?php echo $getCustomerByID['customer_name']; ?>">
		</p>
		<p>
			<label for="phone_number">Contact Number</label>
			<input type="text" name="phone_number" value="<?php echo $getCustomerByID['phone_number']; ?>">
		</p>
		<p>
			<label for="email">Email</label>
			<input type="email" name="email" value="<?php echo $getCustomerByID['email']; ?>">
		</p>
		<p>
			<label for="address">Address</label>
			<input type="text" name="address" value="<?php echo $getCustomerByID['address']; ?>">
		</p>
		<input type="submit" name="editCustomerBtn" value="Update">
	</form>
</body>
</html>
