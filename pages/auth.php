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
    echo '  var Firstname = "' . $_SESSION['Firstname'] . '";';
    echo '  var Lastname = "' . $_SESSION['Lastname'] . '";';
    echo '  var Email = "' . $_SESSION['Email'] . '";';
    echo '  var Address = "' . $_SESSION['Address'] . '";';
    echo '  var PhoneNumber = "' . $_SESSION['PhoneNumber'] . '";';
    echo '</script>';

    if (isset($_POST['Logout'])){
        Logout();
    }
