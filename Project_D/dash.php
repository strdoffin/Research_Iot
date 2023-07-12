<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "smartfarm";
    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn -> connect_error){
        die("Connect failed");
    }
    
    $ruser = $_GET['user'];  
    $data1 = $_GET["temp"];
    $data2 = $_GET["moise_dirt"];
    $aquery = "INSERT INTO temp(user,temp,moise_dirt)VALUES('$ruser','$data1' ,'$data2')";
    $result = mysqli_query($conn,$aquery);
    echo "success";

?>
