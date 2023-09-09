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
    <link rel="stylesheet" href="../css/store.css">
</head>
<body>
    <?php require './header.php' ?> 
    <div class="container">
        <div class="stores-grid-container">
            <p class="stores-title title">Stores</p>
            <div class="scroll-container">
                <div class="grid-container">
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="../js/store.js"></script>
</body>
</html>

