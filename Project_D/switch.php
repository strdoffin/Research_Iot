<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartfarm";

$conn = new mysqli($servername,$username,$password,$dbname);
if($conn -> connect_error){
    die("Connect failed");
}

$data1 ="SELECT * FROM user WHERE id=1";

$result_led = $conn->query($data1);

while($row = $result_led->fetch_assoc()){
    echo $row['led_status'],$row['water_status'],$row['auto_farm'];
}
$conn->close();
?>
