<?php 

    function SelectAccount($AccountId,$connection){
        $sql = "SELECT * FROM tbl_accounts WHERE AccountId = '".$AccountId."'";        
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $items = array(); 
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            return $items; 
        } else {
            return array(); 
        }
    } 

    function SelectAccountWithStore($AccountId,$connection){
        $sql = "SELECT * FROM tbl_accounts AS a LEFT JOIN tbl_stores as s ON a.AccountId = s.AccountId WHERE a.AccountId = '".$AccountId."'";  
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $items = array(); 
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
            return $items; 
        } else {
            return array(); 
        }
    } 

    function UpdateAccountNoImage($AccountId, $Firstname, $Lastname, $Username, $Email, $PhoneNumber, $Address, $connection) {
        $sql = "UPDATE tbl_accounts SET 
                Firstname = '".$Firstname."',
                Lastname = '".$Lastname."',
                Username = '".$Username."',
                Email = '".$Email."',
                PhoneNumber = '".$PhoneNumber."',
                Address = '".$Address."'
                WHERE AccountId = '".$AccountId."'";        
        $result = $connection->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    function UpdateItemWithImage($AccountId, $Firstname, $Lastname, $Username, $Email, $PhoneNumber, $Address,$AccountPicture, $connection) {
        $sql = "UPDATE tbl_accounts SET 
                Firstname = '".$Firstname."',
                Lastname = '".$Lastname."',
                Username = '".$Username."',
                Email = '".$Email."',
                PhoneNumber = '".$PhoneNumber."',
                Address = '".$Address."',
                AccountPicture = '".$AccountPicture."'
                WHERE AccountId = '".$AccountId."'";        
        $result = $connection->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }