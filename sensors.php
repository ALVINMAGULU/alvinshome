<?php
include ("dbconnect.php");

 $action = $_GET["action"];
 
 
 if($action == "read"){
      $sql = "SELECT Value FROM LDR ORDER BY ID DESC LIMIT 1";
       $result = mysqli_query($conn,$sql);
       $row = $result->fetch_assoc();
       $ldr =  $row["Value"];
       
    $sql = "SELECT Value FROM MotionSensor ORDER BY ID DESC LIMIT 1";
       $result = mysqli_query($conn,$sql);
       $row = $result->fetch_assoc();
       $pir =  $row["Value"];
       
       $json = [];
       $json += ["ldr" => $ldr];
       $json += ["pir" => $pir];
       echo json_encode($json);
 }else if($action == "write"){
     $pir = $_GET["pir"];
     $ldr = $_GET["ldr"];
         $sql = "INSERT INTO LDR (Value) VALUES ($ldr)";
          mysqli_query($conn,$sql);
         $sql = "INSERT INTO MotionSensor (Value) VALUES ($pir)";
         mysqli_query($conn,$sql);
     }
     
 
 mysqli_close($conn);
?>
