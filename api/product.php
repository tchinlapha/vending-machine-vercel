<?php
class Product {
    public $name;
    public $price;
    public $amount;
    public $code;
    public $image;

    public function __construct($name, $price, $amount, $code, $image) {
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
        $this->code = $code;
        $this->image = $image;
    }
}
?>
