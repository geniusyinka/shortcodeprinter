<?php  
	$connect = mysqli_connect("localhost", "root", "", "common_wealth");
	$id = $_POST["id"];  
	$text = $_POST["text"];  
	$column_name = $_POST["column_name"];  
	$sql = "UPDATE tbl_sample SET ".$column_name."='".$text."' WHERE id='".$id."' ";  //STRART COLLUM WITH 00001
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Data Updated';  
	}  
 ?>