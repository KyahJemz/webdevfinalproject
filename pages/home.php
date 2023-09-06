<?php 
    session_start();
    require '../php/database-config.php';
    require '../php/auth.php';

    echo $_SESSION['Username'] . " - " . $_SESSION['AuthToken'] . "<br>";

    echo validateUserSession($_SESSION['Username'],$_SESSION['AuthToken'],$connection);

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>