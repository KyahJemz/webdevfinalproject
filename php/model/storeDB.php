<?php 

function CreateNewStore($AccountId, $StoreName, $StoreImage, $connection) {
    $AccountId = sanitizeQuery($AccountId, $connection);
    $StoreName = sanitizeQuery($StoreName, $connection);
    $StoreImage = sanitizeQuery($StoreImage, $connection);
    if ($AccountId === FALSE || $StoreName === FALSE || $StoreImage === FALSE) {
        return FALSE;
    } else {
        $sql = "INSERT INTO tbl_stores (AccountId, StoreName, StoreImage) VALUES ('".$AccountId."', '".$StoreName."', '".$StoreImage."')";
        if ($connection->query($sql) === TRUE) {
            $StoreId = $connection->insert_id;
            
            $updateSql = "UPDATE tbl_accounts SET StoreId = '".$StoreId."' WHERE AccountId = '".$AccountId."'";
            if ($connection->query($updateSql) === TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

function UpdateStoreWithImage ($StoreId, $StoreName, $StoreImage, $connection){
    $StoreId = sanitizeQuery($StoreId, $connection);
    $StoreName = sanitizeQuery($StoreName, $connection);
    $StoreImage = sanitizeQuery($StoreImage, $connection);

    if ($StoreId === FALSE || $StoreName === FALSE || $StoreImage === FALSE) {
        return FALSE;
    } else {
        $sql = "UPDATE tbl_stores SET StoreName = '".$StoreName."', StoreImage = '".$StoreImage."' WHERE StoreId = '".$StoreId."'";
        if ($connection->query($sql) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function UpdateStore ($StoreId, $StoreName, $connection){
    $StoreId = sanitizeQuery($StoreId, $connection);
    $StoreName = sanitizeQuery($StoreName, $connection);

    if ($StoreId === FALSE || $StoreName === FALSE) {
        return FALSE;
    } else {
        $sql = "UPDATE tbl_stores SET StoreName = '".$StoreName."' WHERE StoreId = '".$StoreId."'";
        if ($connection->query($sql) === TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

function DeleteStore($StoreId,$AccountId,$connection){
    $AccountId = sanitizeQuery($AccountId, $connection);
    $StoreId = sanitizeQuery($StoreId, $connection);
    if ($StoreId === FALSE) {
        return FALSE;
    } else {
        $sql = "DELETE FROM tbl_stores WHERE StoreId = '".$StoreId."'";
        if ($connection->query($sql) === TRUE) {
            $updateSql = "UPDATE tbl_accounts SET StoreId = null WHERE AccountId = '".$AccountId."'";
            if ($connection->query($updateSql) === TRUE) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
}

function SelectStores($StoreId,$connection){
    $sql = "";
    if (empty($StoreId)){
        $sql = "SELECT * FROM tbl_stores";    
    } else {
        $sql = "SELECT * FROM tbl_stores WHERE StoreId <> '".$StoreId."'";    
    }
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

function ValidateStoreOwner($AccountId, $StoreId, $connection) {
    $AccountId = sanitizeQuery($AccountId, $connection);
    $StoreId = sanitizeQuery($StoreId, $connection);
    if ($AccountId === FALSE || $StoreId === FALSE) {
        return FALSE; 
    } else {
        $sql = "SELECT COUNT(*) AS count FROM tbl_stores WHERE StoreId = '".$StoreId."' AND AccountId = '".$AccountId."'";
        $result = $connection->query($sql);
        if ($result !== FALSE) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            if ($count > 0) {
                return TRUE; 
            } else {
                return FALSE; 
            }
        } else {
            return FALSE;
        }
    }
}




function ValidateIfStoreExist($StoreName,$connection){
    $StoreName = sanitizeQuery($StoreName, $connection);
    $sql = "SELECT COUNT(*) AS count FROM tbl_stores WHERE StoreName = '".$StoreName."'";
    $result = $connection->query($sql);
    if ($result !== FALSE) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
            return FALSE; 
        } else {
            return TRUE; 
        }
    } else {
        return TRUE;
    }
}

function ValidateIfStoreExistById($StoreId,$connection){
    $StoreId = sanitizeQuery($StoreId, $connection);
    $sql = "SELECT COUNT(*) AS count FROM tbl_stores WHERE StoreId = '".$StoreId."'";
    $result = $connection->query($sql);
    if ($result !== FALSE) {
        $row = $result->fetch_assoc();
        $count = $row['count'];
        if ($count > 0) {
            return FALSE; 
        } else {
            return TRUE; 
        }
    } else {
        return TRUE;
    }
}



