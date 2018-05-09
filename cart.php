<?php
//ini_set('memory_limit', '-1');
//ini_set('max_execution_time',0);

include "lib/dbconn.php";
include "os_chk.php";

session_start();

if(isset($_SESSION['thum'])){
    $cart_arr = $_SESSION['thum'];
}else{
    $cart_arr = null;
}
?>

<!DOCTYPE html>
<html  class="no-js">
<title>image list</title>
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="description" content="Sticky Table Headers Revisited: Creating functional and flexible sticky table headers" />
	<meta name="keywords" content="Sticky Table Headers Revisited" />
	<meta name="author" content="Codrops" />
	<link rel="stylesheet" href="css/cart.css" />
  <link rel="stylesheet" href="css/cart_component.css" />
  <link rel="stylesheet" href="css/cart_normalize.css" />
  <style type="text/css">

  .paging-nav {
    text-align: right;
    padding-top: 2px;
  }

  .paging-nav a {
    margin: auto 1px;
    text-decoration: none;
    display: inline-block;
    padding: 1px 7px;
    background: #C1C1C1;
    color: white;
    border-radius: 3px;
  }

  .paging-nav .selected-page {
    background: #187ed5;
    font-weight: bold;
  }

  .paging-nav,
  #tableData {
    padding-left : 40%;
    margin: 0 auto;
  }
  </style>
  <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
  <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
  <script src="js/jquery-ui.js" type='text/javascript'></script>
  <script type="text/javascript" src="js/paging.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#select_all').on('click',function(){
        if(this.checked){
          $('.checkbox').each(function(){
            this.checked = true;
          });
        }else{
          $('.checkbox').each(function(){
            this.checked = false;
          });
        }
      });
            
      $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
          $('#select_all').prop('checked',true);
        }else{
          $('#select_all').prop('checked',false);
        }
      });

      // $('#tableData').paging({limit:8});
    });
    
    function cart_del(){
     	var checkboxes = document.getElementsByName('files[]');
     	var vals = "";
     	var del_arr = [];
     	for (var i=0, n=checkboxes.length;i<n;i++){
        if(checkboxes[i].checked){
          del_arr.push(checkboxes[i].value);
        }
      }      
      $.ajax({
        type:"post",
        url : "cart_delete.php",
        data : {del_arr : del_arr},
        success : function(data){
          location.reload();                    
        }
      });
    }
    
    function button_onClick() {
      // $(".down").each(function(){
      //   var id = $(this).attr("id");
      //   $("#"+id)[0].click();
      //   alert("완료")

      // })
      a = document.querySelectorAll('.down');
    
      for(var i=0; i<a.length;i++){
      	url = a[i].getAttribute('id');        
        $("#"+url+"")[0].click();
        alert((i+1)+"번째 영상 다운 완료");
         // console.log((i+1)+"번째 영상 다운 완료");
      }

      $.ajax({
      	type:"post",
      	url : "session_out.php",
      	data : {session_val : "session_val"},
      	success : function(data){
      		location.reload();                    
      	}
      });      
    }       
</script>
</head>
<body>
<form name="zips" action="zip.php" method="post">
    <table id="tableData" class="">
    <thead>
    <tr>
 <!--   	<th><input type="checkbox" id="select_all" /></th>-->
    	<th>Image</th>
    	<th>Image Name</th>
    	<th>Delete</th>
      <th>Download</th>
    </tr>
    </thead>
    <tbody>
    	<?php 
    	echo "<br>";
    	echo "<a href='cart_delete.php?all='all'' >Delete All </a> ";
    	echo "<b style='padding-left:80%'>Total : ". count($cart_arr) ."</b>";
    	
    	echo "<br><br>";
    	   if(json_encode($cart_arr) == '[""]'){
    	       echo "저장된 이미지가 없습니다.";
    	   }else{
    	       $id_arr =  join(',',array_map('intval',$cart_arr));
    	       $sql = "select * from img where img_id in ($id_arr)";
    	       $result = mysql_query($sql,$connect);
    	       $cnt = mysql_num_rows($result);
    	       
    	       for($i=0; $i<$cnt; $i++){
    	           $rs = mysql_fetch_array($result);
    	           
                if($user_os == "Linux"){
    	           $full_path = $rs['full_path'];
    	          }else{
    	           $full_path = str_replace('/','\\',$rs['full_path']);
    	          }

    	           echo "<tr>";
//    	           echo "<th><input type='checkbox' name='files[]' id='$full_path' class='checkbox' value='$rs[img_id]'></th>";
    	           echo "<td><img src='thumnail/small_thum/$rs[thumnail]' width = '300px'></td>";
    	           echo "<td>$rs[img_name]</td>";
    	           echo "<td><a href='cart_delete.php?name=$rs[img_id]'>del</a></td>";
    	           echo "<td><a href='$full_path' class='down' id='down_$i' download>download</a></td>";
    	           echo "</tr>";
    	           
    	       }
    	   }
    	?>
    </table>
<center>
<!--		<input type="button" value="Delete" onclick="cart_del()" class='btn btn-primary'> -->
		<input type="button" onclick="button_onClick()" value="Download All" class="btn btn-primary">
		<button type='button' class='btn btn-cancel' onclick='javascript:window.close()'>Close</button>
</center>
</form>
<br>

</body>
</html>
