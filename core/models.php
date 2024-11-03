<?php

function insertCustomer($pdo, $customer_name, $email, $phone_number, $address) {
	$sql = "INSERT INTO customers (customer_name, email, phone_number, address) VALUES(?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_name, $email, $phone_number, $address]);

	if ($executeQuery) {
		return true;
	}
}

function updateCustomer($pdo, $customer_name, $email, $phone_number, $address, $customer_id) {
	$sql = "UPDATE customers
				SET customer_name = ?,
					email = ?,
					phone_number = ?,
					address = ?
				WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_name, $email, $phone_number, $address, $customer_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteCustomer($pdo, $customer_id) {
	$deleteReservedParts = "DELETE FROM reserved_pc_parts WHERE customer_id = ?";
	$deleteStmt = $pdo->prepare($deleteReservedParts);
	$executeDeleteQuery = $deleteStmt->execute([$customer_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM customers WHERE customer_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$customer_id]);

		if ($executeQuery) {
			return true;
		}
	}
}

function getAllCustomers($pdo) {
	$sql = "SELECT * FROM customers";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCustomerByID($pdo, $customer_id) {
	$sql = "SELECT * FROM customers WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getReservedPartsByCustomer($pdo, $customer_id) {
	$sql = "SELECT
				reserved_pc_parts.reservation_id AS reservation_id,
				reserved_pc_parts.part_name AS part_name,
				reserved_pc_parts.category AS category,
				reserved_pc_parts.brand AS brand,
				customers.customer_name AS customer_name
			FROM reserved_pc_parts
			JOIN customers ON reserved_pc_parts.customer_id = customers.customer_id
			WHERE reserved_pc_parts.customer_id = ?
			ORDER BY reserved_pc_parts.part_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function insertReservedPcPart($pdo, $part_name, $category, $brand, $customer_id) {
	$sql = "INSERT INTO reserved_pc_parts (part_name, category, brand, customer_id) VALUES (?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$part_name, $category, $brand, $customer_id]);
	if ($executeQuery) {
		return true;
	}
}

function getReservedPcPartByID($pdo, $reservation_id) {
	$sql = "SELECT
				reserved_pc_parts.reservation_id AS reservation_id,
				reserved_pc_parts.part_name AS part_name,
				reserved_pc_parts.category AS category,
				reserved_pc_parts.brand AS brand,
				customers.customer_name AS customer_name
			FROM reserved_pc_parts
			JOIN customers ON reserved_pc_parts.customer_id = customers.customer_id
			WHERE reserved_pc_parts.reservation_id  = ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$reservation_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateReservedPcPart($pdo, $part_name, $category, $brand, $reservation_id) {
	$sql = "UPDATE reserved_pc_parts
			SET part_name = ?,
				category = ?,
				brand = ?
			WHERE reservation_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$part_name, $category, $brand, $reservation_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteReservedPcPart($pdo, $reservation_id) {
	$sql = "DELETE FROM reserved_pc_parts WHERE reservation_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$reservation_id]);
	if ($executeQuery) {
		return true;
	}
}

?>
