<?php

include ("dbconnect.php");

   ini_set('display_errors', 'On');
   error_reporting(E_ALL);

    $device = $_GET["device"];
    $access = false;
    $time = "";
    $homedevice = false;
   
   function booleaner($string){
       if($string == '0'){
           return false;
       }else if($string == '1'){
           return true;
       }
   }   

       $newTime = time();
        
       $sql = "SELECT time FROM mydb.Devices WHERE ID='1'";
        $result = mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
        $timestamp = strtotime($row["time"]);
        $d1 = new DateTime(date("Y-m-d H:i:s",$timestamp));
        $d2 = new DateTime(date("Y-m-d H:i:s",strtotime($newTime)));
       
        $interval = $d1->diff($d2);
        $diffInSeconds = $interval->s;
echo  $diffInSeconds;
            if($diffInSeconds < 15 && $interval->i < 1 && $interval->h < 1&& $interval->d < 1&& $interval->m < 1&& $interval->y < 1){
            $homedevice = true;
        }
    if($device == "Alvinesp1"){
        $sql = "SELECT Connection FROM mydb.Devices WHERE ID='1'";
        $result = mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
       
        $connection1 = $row["Connection"] + 1;
        $sql = "UPDATE mydb.Devices SET Connection ='$connection1',time= now() WHERE ID='1'";
        mysqli_query($conn,$sql);
        
        $access = true;
    }
    
     
     if($device == "Alvinweb"){
        $sql = "SELECT time,Connection FROM mydb.Devices WHERE ID='2'";
        $result = mysqli_query($conn,$sql);
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc();
        $newTime = $row["time"];
        $connection = $row["Connection"] + 1;
      
        $sql = "UPDATE mydb.Devices SET Connection= '$connection',time= now() WHERE ID='2'";
        mysqli_query($conn,$sql);
        
       
         $access = true;
         
    }
    
    if($device == "AlvinS"){
         $sql = "SELECT time,Connection FROM mydb.Devices WHERE ID='3'";
        $result = mysqli_query($conn,$sql);
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc();
        
        $connection = $row["Connection"] + 1;
        
        $sql = "UPDATE mydb.Devices SET Connection= '$connection', time= now() WHERE ID='3'";
        mysqli_query($conn,$sql);
        
         $access = true;
    }

    
    if($access == true){
       
         $sql = "SELECT id,Security,Indoor,backlight,updateOTA,MotionSensor,LDR,changed_at FROM mydb.homethings WHERE ID='1'";
        $result = mysqli_query($conn,$sql);
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc();
       
        
    
      $json = [];
      $json = [];
      $json += ["homeDevice" => $homedevice];
      $json += ["Indoor" => booleaner($row["Indoor"])];
      $json += ["Security" => booleaner($row["Security"])];
      $json += ["backlight" => booleaner($row["backlight"])];
      $json += ["updateOTA" => booleaner($row["updateOTA"])];
     $json += ["pir" => $row["MotionSensor"]];
      $json += ["ldr" => booleaner($row["LDR"])];
      
      $sql = "SELECT Value FROM MotionSensor ORDER BY ID DESC LIMIT 1";
       $result = mysqli_query($conn,$sql);
       $row = $result->fetch_assoc();
        $json += ["pirV" => booleaner($row["Value"])];
       
    print(json_encode($json));
       
    mysqli_close($conn);
    }else{
        print("Device not recognised");
    }
?>
