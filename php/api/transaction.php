<?php
 
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../database-config.php';
    require '../auth.php';
    require '../model/transactionDB.php';

    if (isset($_POST['Intent'])){
        $AccountId = $_POST['$AccountId'];
        $AuthToken = $_POST['$AuthToken'];
        if (validateUserSession($AccountId,$AuthToken,$connection)) {
            if ($_POST['Intent']='Insert Transaction') {

            } else if ($_POST['Intent']='Select Transaction') {
                $response = SelectTransaction($AccountId, $connection);
            } else if ($_POST['Intent']='Select Transaction Details') {
                $response = SelectTransactionDetail($TrasactionId,$connection);
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