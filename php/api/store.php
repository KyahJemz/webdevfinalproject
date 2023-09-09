<?php 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../database-config.php';
    require '../auth.php';
    require '../model/storeDB.php';

    if (isset($_POST['Intent'])) {
        if ($_POST['Intent'] === "Insert Store") {
            if (isset($_FILES['store-image'])) {
                $AuthToken = $_POST['AuthToken'];
                $AccountId = $_POST['AccountId'];
                $StoreName = sanitize($_POST['store-name']);
                $StoreImage = 'STORE-'.$StoreName.'.jpg';

                if (validateUserSession($AccountId,$AuthToken,$connection)){
                    if(ValidateIfStoreExist($StoreName,$connection)){
                        $uploadDir = '../../images/uploads/stores/';
                        $uploadedFile = $_FILES['store-image'];
                        $originalFileName = $uploadedFile['name'];
                        $tempFilePath = $uploadedFile['tmp_name'];
                        $newFileName = 'STORE-' . $_POST['store-name'] . ".jpg";
                        $targetFilePath = $uploadDir . $newFileName;
                
                        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                            $response = [
                                'success' => true,
                                'message' => 'File uploaded successfully',
                                'filePath' => $targetFilePath
                            ];
                            if(CreateNewStore($AccountId, $StoreName, $StoreImage, $connection)){
                                $response = [
                                    'success' => true,
                                    'message' => 'Store created successfuly'
                                ];
                            } else {
                                $response = [
                                    'success' => false,
                                    'message' => 'Failed to insert store'
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
                            'message' => 'Store name already exist, try again'
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
        } else if ($_POST['Intent'] === "Update Store"){
            if (isset($_FILES['StoreImage'])) {
                if ($_FILES['StoreImage']['size'] != 0) {
                    $AuthToken = $_POST['AuthToken'];
                    $AccountId = $_POST['AccountId'];
                    $StoreId = $_POST['StoreId'];
                    $StoreName = sanitize($_POST['StoreName']);
                    $StoreImage = 'STORE-'.$StoreName.'.jpg';

                    if (validateUserSession($AccountId,$AuthToken,$connection)){
                        if(ValidateIfStoreExist($StoreName,$connection)){
                            $uploadDir = '../../images/uploads/stores/';
                            $uploadedFile = $_FILES['StoreImage'];
                            $originalFileName = $uploadedFile['name'];
                            $tempFilePath = $uploadedFile['tmp_name'];
                            $newFileName = 'STORE-' . $_POST['StoreName'] . ".jpg";
                            $targetFilePath = $uploadDir . $newFileName;
                    
                            if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                                UpdateStoreWithImage($StoreId, $StoreName, $StoreImage, $connection);
                                $response = [
                                    'success' => true,
                                    'message' => 'File uploaded successfully',
                                    'filePath' => $targetFilePath
                                ];
                            } else {
                                $response = [
                                    'success' => false,
                                    'message' => 'Error uploading file'
                                ];
                            }
                        } else {
                            $response = [
                                'success' => false,
                                'message' => 'Store name already exist, try again'
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
                    $AuthToken = $_POST['AuthToken'];
                    $AccountId = $_POST['AccountId'];
                    $StoreId = $_POST['StoreId'];
                    $StoreName = sanitize($_POST['StoreName']);
                    if (validateUserSession($AccountId,$AuthToken,$connection)) {
                        $response = UpdateStore($StoreId, $StoreName, $connection);
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
                    'message' => 'Invalid file',
                ];
            }
        } else if ($_POST['Intent'] === "Delete Store"){
            $AuthToken = $_POST['AuthToken'];
            $AccountId = sanitize($_POST['AccountId']);
            $StoreId = sanitize($_POST['StoreId']);
            if (validateUserSession($AccountId,$AuthToken,$connection)) {
                $response = DeleteStore($StoreId,$AccountId,$connection);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Authentication failed',
                    'id' => $AccountId,
                    'token' => $AuthToken
                ];
            }
        } else if ($_POST['Intent'] === "Select Store"){
            $AuthToken = $_POST['AuthToken'];
            $AccountId = sanitize($_POST['AccountId']);
            $StoreId = sanitize($_POST['StoreId']);
            if (validateUserSession($AccountId,$AuthToken,$connection)) {
                $response = SelectStores($StoreId, $connection);
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