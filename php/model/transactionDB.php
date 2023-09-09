<?php 

function InsertTransaction($TransactionAmount, $TransactionStatus,$TransactionOrders,$TransactionBuyer,$TransactionSeller,$TransactionBuyerAddress, $connection) {
    $sql = "INSERT INTO tbl_transactions (TransactionAmount, TransactionStatus, TransactionOrders, TransactionBuyer, TransactionSeller, TransactionBuyerAddress) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("dssiss", $TransactionAmount, $TransactionStatus, $TransactionOrders, $TransactionBuyer, $TransactionSeller, $TransactionBuyerAddress);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        return false;
    }
}



// formData.append('AuthToken', AuthToken);
// formData.append('AccountId', AccountId);
// formData.append('TransactionAmount', TransactionAmount);
// formData.append('TransactionStatus', TransactionStatus);
// formData.append('TransactionOrders', TransactionOrders);
// formData.append('TransactionBuyer', TransactionBuyer);
// formData.append('TransactionSeller', TransactionSeller);
// formData.append('TransactionBuyerAddress', TransactionBuyerAddress);


function SelectTransaction($AccountId, $connection) {
    $sql = "SELECT * FROM tbl_transactions WHERE TransactionBuyer = ?";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $AccountId);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = array();
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    } else {
        return array();
    }
}
function SelectTransactionDetail($TrasactionId,$connection){
    $sql = "SELECT * FROM tbl_transactions WHERE TrasactionId = ?";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $TrasactionId);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = array();
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    } else {
        return array();
    }
}

function CountStoreCompleteTransactions($StoreId, $connection) {
    $sql = "SELECT COUNT(*) AS TransactionCount FROM tbl_transactions WHERE TransactionSeller = ? AND TransactionStatus = 'COMPLETE'";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $StoreId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $transactionCount = $row['TransactionCount'];
        } else {
            $transactionCount = 0;
        }
        $stmt->close();
        return $transactionCount;
    } else {
        return 0;
    }
}

function CountAccountCompleteTransactions($AccountId,$connection){
    $sql = "SELECT COUNT(*) AS TransactionCount FROM tbl_transactions WHERE TransactionBuyer = ? AND TransactionStatus = 'COMPLETE'";
    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $AccountId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $transactionCount = $row['TransactionCount'];
        } else {
            $transactionCount = 0;
        }
        $stmt->close();
        return $transactionCount;
    } else {
        return 0;
    }
}

function UpdateTransactionStatus($TransactionId, $Status, $connection) {
    $sql = "UPDATE tbl_transactions SET TransactionStatus = ? WHERE TransactionId = ?";
    $stmt = $connection->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("si", $Status, $TransactionId);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        return false; 
    }
}
