<!DOCTYPE>
<html>  
    <head>  
        <title>Webslesson Demo - Live Table Add Edit Delete using Ajax Jquery in PHP Mysql</title>  
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  -->
        <link rel="stylesheet" type="text/css" href="css/style.css">
<!--         <link rel="stylesheet" media="print" href="css/print.css" /> -->

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 

        
        
    </head>  
    <body>  
       <div class="container">  
			<div class="table-responsive">  
				<center><h3>ShortCodes for Category</h3><br /></center>
				<span id="result"></span>
				<div id="live_data"></div>
                <br>
                <br>
			</div>
		</div>
</body>
</html>
<script src="js/script.js"></script>
<script> 
$(document).ready(function(){  
    function fetch_data()  
    {  
        $.ajax({  
            url:"myselect.php",  
            method:"POST",  
            success:function(data){  
                $('#live_data').html(data);  
            }  
        });  
    }  
    fetch_data();  
    $(document).on('click', '#submit', function(){  
        var shortcode = $('#shortcode').text();  
        var value = $('#value').text();  
        if(shortcode == '')  
        {  
            alert("Enter ShortCodes");  
            return false;  
        }   
        $.ajax({  
            url:"insert.php",  
            method:"POST",  
            data:{shortcode:shortcode, value:value},  
            dataType:"text",  
            success:function(data)  
            {  
                alert(data);  
                fetch_data();  
            }  
        })  
    });

    function edit_data(id, text, column_name)  
    {  
        $.ajax({  
            url:"editCode.php",  
            method:"POST",  
            data:{id:id, text:text, column_name:column_name},  
            dataType:"text",  
            success:function(data){  
                //alert(data);
                $('#result').html("<div class='alert alert-success'>"+data+"</div>");
            }  
        });  
    }

    $(document).on('blur', '.shortcode', function(){  
        var id = $(this).data("id1");  
        var shortcode = $(this).text();  
        edit_data(id, shortcode, "shortcode");  
    });

    $(document).on('blur', '.values', function(){  
        var id = $(this).data("id2");  
        var value = $(this).text();  
        edit_data(id, value, "value");  
    }); 
    $(document).on('click', '.btn_delete', function(){  
        var id=$(this).data("id3");  
        if(confirm("Are you sure you want to delete this?"))  
        {  
            $.ajax({  
                url:"delete.php",  
                method:"POST",  
                data:{id:id},  
                dataType:"text",  
                success:function(data){  
                    alert(data);  
                    fetch_data();  
                }  
            });  
        }  
    });  

}); 





</script>





