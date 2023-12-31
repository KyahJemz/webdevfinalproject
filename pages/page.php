<?php 
    require_once './auth.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAINAN - The latgest undeground canteen collections</title>
    
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php require './header.php' ?>
    <div class="content">
        <div id="home" class="banner">
            <img class="banner-image" src="" alt="">
            <div class="banner-content">
                <div class="banner-title">This is title</div>
                <div class="banner-subtitle">This is subtitle nyenye</div>
            </div>
        </div>
        <div class="suggested">
            <div class="suggested-row suggested-items">
                <div class="title">Suggested Items</div>
                <div id="suggested-items-container" class="card-container">

                </div>
            </div>
            <div class="suggested-row suggested-stores">
                <div class="title">Suggested Stores</div>
                <div id="suggested-stores-container" class="card-container">
                    
                </div>
            </div>
        </div>
        <div id="about" class="about"></div>
        <div class="footer"></div>
    </div>

    <script type="module" src="../js/page.js"></script>
</body>

</html>