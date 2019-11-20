<?php  
 $connect = mysqli_connect("localhost", "root", "", "common_wealth");  
 $output = '';  
 $sql = "SELECT * FROM tbl_sample ORDER BY id DESC";  
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
 ?>