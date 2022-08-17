<?php
include ("dbconnect.php");

$Security = $_GET["SL"];
$Indoor = $_GET["IL"];
$backlight = $_GET["BL"];
$ota = $_GET["OTA"];
$pir = $_GET["PR"];
$ldr = $_GET["LR"];



  
    $sql = "UPDATE mydb.homethings SET Indoor= '$Indoor'WHERE ID='1'";
    mysqli_query($conn,$sql);
    
    $sql = "UPDATE mydb.homethings SET Security= '$Security'WHERE ID='1'";
    mysqli_query($conn,$sql);
    
    $sql = "UPDATE mydb.homethings SET backlight= '$backlight'WHERE ID='1'";
    mysqli_query($conn,$sql);
    
    $sql = "UPDATE mydb.homethings SET updateOTA= '$ota' WHERE ID='1'";
    mysqli_query($conn,$sql);
     if(!$sql)
{
    echo mysqli_error($conn);
    die();
}
else
{
    echo "Query succesfully executed!";
}     
     $sql = "UPDATE mydb.homethings SET MotionSensor= '$pir'WHERE ID='0'";
    mysqli_query($conn,$sql);
    
     $sql = "UPDATE mydb.homethings SET LDR= '$ldr'WHERE ID='0'";
    mysqli_query($conn,$sql);
    
    mysqli_close($conn);
  
?>

