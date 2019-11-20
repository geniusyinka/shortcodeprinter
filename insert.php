<?php  
$connect = mysqli_connect("localhost", "root", "", "common_wealth");
$sql = "INSERT INTO tbl_sample (shortcode, value) VALUES ('".$_POST['shortcode']."' , '".$_POST["value"]."')";  
if(mysqli_query($connect, $sql))  
{  
     echo 'Data Inserted';  
}  
 ?>