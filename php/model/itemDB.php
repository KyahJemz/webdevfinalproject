<?php 

    function CreateNewItem($StoreId, $ItemName, $ItemCategory, $ItemPrice, $ItemImage, $connection) {
        $StoreId = sanitizeQuery($StoreId, $connection);
        $ItemName = sanitizeQuery($ItemName, $connection);
        $ItemCategory = sanitizeQuery($ItemCategory, $connection);
        $ItemPrice = sanitizeQuery($ItemPrice, $connection);
        $ItemImage = sanitizeQuery($ItemImage, $connection);

        if ($StoreId === FALSE || $ItemName === FALSE || $ItemCategory === FALSE || $ItemPrice === FALSE || $ItemImage === FALSE) {
            return FALSE;
        } else {
            $sql = "INSERT INTO tbl_items (StoreId, ItemName, ItemCategory, ItemPrice, ItemImage) 
                    VALUES ('".$StoreId."', '".$ItemName."', '".$ItemCategory."', '".$ItemPrice."', '".$ItemImage."')";
            if ($connection->query($sql) === TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function SelectMyItems($StoreId,$connection){
        $sql = "SELECT * FROM tbl_items WHERE StoreId = '".$StoreId."'";        
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

    function SelectItems($StoreId,$connection){
        $sql = "SELECT * FROM tbl_items AS i LEFT JOIN tbl_stores as s ON i.StoreId = s.StoreId WHERE i.StoreId <> '".$StoreId."'";        
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

    function DeleteItem($ItemId, $connection) {
        $sql = "DELETE FROM tbl_items WHERE ItemId = '".$ItemId."'";        
        $result = $connection->query($sql);
    
        if ($result === true) {
            return true;
        } else {
            return false; 
        }
    }

    function UpdateItemNoImage($ItemId, $ItemName, $ItemCategory, $ItemPrice, $connection) {
        $sql = "UPDATE tbl_items SET 
                ItemName = '".$ItemName."',
                ItemCategory = '".$ItemCategory."',
                ItemPrice = '".$ItemPrice."'
                WHERE ItemId = '".$ItemId."'";        
        $result = $connection->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    function UpdateItemWithImage($ItemId, $ItemName, $ItemCategory, $ItemPrice, $ItemImage, $connection) {
        $sql = "UPDATE tbl_items SET 
                ItemName = '".$ItemName."',
                ItemCategory = '".$ItemCategory."',
                ItemPrice = '".$ItemPrice."',
                ItemImage = '".$ItemImage."' 
                WHERE ItemId = '".$ItemId."'";        
        $result = $connection->query($sql);
        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }