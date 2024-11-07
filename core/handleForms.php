<?php

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields
		are not empty for registration!";

		header("Location: ../login.php");
	}

}




if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);

		if ($loginQuery) {
			header("Location: ../index.php");
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields
		are not empty for the login!";
		header("Location: ../login.php");
	}

}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

if(isset($_POST['insertCustomerBtn'])) {
    $customerName = $_POST['customer_name'];
    $phoneNumber = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $created_by = $_SESSION['username'];

    try {
        $stmt = $pdo->prepare("INSERT INTO customers (customer_name, phone_number, email, address, created_by)
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$customerName, $phoneNumber, $email, $address, $created_by]);
        $_SESSION['message'] = "Customer added successfully!";
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error adding customer: " . $e->getMessage();
    }

    header("Location: ../index.php");
    exit();
}

if(isset($_POST['editCustomerBtn'])) {
    $customer_id = $_GET['customer_id'];
    $customerName = $_POST['customer_name'];
    $phoneNumber = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $updated_by = $_SESSION['username'];

    try {
        $stmt = $pdo->prepare("UPDATE customers SET customer_name = ?, phone_number = ?, email = ?, address = ?, updated_by = ? WHERE customer_id = ?");
        $stmt->execute([$customerName, $phoneNumber, $email, $address, $updated_by, $customer_id]);
        $_SESSION['message'] = "Customer updated successfully!";
    } catch(PDOException $e) {
        $_SESSION['message'] = "Error updating customer: " . $e->getMessage();
    }

    header("Location: ../index.php");
    exit();
}

if (isset($_POST['deleteCustomerBtn'])) {
    $query = deleteCustomer($pdo, $_GET['customer_id']);

    if ($query) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Customer deletion failed: " . $pdo->errorInfo()[2];
    }
}

if (isset($_POST['insertReservedPcPartBtn'])) {
    $query = insertReservedPcPart($pdo, $_POST['part_name'], $_POST['category'],
        $_POST['brand'], $_GET['customer_id']);

    if ($query) {
        header("Location: ../viewReservedParts.php?customer_id=" . $_GET['customer_id']);
        exit();
    } else {
        echo "Reserved PC part insertion failed: " . $pdo->errorInfo()[2];
    }
}

if (isset($_POST['editReservedPcPartBtn'])) {
    $query = updateReservedPcPart($pdo, $_POST['part_name'], $_POST['category'],
        $_POST['brand'], $_GET['reservation_id']);

    if ($query) {
        header("Location: ../viewReservedParts.php?customer_id=" . $_GET['customer_id']);
        exit();
    } else {
        echo "Reserved PC part update failed: " . $pdo->errorInfo()[2];
    }
}

if (isset($_POST['deleteReservedPcPartBtn'])) {
    $query = deleteReservedPcPart($pdo, $_GET['reservation_id']);

    if ($query) {
        header("Location: ../viewReservedParts.php?customer_id=" . $_GET['customer_id']);
        exit();
    } else {
        echo "Reserved PC part deletion failed: " . $pdo->errorInfo()[2];
    }
}

?>
