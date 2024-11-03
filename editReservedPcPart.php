<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Reserved Part</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewReservedParts.php?customer_id=<?php echo $_GET['customer_id']; ?>">
		View Reserved Parts
	</a>
	<h1>Edit the Reserved Part!</h1>
	<?php $getReservedPcPartByID = getReservedPcPartByID($pdo, $_GET['reservation_id']); ?>
	<form action="core/handleForms.php?reservation_id=<?php echo $_GET['reservation_id']; ?>&customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
		<p>
			<label for="partName">Part Name</label>
			<input type="text" name="partName" value="<?php echo $getReservedPcPartByID['part_name']; ?>">
		</p>
		<p>
			<label for="category">Category</label>
			<input type="text" name="category" value="<?php echo $getReservedPcPartByID['category']; ?>">
		</p>
		<p>
			<label for="brand">Brand</label>
			<input type="text" name="brand" value="<?php echo $getReservedPcPartByID['brand']; ?>">
		</p>
		<input type="submit" name="editReservedPcPartBtn" value="Update">
	</form>
</body>
</html>
