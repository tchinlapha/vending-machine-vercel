<?php
require_once 'product.php';
session_start();
if (!isset($_SESSION['products'])) {
    $_SESSION['products'] = [
        new Product("Lychee Berry", 40, 10, "10001", "lychee.jpg"),
        new Product("Soymilk", 45, 10, "10002", "soymilk.jpg"),
        new Product("Sea Salt Coconut", 50, 10, "10003", "coconut.jpg"),
        new Product("Toffee", 30, 10, "10004", "toffee.jpg"),
        new Product("Sesame Bean", 77, 10, "10005", "sesame.jpg"),
        new Product("Green Grape", 61, 10, "10006", "greengrape.jpg"),
        new Product("Secret", 120, 10, "10007", "secret.jpg"),
        new Product("Blind Box", 100, 10, "10008", "blindbox.jpg"),
        new Product("Zimomo", 150, 10, "10009", "zimomo.jpg")
    ];
}

if (!isset($_SESSION['credit'])) {
    $_SESSION['credit'] = 0;
}

$products = $_SESSION['products'];
$credit = $_SESSION['credit'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vending Machine</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container py-4">
        <div class="row">
            <div class="col-lg-7 col-xl-8 mt-4 card shadow-lg">
                <div class="row card-header d-flex">
                    <h4>Labubu Vending Machine</h4>
                    <button class="btn btn-warning ml-auto" onclick="reStock()">Re-Stock</button>
                </div>
                <div class="row card-body">
                    <?php foreach ($products as $index => $product) : ?>
                        <div class="col-4 my-3 text-center py-4 border <?= $index % 3 == 1 ? 'border-left-0 border-right-0' : ''  ?>">
                            <h6 class="text-truncate"><?= $product->name ?></h6>
                            <img class="max-w-100" src="./assets/img/<?= $product->image ?>" style="height:100px;">
                            <h4 class="text-dark font-weight-bold mb-0">Price: $<?= $product->price ?></h4>
                            <p class="mt-0">Amount: <span id="<?= $product->code ?>-amount"><?= $product->amount ?></span></p>
                            <div class="btn btn-primary font-weight-bold text-uppercase">Code: <?= $product->code ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="card credit-section">
                    <div class="card-header">
                        <h4>Top up credit</h4>
                    </div>
                    <div class="card-body d-flex flex-wrap justify-content-center">
                        <button class="coin" onclick="addCredit(1)"><span>$1</span></button>
                        <button class="coin" onclick="addCredit(2)"><span>$2</span></button>
                        <button class="coin" onclick="addCredit(5)"><span>$5</span></button>
                        <button class="coin" onclick="addCredit(10)"><span>$10</span></button>
                        <button class="coin" onclick="addCredit(20)"><span>$20</span></button>
                        <button class="coin" onclick="addCredit(50)"><span>$50</span></button>
                        <button class="coin" onclick="addCredit(100)"><span>$100</span></button>
                    </div>
                    <div class="card-footer">
                        <h5>Your Credit: $<span id="credit"><?= $credit ?></span></h5>
                    </div>
                </div>


                <div class="mt-4 card">
                    <div class="card-body">
                        <div class="form-group text-center">
                            <label class="text-uppercase font-weight-bold">Enter Code</label>
                            <p id="selected-code">00000</p>
                        </div>

                        <div class="keypad">
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('7')">7</button>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('8')">8</button>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('9')">9</button><br>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('4')">4</button>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('5')">5</button>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('6')">6</button><br>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('1')">1</button>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('2')">2</button>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('3')">3</button><br>
                            <button class="btn btn-danger text rounded-lg" onclick="deleteLastKey()">DELETE</button>
                            <button class="btn btn-dark rounded-lg" onclick="pressKey('0')">0</button>
                            <button class="btn btn-success text rounded-lg" onclick="purchase()">BUY</button>
                        </div>
                        <div class="display">
                            <p id="message"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Product Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <h3 id="productName"></h3>
                        <img id="productImage" src="" alt="Product Image" class="img-fluid max-w-50 mb-3">
                        <h2 class="font-weight-bold mb-2">Price: $<span id="productPrice"></span></h2>
                        <div class="btn btn-primary btn-lg font-weight-bold text-uppercase">Code: <span id="productCode"></span></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>