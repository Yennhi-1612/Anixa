<?php
include('config.php');

function getDBConnection() {
    return new mysqli('localhost', 'root', '', 'anixa_productdb');
}

function getAuthDBConnection() {
    return new mysqli('localhost', 'root', '', 'anixa_authdb');
}

function closeDBConnection($conn) {
    $conn->close();
}
?>