<?php

require_once 'dbConfig.php';
require_once 'models.php';

if (isset($_POST['insertCustomerBtn'])) {
    echo "Insert button clicked. Processing...<br>";

    $query = insertCustomer($pdo, $_POST['customer_name'], $_POST['email'], $_POST['phone_number'], $_POST['address']);

    if ($query) {
        echo "Customer added successfully. Redirecting...";
        header("Location: ../index.php");
        exit();
    } else {
        echo "Customer insertion failed.";
    }
}

if (isset($_POST['editCustomerBtn'])) {
    $query = updateCustomer($pdo, $_POST['customer_name'], $_POST['email'],
        $_POST['phone_number'], $_POST['address'], $_GET['customer_id']);

    if ($query) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Customer edit failed: " . $pdo->errorInfo()[2];
    }
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
