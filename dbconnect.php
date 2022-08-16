<?php
$conn = mysqli_connect('localhost',"alvin","Ainacircle25","mydb");
if(!$conn){
    echo 'Connection error: '. mysqli_connect_error();
}else{
print("conneceted");
}
?>
