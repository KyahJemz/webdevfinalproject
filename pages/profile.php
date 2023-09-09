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
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <?php require './header.php' ?>
    <div class="content">
        <div class="directory">Home > Profile</div>
        <div class="container">
            <div class="myprofile">
                <div class="myprofile-header">
                    <p class="title">My Profile</p>
                    <div id="edit-profile-button" class="icons edit-profile-form-button" title="Edit profile"></div>
                </div>
                <div id="ProfileMyprofileContainer" data-view="edit" class="list-scroll">
                 
                </div>
            </div>
            <div class="transactions">
                <div class="title">Recent Transactions</div>
                <div class="list scroll">
                    <div id="ProfileTransactionsContainer" class="list-container">
                        
                    </div>
                </div>
            </div>
            <div class="mystore">
                <div class="mystore-header">
                    <p class="title">My Store</p>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="../js/profile.js"></script>
</body>

</html>       
 <!-- Edit profile details
        Transactions List > Transaction details
        My shop -->
