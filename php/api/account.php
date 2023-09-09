<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require '../database-config.php';
    require '../auth.php';
    require '../model/storeDB.php';
    require '../model/accountDB.php';

    if (isset($_POST['Intent'])) {
        if ($_POST['Intent'] === "Update Account"){
            $AuthToken = $_POST['AuthToken'];
            $AccountId = $_POST['AccountId'];
            $Firstname = sanitize($_POST['Firstname']);
            $Lastname = sanitize($_POST['Lastname']);
            $Username = sanitize($_POST['Username']);
            $Password = sanitize($_POST['Password']);
            $Email = ($_POST['Email']);
            $Address = ($_POST['Address']);
            $PhoneNumber = sanitize($_POST['PhoneNumber']);

            if (isset($_FILES['AccountImage'])) {
                if ($_FILES['AccountImage']['size'] != 0) {
                    $AccountPicture = 'PROFILE-'.$AccountId.'.jpg';
                    if (validateUserSession($AccountId,$AuthToken,$connection)){
                        $uploadDir = '../../images/uploads/profiles/';
                        $uploadedFile = $_FILES['AccountImage'];
                        $originalFileName = $uploadedFile['name'];
                        $tempFilePath = $uploadedFile['tmp_name'];
                        $newFileName = $AccountPicture;
                        $targetFilePath = $uploadDir . $newFileName;
                
                        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
                            $response = [
                                'success' => true,
                                'message' => 'File uploaded successfully',
                                'filePath' => $targetFilePath
                            ];
                            if(UpdateItemWithImage($AccountId, $Firstname, $Lastname, $Username, $Email, $PhoneNumber, $Address, $AccountPicture, $connection)){
                                $response = [
                                    'success' => true,
                                    'message' => 'Account updated successfuly'
                                ];
                            } else {
                                $response = [
                                    'success' => false,
                                    'message' => 'Failed to update Account'
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
                        $response = UpdateAccountNoImage($AccountId, $Firstname, $Lastname, $Username, $Email, $PhoneNumber, $Address, $connection);
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
        } else if ($_POST['Intent'] === "Select Account") {
            $AuthToken = $_POST['AuthToken'];
            $AccountId = sanitize($_POST['AccountId']);
            if (validateUserSession($AccountId,$AuthToken,$connection)) {
                $response = SelectAccount($AccountId,$connection);
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Authentication failed',
                    'id' => $AccountId,
                    'token' => $AuthToken
                ];
            }
        } else if ($_POST['Intent'] === "Select Account With Store") {
            $AuthToken = $_POST['AuthToken'];
            $AccountId = sanitize($_POST['AccountId']);
            if (validateUserSession($AccountId,$AuthToken,$connection)) {
                $response = SelectAccountWithStore($AccountId,$connection);
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
    header('Content-Type: application/json');
    echo json_encode($response);
}