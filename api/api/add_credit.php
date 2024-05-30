<?php
session_start();

if (!isset($_SESSION['credit'])) {
    $_SESSION['credit'] = 0;
}

$amount = $_POST['amount'];
$_SESSION['credit'] += $amount;
$response = ['credit' => $_SESSION['credit']];
echo json_encode($response);
?>
