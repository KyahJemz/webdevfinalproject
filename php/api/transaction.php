<?php
 
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../database-config.php';
    require '../auth.php';
    require '../model/transactionDB.php';

    if (isset($_POST['Intent'])){
        $AccountId = $_POST['AccountId'];
        $AuthToken = $_POST['AuthToken'];
        if (validateUserSession($AccountId,$AuthToken,$connection)) {
            if ($_POST['Intent']==='Insert Transaction') {
                $TransactionAmount = $_POST['TransactionAmount'];
                $TransactionStatus = $_POST['TransactionStatus'];
                $TransactionBuyer = $_POST['TransactionBuyer'];
                $TransactionSeller = $_POST['TransactionSeller'];
                $TransactionOrders = $_POST['TransactionOrders'];
                $TransactionBuyerAddress = $_POST['TransactionBuyerAddress'];

                $response = InsertTransaction($TransactionAmount, $TransactionStatus,$TransactionOrders,$TransactionBuyer,$TransactionSeller,$TransactionBuyerAddress, $connection);
            } else if ($_POST['Intent']==='Select Transaction') {
                $response = SelectTransaction($AccountId, $connection);
                if (!(sizeof($response) > 0)) {
                    $response = [];
                }
            } else if ($_POST['Intent']==='Select Transaction Details') {
                $response = SelectTransactionDetail($TrasactionId,$connection);
                if (!(sizeof($response) > 0)) {
                    $response = [];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid Post Intent',
                    'intent' =>$_POST['Intent'],
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Authentication failed',
                'id' => $AccountId,
                'token' => $AuthToken
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Invalid Post',
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = [
        'success' => false,
        'message' => 'Invalid Post Request',
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}