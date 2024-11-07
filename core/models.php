<?php

function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}


}



function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]);

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username'];
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}


	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function insertCustomer($pdo, $customer_name, $email, $phone_number, $address) {
	$sql = "INSERT INTO customers (customer_name, email, phone_number, address, created_at, updated_at) VALUES(?,?,?,?, NOW(), NOW())";
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
					address = ?,
                    updated_at = NOW()
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
    try {
        $sql = "SELECT * FROM reserved_parts WHERE customer_id = ?";
        echo "SQL Query: " . $sql . "<br>";
        echo "Customer ID being searched: " . $customer_id . "<br>";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$customer_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Number of results found: " . count($results) . "<br>";
        var_dump($results);

        return $results;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
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
