<?php

include ("dbconnect.php");


    $device = $_GET["device"];
    $access = false;
    $time = "";
    $homedevice = false;
   
   function booleaner($string){
       if($string == "0"){
           return false;
       }else if($string == "1"){
           return true;
       }
   }
   
   
         
 
    
    if($device == "Alvinesp1"){
        $sql = "SELECT Connection FROM mydb.Devices WHERE ID='1'";
        $result = mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
       
        $connection1 = $row["Connection"] + 1;
        $sql = "UPDATE mydb.Devices SET Connection ='$connection1' WHERE ID='1'";
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
         print($row["Connection"]);
          print($row["time"]);
        $sql = "UPDATE mydb.Devices SET Connection= '$connection' WHERE ID='2'";
        mysqli_query($conn,$sql);
        
       
         $access = true;
         
    }
    
    if($device == "AlvinS"){
         $sql = "SELECT time,Connection FROM mydb.Devices WHERE ID='3'";
        $result = mysqli_query($conn,$sql);
        $result = $conn->query($sql) or die($conn->error);
        $row = $result->fetch_assoc();
        $newTime = $row["time"];
        $connection = $row["Connection"] + 1;
        
        $sql = "UPDATE mydb.Devices SET Connection= '$connection' WHERE ID='3'";
        mysqli_query($conn,$sql);
        
       $sql = "SELECT time FROM mydb.Devices WHERE ID='1'";
        $result = mysqli_query($conn,$sql);
        $row = $result->fetch_assoc();
        $timestamp = strtotime($row["time"]);
        $d1 = new DateTime(date("Y-m-d H:i:s",$timestamp));
        $d2 = new DateTime(date("Y-m-d H:i:s",strtotime($newTime)));
        
        $interval = $d1->diff($d2);
        $diffInSeconds = $interval->s;
            if($diffInSeconds >= 15){
            $homedevice = false;
        }else if($diffInSeconds < 15 && $interval->i < 1 && $interval->h < 1&& $interval->d < 1&& $interval->m < 1&& $interval->y < 1){
            $homedevice = true;
        }
        
         $access = true;
    }
mysqli_close($conn);
    
    if($access == true){
    $sql1 = "SELECT * FROM mydb.Devices";
        //Security,Indoor,backlight,updateOTA,MotionSensor,LDR
    $result = mysqli_query($conn,$sql1);
    if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Indoor: " . $row["Name"]. "Security " . $row["Connection"]. "<br>";
  }
} else {
  echo "0 results";
}
  //  $row = $result->fetch_assoc();    
    $json = [];
    $json += ["homeDevice" => $homedevice];
    $json += ["Indoor" => booleaner($row["Indoor"])];
    $json += ["Security" => booleaner($row["Security"])];
    $json += ["backlight" => booleaner($row["backlight"])];
    $json += ["updateOTA" => booleaner($row["updateOTA"])];
     $json += ["pir" => $row["MotionSensor"]];
      $json += ["ldr" => booleaner($row["LDR"])];
      
      /* $sql = "SELECT Value FROM MotionSensor ORDER BY ID DESC LIMIT 1";
       $result = mysqli_query($conn,$sql);
       $row = $result->fetch_assoc();
        $json += ["pirV" => booleaner($row["Value"])];
        */
    print(json_encode($json));
    
   
    mysqli_close($conn);
    }else{
        print("Device not recognised");
    }
?>
