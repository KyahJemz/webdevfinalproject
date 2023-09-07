<?php 
    
function sanitize ($text){
    if (empty($text)) {
        return null;
    } else {
        $newText = preg_replace('/[^a-zA-Z0-9\s]/', '', $text);
        if ($newText === $text) {
            return $newText;
        } else {
            return null;
        }
    }
}

function sanitizeQuery ($text,$connection){
    if (empty($text)) {
        return null;
    } else {
        if($text = mysqli_real_escape_string($connection, $text)) { 
            return $text;
        } else {
            return null;
        }
    }
}

function validateUserSession($AccountId,$AuthToken,$connection){
    $sql = "SELECT AuthToken FROM tbl_accounts WHERE AccountId = '".$AccountId."'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['AuthToken'] === $AuthToken){
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function generateAuthToken($Username,$connection) {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = substr(str_shuffle($characters), 0, $length);
    $AuthToken = password_hash($randomString, PASSWORD_DEFAULT);

    $sql = "UPDATE tbl_accounts SET AuthToken = ? WHERE Username = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $randomString, $Username);

    if ($stmt->execute()) {
        $stmt->close();
        return $randomString;
    } else {
        $stmt->close();
        return false;
    }
}

function Logout(){
    session_unset();
    session_destroy();
    header('Location: ../index.php');
}