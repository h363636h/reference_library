<html>
<head>
	<link href="css/button.css" rel="stylesheet">
	<style>
		body{
			border:2px solid #e2b41b;
			margin : 25px;
			background-color : white;
			color :#012874;
			/*text-align :center;*/
			font-family: 'Raleway', sans-serif;
		}
        a{
            word-break : nowrap;
            cursor : hand;
        }
        a:hover{
        color : red;
        }
        p{
            word-break : nowrap;
        }
        select{
            word-break : nowrap;
        }
        input {
            background-color : #FFF3DC;
            color : #01335b;
            border : 1px dotted  #e2b41b;
            border-radius : 5px;
            text-align : center;
            height : 25px;
        }
        div{
        }
    </style>


</head>
<body>
<?php 
include "lib/dbconn.php";

if(isset($_GET['position'])){
    $position= $_GET['position'];
}

if(isset($_GET['path'])){
    $path = $_GET['path'];
}


///// auto complete /////
$auto_sql = "select * from tag";
$auto_result = mysql_query($auto_sql);
$json=array();

while($auto_row = mysql_fetch_array($auto_result)){
	// echo $auto_row['tag'];
  array_push($json,$auto_row['tag']);
  // echo $auto_row['tag'];
}

if($dept == "root"){

	echo("
			<form method='post' action='insert_tag.php?position='root'&path=$path'>
			<br>
			<center><h2>Add Tag</h2></center>
			<br>

			<center>

			<label><b>Tag</b></label>
			</center>
			<input type='text' name='tag' id='tag'><br><br>
			<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'>등록</button>
			<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>

			</form>
		");
}else{
	echo("
			<form method='post' action='insert_tag.php?position=$position&path=$path'>
			<br>
			<center><h2>Add Tag</h2></center>
			<br>
			<label><b>Tag</b></label>
			<input type='text' name='tag' id='tag'><br><br>
			<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'>등록</button>
			<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
			</form>
		");
}
?>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script type="text/javascript">

  $(function() {
    var availableTags = <?php echo json_encode($json); ?>;

    $("#tag").autocomplete({
      source: availableTags,
      delay:100
    });
  });
    </script>
</body>
</html>
