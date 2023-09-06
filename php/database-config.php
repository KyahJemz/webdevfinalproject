<?php

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'webdevfinalproject';

    $connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }