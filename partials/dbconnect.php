<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'idiscuss';

$conn = mysqli_connect($servername , $username , $password , $database);
if(!$conn){
    echo "Connection problem";
}
?>