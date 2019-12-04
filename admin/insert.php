<?php  

global $wpdb;
$table_name = $wpdb->prefix . 'tbl_code';
$wpdb->INSERT($table_name, array(

										'shortcode' => $_POST['shortcode'],
										'value' => $_POST['value'],
										array('%s', '%s')
									)
);


// if ($rowResult == 1) {
// 	# code...
// 	echo "Data Inserted";
// }


	// function push_to_db(){
		// $connect = mysqli_connect("localhost", "root", "", "common_wealth");
		// $sql = "INSERT INTO tbl_code (shortcode, value) VALUES ('".$_POST['shortcode']."' , '".$_POST["value"]."')"; 
		// if(mysqli_query($connect, $sql))  
		// {  
		//     echo 'Data Inserted';  
		// }  

		// else{

		// 	echo "Data not inserted!";
		// }
		//}

 ?>


