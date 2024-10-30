<?php

$connection = mysqli_connect("localhost", "Jomiloju", "12345678", "bloggerly");
if(!$connection){
    die('Connection failed: ' . mysqli_connect_error());
}

?>