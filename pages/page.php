<?php 
    session_start();
    require '../php/database-config.php';
    require '../php/auth.php';

    if (!validateUserSession($_SESSION['AccountId'],$_SESSION['AuthToken'],$connection)){
        header('Location: ../index.php');
        Logout();
    } 

    echo '<script>';
    echo '  var Username = "' . $_SESSION['Username'] . '";';
    echo '  var AuthToken = "' . $_SESSION['AuthToken'] . '";';
    echo '  var AccountId = "' . $_SESSION['AccountId'] . '";';
    echo '  var StoreId = "' . $_SESSION['StoreId'] . '";';
    echo '</script>';

    if (isset($_POST['Logout'])){
         Logout();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAINAN - The latgest undeground canteen collections</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/main.css">
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