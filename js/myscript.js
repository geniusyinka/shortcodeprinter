$(document).ready(function(){  
    function fetch_data()  
    {  
        $.ajax({  
            url:"admin/myselect.php",  
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
            url:"admin/insert.php",  
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
            url:"admin/editCode.php",  
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

