<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Reserved Part</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this reserved part?</h1>
	<?php $getReservedPcPartByID = getReservedPcPartByID($pdo, $_GET['reservation_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>Part Name: <?php echo $getReservedPcPartByID['part_name']; ?></h2>
		<h2>Category: <?php echo $getReservedPcPartByID['category']; ?></h2>
		<h2>Brand: <?php echo $getReservedPcPartByID['brand']; ?></h2>
		<h2>Reserved By: <?php echo $getReservedPcPartByID['customer_name']; ?></h2>
		<h2>Date Reserved: <?php echo $getReservedPcPartByID['date_reserved']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?reservation_id=<?php echo $_GET['reservation_id']; ?>" method="POST">
				<input type="submit" name="deleteReservedPcPartBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
