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

function validateUserSession($Username,$AuthToken,$connection){
    $sql = "SELECT AuthToken FROM tbl_accounts WHERE Username = '".$Username."'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (trim($row['AuthToken']) === trim($AuthToken)){
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
    $stmt->bind_param("ss", $AuthToken, $Username);

    if ($stmt->execute()) {
        $stmt->close();
        return $AuthToken;
    } else {
        $stmt->close();
        return false;
    }
}