<?php
/**
* Plugin Name: Items Shortcode printer
* Plugin URI: https://www.github.com
* Description: This plugin is designed to create new category shortcodes and print them.
* Version: 1.0
* Author: Olayinka Oshidipe
* Author URI: http://geniusyinka.com
*/

if (! defined("ABSPATH")) {
	die;
}



/**
 * this is the class that handles everyting.
 */
class Shortcodeplugin{
	
		function my_nonce(){
			    $nonce = wp_create_nonce( 'my_general_nonce' );
	    		echo "<meta name='csrf-token' content='$nonce'>";
		}

		function verify_general_nonce(){
	    $nonce = isset( $_SERVER['HTTP_X_CSRF_TOKEN'] )
	        ? $_SERVER['HTTP_X_CSRF_TOKEN']
	       : '';
	    if ( !wp_verify_nonce( $nonce, 'my_general_nonce' ) ) {
	        die();
	    } 
	}


//start of databse table creation. 
		function createTable() {      
				  global $wpdb; 
				  $db_table_name = $wpdb->prefix . 'shortcode';  // table name
				  $charset_collate = $wpdb->get_charset_collate();

				  $sql = "CREATE TABLE $db_table_name (
							  `id` int(11) NOT NULL AUTO_INCREMENT,
							  `shortcode` varchar(250) NOT NULL,
							  `value` varchar(250) NOT NULL,
				  			  PRIMARY KEY (`id`)
				        ) $charset_collate;";

				   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				   dbDelta( $sql );
				   add_option( 'test_db_version', $test_db_version );
				} 

				   //Creates the database table once the plugin is activated.
 				   //end of database table creation. - This works!


	function enqueue(){
		//all our scripts and styles
		wp_enqueue_style('style', plugins_url('/css/style.css', __FILE__));
		wp_enqueue_script('script1', plugins_url('/js/script.js', __FILE__));
		wp_enqueue_script('scripts', plugins_url('js/jquery-3.4.1.min.js', __FILE__));
		wp_enqueue_script('script', plugins_url('/js/thescript.js', __FILE__), array( 'jquery' ));
		wp_localize_script( 'script', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_script('scripts');
	}





	function admin_page(){
	        add_menu_page( 'Shortcodes', 'ShortCode', 'manage_options', 'shortcode-plugin', array($this, 'home') );
	}

	function home(){
		require_once plugin_dir_path(__FILE__) .'admin/admin.php';
	}

	// function for the table loop. 
	function table_loop(){

				 $connect = mysqli_connect("localhost", "root", "", "common_wealth");  
				 $output = '';  
				 $sql = "SELECT * FROM wp_tbl_code ORDER BY id DESC";  
				 $result = mysqli_query($connect, $sql);  

				 
				 $output .= '  
				      <div class="table-responsive">  
				           <table class="form-table"> 
				                <tr> 
				                     <th width="40%"></th>   
				                     <th width="40%"></th>
				                     <th width="40%"></th>   
				                     <th width="10%"></th>  
				                </tr>
				              ';  
				 $rows = mysqli_num_rows($result);

				 if($rows > 0)  
				 {  
				      if($rows > 10)
				      {
				          $delete_records = $rows - 10;
				          $delete_sql = "DELETE FROM code LIMIT $delete_records";
				          mysqli_query($connect, $delete_sql);

				      }
				      $i = 0;
				      while($row = mysqli_fetch_array($result))  //loops and creates a new table for every category created.
				      {  
				           
				           $i++; //increments and generates new id's for the divs. 
				                //shows all category short codes.
				           $output .= " 
				                <tr id='div$i' class='something'>  
				                     <th class='shortcode' data-id1='".$row["id"]."'>".$row["shortcode"]."</th>
				                     <td class='values' data-id2='".$row["id"]."'    contenteditable>".$row["value"]."</td>
				                     <td>
				                        <button id='update' onclick=printContent('div$i')>Print</button>  
				                        <p><i class='small' data-id3='".$row["id"]."' >last code was ".$row["value"]."</i></p>
				                     </td> 
				                </tr> 
				           ";  
				      }  

				      //push new category shortcode to database
				      $output .= '  


				           <tr>   

				                <td id="shortcode" class="shortc" contenteditable placeholder="HI!" ></td>
				                <td><input type="submit" id="submit"></input></td> 
				                <br>
				           </tr>  
				           <br>
				      ';  
				 }  
				 else  
				 {  //very first input box when nothing has been created. 
				      $output .= '
				        <tr>  
				        <td></td>
				                    <td id="shortcode"contenteditable ></td> 
				                    <td><input type="submit" id="submit"></input></td>  
				               </tr>

				         ';  
				 }  
				 $output .= '</table>  
				      </div>';  
				 echo $output;  


	}
//END

// method that handles/loads all the actions
		function actions() {
		add_action('admin_enqueue_scripts', array($this, 'enqueue'));
		add_action('admin_menu', array($this, 'admin_page'));
		register_activation_hook( __FILE__, array($this, 'createTable') );
		add_action('wp_ajax_table_loop', 'table_loop');
		add_action('wp_ajax_nopriv_table_loop', 'table_loop');


	}

}

$yinksplugin = new Shortcodeplugin();
$yinksplugin->actions();
