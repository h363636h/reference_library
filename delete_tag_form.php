<?php 

if(isset($_GET['idx'])){
    $idx = $_GET['idx'];
}

if(isset($_GET['path'])){
    $path = $_GET['path'];
}

if(isset($_GET['tag'])){
    $tag = $_GET['tag'];
}
?>
<html>
<head>
	<link href="css/button.css" rel="stylesheet">

    <style>
        body{

            /*background-color : white;*/
            /*color : white;*/
        }
        a{
            color : #00a4d3;
            text-decoration:none;
        }
        a:hover{
            color : white;
        }
        input {
            background-color : #FFF3DC;
            color : #01335b;
            border : 1px dotted  #e2b41b;
            border-radius : 5px;
            text-align : center;
            height : 25px;

        }
        body{
        height : 95px;

        border:2px solid #e2b41b;
        margin : 25px;
        
        background-color : white;
        color :#012874;
        text-align :center;
        font-family: 'Raleway', sans-serif;
}

    </style>

</head>
<body>
<?php 
      echo("
                <center>
                <form name='delete_tag' method='post' action='delete_tag.php?tag=$tag&idx=$idx&path=$path'>
                <BR><label>삭제하시겠습니까?</label><Br><Br>
                                <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-ok'>확인</button>
                                <button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>
                </form>
                </center>
        ");
?>
</body>
</html>
