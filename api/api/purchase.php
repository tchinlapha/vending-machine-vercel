<?php
require_once '../product.php';
session_start();

$code = $_POST['code'];
$products = $_SESSION['products'];
$credit = $_SESSION['credit'];
$response = ['success' => false, 'message' => 'Product not found', 'price' => 0, 'product' => null, 'credit' => $credit];

foreach ($products as $key => $product) {
    if ($product->code === $code) {
        if ($product->amount > 0) {
            if ($credit >= $product->price) {
                $_SESSION['products'][$key]->amount -= 1;
                $_SESSION['credit'] -= $product->price;
                $response['success'] = true;
                $response['message'] = "Successfully purchased {$product->name}!";
                $response['price'] = $product->price;
                $response['product'] = $product;
                $response['credit'] = $credit - $product->price;
            } else {
                $response['message'] = "Credit not enough.";
            }
        } else {
            $response['message'] = "The product is out of stock.";
        }
        break;
    }
}

echo json_encode($response);
?>
