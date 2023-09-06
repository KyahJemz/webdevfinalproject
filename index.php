<?php 

    session_start();

    if (isset($_POST['kainan-sign-in'])) {
        validateSignIn();
    } else if (isset($_POST['kainan-sign-up'])){
        validateSignUp();
    } else {

    }

    function validateSignIn (){
        require './php/database-config.php';
        require './php/auth.php';
        $username = sanitize($_POST['kainan-username']);
        $password = sanitize($_POST['kainan-password']);

        $sql = "SELECT * FROM tbl_accounts WHERE Username = '".$username."'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $storedPasswordHash = $row['Password'];

            if (password_verify(trim($password), trim($storedPasswordHash))) {
                $_SESSION['SIerror'] = "<p class='success'>Success, Welcome user!</p>";

                $generatedToken = generateAuthToken($username,$connection);
                $connection->close();

                $_SESSION['Username'] = $username;
                $_SESSION['AuthToken'] = $generatedToken;
                header('Location: ./pages/home.php');
                exit;
            } else {
                $_SESSION['SIerror'] = "<p class='danger'>Failed, wrong password!</p>";
                $connection->close();
                return null;
            }
        } else {
            $_SESSION['SIerror'] = "<p class='danger'>Failed, invalid account!</p>";
            $connection->close();
            return null;
        }
    }
    function validateSignUp (){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require './php/database-config.php';
            require './php/auth.php';
            $firstname = sanitize($_POST['kainan-firstname']);
            $lastname = sanitize($_POST['kainan-lastname']);
            $username = sanitize($_POST['kainan-username']);
            $password = sanitize($_POST['kainan-password']);
            $confirmpassword = sanitize($_POST['kainan-confirm-password']);

            if ($password != $confirmpassword) {
                $_SESSION['SUerror'] = "<p class='danger'>Failed, password does not match!</p>";
                return null;
            } else {
                if (empty($firstname)){
                    $_SESSION['SUerror'] = "<p class='danger'>Failed, Invalid firstname!</p>";
                    return null;
                }
                if (empty($lastname)){
                    $_SESSION['SUerror'] = "<p class='danger'>Failed, Invalid lastname!</p>";
                    return null;
                }
                if (empty($username)){
                    $_SESSION['SUerror'] = "<p class='danger'>Failed, Invalid username!</p>";
                    return null;
                }
                if (empty($password)){
                    $_SESSION['SUerror'] = "<p class='danger'>Failed, Invalid password!</p>";
                    return null;
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                }

                $sql = "SELECT Username FROM tbl_accounts WHERE Username = '".$username."'";
                $result = $connection->query($sql);
                if ($result->num_rows > 0) {
                    $_SESSION['SUerror'] = "<p class='danger'>Failed, username already taken!</p>";
                    $connection->close();
                    return null;
                } else {
                    
                    $sql = "INSERT INTO tbl_accounts (Firstname, Lastname, Username, Password) VALUES ('$firstname', '$lastname', '$username', '$password')";
                    if ($connection->query($sql) === TRUE) {
                        $_SESSION['SUerror'] = "<p class='success'>Success, please sign in!</p>";
                        $connection->close();
                        return null;
                    } else {
                        $_SESSION['SUerror'] = "<p class='danger'>Failed, server error!</p>";
                        $connection->close();
                        return null;
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>KAINAN - The latgest undeground canteen collections</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">

</head>
<body>
    <div class="login-container">
        <div class="container-background">
            <div id="sign-in-form-button" class="right-panel" style="visibility: hidden;">
                <p>Already have an account?</p>
                <button>Sign In</button>
            </div>
            <div id="sign-up-form-button" class="left-panel" style="visibility: visible">
                <p>Do you dont have an account?</p>
                <button>Sign Up</button>
            </div>
        </div>
        <div class="container-panel move-left">
            <form class="sign-in-container" action="" method="post">
                <h1>Sign in Form</h1>
                <div id="sign-in-result" style="display: <?php if (!empty($_SESSION['SIerror'])) {echo 'block';} else {echo 'hidden';} ?>;">
                    <?php if (!empty($_SESSION['SIerror'])) {echo $_SESSION['SIerror'];} ?>
                </div>
                <label for="kainan-username">Username:</label>
                <input class="inputtext" type="text" name="kainan-username">
                <label for="kainan-password">Password:</label>
                <input class="inputtext" type="password" name="kainan-password">
                <input class="inputbutton" type="submit" name="kainan-sign-in" value="Submit">
            </form>
    
            <form class="sign-up-container sign-up-container-hidden" action="" method="post">
                <h1>Sign up Form</h1>
                <div id="sign-up-result" style="display: <?php if (!empty($_SESSION['SUerror'])) {echo 'block';} else {echo 'hidden';} ?>;">
                    <?php if (!empty($_SESSION['SUerror'])) {echo $_SESSION['SUerror'];} ?>
                </div>
                <label for="kainan-firstname">Firstname:</label>
                <input class="inputtext" type="text" name="kainan-firstname">
                <label for="kainan-lastname">Lastname:</label>
                <input class="inputtext" type="text" name="kainan-lastname">
                <label for="kainan-username">Username:</label>
                <input class="inputtext" type="text" name="kainan-username">
                <label for="kainan-password">Password:</label>
                <input class="inputtext" type="password" name="kainan-password">
                <label for="kainan-confirm-password">Confirm Password:</label>
                <input class="inputtext" type="password" name="kainan-confirm-password">
                <input class="inputbutton" type="submit" name="kainan-sign-up" value="Submit">
            </form>
            
        </div>
    </div>
    <script src="./js/script.js"></script>
    <script src="./js/login.js"></script>
    <?php
        if (!empty($_SESSION['SUerror'])) {
            echo '<script>';
            echo 'ChangePanel("sign-up");';
            echo '</script>';
        }

        $_SESSION['SUerror'] = null;
        $_SESSION['SIerror'] = null;
    ?>
</body>
</html>
