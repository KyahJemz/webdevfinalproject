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
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <?php require './header.php' ?>
    <div class="content">
        <div class="directory">Home > Profile</div>
        <div class="container">
            <div class="myprofile">
                <p class="title">My Profile</p>
                <div class="list-scroll">
                    <img class="center" src="<?php if(isset($_SESSION['ProfileImage'])) {echo $_SESSION['ProfileImage'];}?>" alt="">
                    <p class="center name"><?php if(isset($_SESSION['Firstname']) && isset($_SESSION['Lastname'])) {echo $_SESSION['Firstname'] . " " .  $_SESSION['Lastname'];}?></p>
                    <p class="center username">@<?php if(isset($_SESSION['Username'])) {echo $_SESSION['Username'];}?></p>
                    <br>
                    <p class="left email"><a>E-mail: </a> <?php if(isset($_SESSION['Email'])) {echo $_SESSION['Email'];}?></p>
                    <p class="left phone-number"><a>Phone Number: </a><?php if(isset($_SESSION['PhoneNumber'])) {echo $_SESSION['PhoneNumber'];}?></p>
                    <p class="left address"><a>Complete Address: </a></p>
                    <p class="left address-content"><?php if(isset($_SESSION['Address'])) {echo $_SESSION['Address'];}?></p>
                    <br>
                    <p class="left joined-date"><a>Joined Date: </a><?php if(isset($_SESSION['JoinedDate'])) {echo $_SESSION['JoinedDate'];}?></p>
                    <p class="left success-orders"><a>Success Orders: </a><?php if(isset($_SESSION['SuccessOrders'])) {echo $_SESSION['SuccessOrders'];}?></p>
                    <?php if (isset($_SESSION['StoreId'])) {?>
                        <br>
                        <p class="left store-name"><a>Store Name: </a><?php if(isset($_SESSION['StoreName'])) {echo $_SESSION['JoinedDate'];}?></p>
                        <p class="left store-orders"><a>Store Orders: </a><?php if(isset($_SESSION['StoreOrders'])) {echo $_SESSION['StoreOrders'];}?></p>
                        <br>
                    <?php 
                        } 
                    ?>
                </div>
                
            </div>
            <div class="transactions">
                <div class="title">Recent Transactions</div>
                <div class="list scroll">
                <div id="ProfileTransactionsContainer" class="list-container">
                    <div class="list-item">
                        <span class="left">
                            <div class="user">asdasdsadsa</div>
                            <div class="type">assssssssssssssdasd</div>
                            <div class="date">dadasssssssssssssssssssssssd</div>
                        </span>
                        <span class="cost">span</span>
                    </div>
                    <div class="list-item">
                        <span class="left">
                            <div class="user">asdasdsadsa</div>
                            <div class="type">assssssssssssssdasd</div>
                            <div class="date">dadasssssssssssssssssssssssd</div>
                        </span>
                        <span class="cost">span</span>
                    </div>
                    <div class="list-item">
                        <span class="left">
                            <div class="user">asdasdsadsa</div>
                            <div class="type">assssssssssssssdasd</div>
                            <div class="date">dadasssssssssssssssssssssssd</div>
                        </span>
                        <span class="cost">span</span>
                    </div>
                    <div class="list-item">
                        <span class="left">
                            <div class="user">asdasdsadsa</div>
                            <div class="type">assssssssssssssdasd</div>
                            <div class="date">dadasssssssssssssssssssssssd</div>
                        </span>
                        <span class="cost">span</span>
                    </div>
                </div>
                

                </div>
            </div>
            <div class="mystore">
                <div class="mystore-header">
                    <p class="title">My Store</p>
                    <?php 
                        if (!empty($_SESSION['StoreId'])) {
                    ?>
                            <div id="ProfileMyshopAddItemFormButton" class="icons add-item-form-button" title="Add item"></div>
                    <?php 
                        }
                    ?>  
                </div>
                
                <?php 
                    if (empty($_SESSION['StoreId'])) {
                ?>
                        <div class="create-store">
                            <p>Do you want to create your own store?</p>
                            <form id="form-add-store" action="../php/api/store.php" method="post" enctype="multipart/form-data">
                                <div id="create-store-result" style="display: none;">
                                    
                                </div>
                                <label for="store-image">Store image:</label>
                                <input class="add-store-image" type="file" name="store-image" require accept="image/*">
                                <label for="store-name">Store Name:</label>
                                <input class="add-store-name" type="text" name="store-name" require>
                                <input id="add-store-button" type="submit" value="Create my store">
                            </form>
                        </div>
                <?php 
                    }  else {
                ?>  
                    <div class="list-scroll">
                        <div id="ProfileMystoreContainer" class="list-container">

                            <div class="list-item add-item-form-container" style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 0px">
                                <div class="bottom add-item-form" style="height: 0">
                                    <form id="form-add-item" style="border-top-width: 0px" action="../php/api/item.php" method="post" enctype="multipart/form-data">
                                        <h3>Add Item Form</h3>
                                        <fieldset><legend>Item Image:</legend><input name="ItemImage" class="add-image" type="file"></fieldset>
                                        <fieldset><legend>Item Name:</legend><input name="ItemName" class="add-name" type="text"></fieldset>
                                        <fieldset><legend>Item Category:</legend><input name="ItemCategory" class="add-category" type="text"></fieldset>
                                        <fieldset><legend>Item Price:</legend><input name="ItemPrice" class="add-price" type="text"></fieldset>
                                        <input id="add-item-button" class="add-button" type="submit" value="Add item">
                                    </form>
                                </div>
                            </div>

                            <div class="list-item" data-id="12" data-name="" data-category="" data-price="" data-image="">
                                <div class="top">
                                    <div class="item-image">
                                        <img src="../images/food-sample.jpg" alt="">
                                    </div>
                                    <div class="contents">
                                        <p class="item-name">food name</p>
                                        <p class="item-category">food</p>
                                        <p class="item-price">123</p>
                                    </div>
                                    <div class="actions">
                                        <div class="icons edit-button" title="Edit"></div>
                                        <div class="icons delete-button" title="Delete"></div>
                                    </div>
                                </div>
                                <div class="bottom" style="height: 0">
                                    <form action="" method="">
                                        <h3>Edit Item Form</h3>
                                        <fieldset><legend>Item Image:</legend><input class="new-image" type="file"></fieldset>
                                        <fieldset><legend>Item Name:</legend><input class="new-name" type="text"></fieldset>
                                        <fieldset><legend>Item Category:</legend><input class="new-category" type="text"></fieldset>
                                        <fieldset><legend>Item Price:</legend><input class="new-price" type="text"></fieldset>
                                        <input class="update-button" type="button" value="Update changes">
                                    </form>
                                </div>
                            </div>



                        </div>
                    </div>
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
    <script type="module" src="../js/profile.js"></script>
</body>

</html>       
 <!-- Edit profile details
        Transactions List > Transaction details
        My shop -->
