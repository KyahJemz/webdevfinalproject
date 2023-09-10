<?php 
    require_once './auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAINAN - The latgest undeground canteen collections</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/hunt.css">
</head>
<body>
    <?php require './header.php' ?> 
    <div class="content">
        <div class="category-list-container">
            <p class="category-title title">Categories</p>
            <div class="scroll-container">
                <div class="list-container">
                </div>
            </div>
        </div>
        <div class="hunt-grid-container">
            <div class="header">
                <p class="hunt-title title">Hunt Items</p>
                <input type="text" class="hunt-search" placeholder="Search..." value="">
            </div>
            
            <div class="scroll-container">
                <div class="grid-container">
                   
                </div>
            </div>
        </div>
        <div class="cart-list-container">
            <p class="cart-title title">My Cart</p>
            <div class="cart-body scroll-container">
                <div class="list-container">

       
                </div>
            </div>
            <div class="cart-footer">
                <hr>
                <div class="total">
                    <div class="total-items">Items: 0</div>
                    <div class="total-price">Amount: ₱0.00</div>
                </div>
                <hr>
                <div class="shipping">
                    <div class="stores">Stores: 0</div>
                    <div class="shipping-fee">Shipping Fee: ₱0.00</div>
                    <div class="total-shipping-fee">Total Shipping Fee: ₱0.00</div>
                </div>
                <hr>
                <div class="summary">
                    <div class="total-amount">Total: ₱0.00</div>
                    <input class="address" type="text" name="" value="">
                </div>
                <input class="order-now-button" type="submit" value="Order Now">
            </div>
        </div>
    </div>
    <script type="module" src="../js/hunt.js"></script>
</body>
</html>

