<?php
include ("dbconnect.php");

$Security = $_GET["SL"];
$Indoor = $_GET["IL"];
$backlight = $_GET["BL"];
$ota = $_GET["OTA"];
$pir = $_GET["PR"];
$ldr = $_GET["LR"];



  
    $sql = "UPDATE homedevices SET Indoor= '$Indoor'WHERE ID='1'";
    mysqli_query($conn,$sql);
    
    $sql = "UPDATE homedevices SET Security= '$Security'WHERE ID='1'";
    mysqli_query($conn,$sql);
    
    $sql = "UPDATE homedevices SET backlight= '$backlight'WHERE ID='1'";
    mysqli_query($conn,$sql);
    
    $sql = "UPDATE mydb.homedevices SET updateOTA= '$ota' WHERE ID='1'";
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
     $sql = "UPDATE homeesp SET MotionSensor= '$pir'WHERE id='0'";
    mysqli_query($conn,$sql);
    
     $sql = "UPDATE homeesp SET LDR= '$ldr'WHERE id='0'";
    mysqli_query($conn,$sql);
    
    mysqli_close($conn);
  
?>

