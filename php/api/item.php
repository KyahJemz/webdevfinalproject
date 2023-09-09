<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../database-config.php';
    require '../auth.php';
    require '../model/storeDB.php';
    require '../model/itemDB.php';

    if (isset($_POST['Intent'])) {
        if ($_POST['Intent'] === "Insert Item") {
            if (isset($_FILES['ItemImage'])) {
                $AuthToken = $_POST['AuthToken'];
                $AccountId = $_POST['AccountId'];
                $StoreId = sanitize($_POST['StoreId']);
                $ItemName = sanitize($_POST['ItemName']);
                $ItemImage = 'ITEM-'.$StoreId.'-'.$ItemName.'-'.uniqid().'.jpg';
                $ItemCategory = $_POST['ItemCategory'];
                $ItemPrice = $_POST['ItemPrice'];

                if (validateUserSession($AccountId,$AuthToken,$connection)){
                    if(!ValidateIfStoreExistById($StoreId,$connection)){
                        $uploadDir = '../../images/uploads/items/';
                        $uploadedFile = $_FILES['ItemImage'];
                        $originalFileName = $uploadedFile['name'];
                        $tempFilePath = $uploadedFile['tmp_name'];
                        $newFileName = $ItemImage;
                        $targetFilePath = $uploadDir . $newFileName;
                
                        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                            $response = [
                                'success' => true,
                                'message' => 'File uploaded successfully',
                                'filePath' => $targetFilePath
                            ];
                            if(CreateNewItem($StoreId, $ItemName, $ItemCategory, $ItemPrice, $ItemImage, $connection)){
                                $response = [
                                    'success' => true,
                                    'message' => 'Item created successfuly'
                                ];
                            } else {
                                $response = [
                                    'success' => false,
                                    'message' => 'Failed to insert Item'
                                ];
                            }
                        } else {
                            $response = [
                                'success' => false,
                                'message' => 'Error uploading file'
                            ];
                        }
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Store does not exist'
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
                    'message' => 'Invalid file',
                ];
            }
        } else if ($_POST['Intent'] === "Update Item"){
            $AuthToken = $_POST['AuthToken'];
            $AccountId = $_POST['AccountId'];
            $StoreId = sanitize($_POST['StoreId']);
            $ItemId = sanitize($_POST['ItemId']);
            $ItemName = sanitize($_POST['ItemName']);
            $ItemCategory = $_POST['ItemCategory'];
            $ItemPrice = $_POST['ItemPrice'];
            if (isset($_FILES['ItemImage'])) {
                if ($_FILES['ItemImage']['size'] != 0) {
                    $ItemImage = 'ITEM-'.$StoreId.'-'.$ItemName.'-'.uniqid().'.jpg';
                    if (validateUserSession($AccountId,$AuthToken,$connection)){
                        $uploadDir = '../../images/uploads/items/';
                        $uploadedFile = $_FILES['ItemImage'];
                        $originalFileName = $uploadedFile['name'];
                        $tempFilePath = $uploadedFile['tmp_name'];
                        $newFileName = $ItemImage;
                        $targetFilePath = $uploadDir . $newFileName;
                
                        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                            $response = [
                                'success' => true,
                                'message' => 'File uploaded successfully',
                                'filePath' => $targetFilePath
                            ];
                            if(UpdateItemWithImage($ItemId, $ItemName, $ItemCategory, $ItemPrice, $ItemImage, $connection)){
                                $response = [
                                    'success' => true,
                                    'message' => 'Item updated successfuly'
                                ];
                            } else {
                                $response = [
                                    'success' => false,
                                    'message' => 'Failed to insert Item'
                                ];
                            }
                        } else {
                            $response = [
                                'success' => false,
                                'message' => 'Error uploading file'
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
                    if (validateUserSession($AccountId,$AuthToken,$connection)){
                        $response = UpdateItemNoImage($ItemId, $ItemName, $ItemCategory, $ItemPrice, $connection);
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Authentication failed',
                            'id' => $AccountId,
                            'token' => $AuthToken
                        ];
                    }
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid File',
                ];
            }
        } else if ($_POST['Intent'] === "Delete Item"){
            $AuthToken = $_POST['AuthToken'];
            $AccountId = sanitize($_POST['AccountId']);
            $StoreId = sanitize($_POST['StoreId']);
            $ItemId = sanitize($_POST['ItemId']);
            if (validateUserSession($AccountId,$AuthToken,$connection)) {
                $response = DeleteItem($ItemId, $connection);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Authentication failed',
                    'id' => $AccountId,
                    'token' => $AuthToken
                ];
            }
        } else if ($_POST['Intent'] === "Select Items"){
            $AuthToken = $_POST['AuthToken'];
            $AccountId = sanitize($_POST['AccountId']);
            $StoreId = sanitize($_POST['StoreId']);
            if (validateUserSession($AccountId,$AuthToken,$connection)) {
                $response = SelectItems($StoreId, $connection);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Authentication failed',
                    'id' => $AccountId,
                    'token' => $AuthToken
                ];
            }
        } else if ($_POST['Intent'] === "Select MyItems"){
            $AuthToken = $_POST['AuthToken'];
            $AccountId = sanitize($_POST['AccountId']);
            $StoreId = sanitize($_POST['StoreId']);
            if (validateUserSession($AccountId,$AuthToken,$connection)) {
                $response = SelectMyItems($StoreId, $connection);
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
                'message' => 'Invalid Post Intent',
                'intent' =>$_POST['Intent'],
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
    require '../database-config.php';
    require '../model/itemDB.php';
    $response = SelectMyItems('2', $connection);
    header('Content-Type: application/json');
    echo json_encode($response);
}