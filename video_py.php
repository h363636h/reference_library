<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time',0);

if(isset($_GET['start_time'])){
$start_time = $_GET['start_time'];
}

if(isset($_GET['end_time'])){
  $end_time = $_GET['end_time'];
}

if(isset($_GET['img_path'])){
  $img_path = $_GET['img_path'];
}

if(isset($_GET['img_name'])){
  $img_name = str_replace("00000","&",$_GET['img_name']);
}


$start = $start_time/24;
$end = $end_time/24;
$result = $end - $start;

// echo $img_path;
// echo $img_name;

// echo $start;
// echo $result;

$file_name = "(".$start_time."-".$end_time.")";
$img_split = substr($img_name,0,-4);
$ext = substr(strrchr($img_name,"."),1);

$result_filename = $img_split.$file_name.".".$ext;
// echo $img_path.$img_name;

//echo "ffmpeg -i '$img_path$img_name' -ss $start_time -c copy -t $result '$img_name'";

//exec("./ffmpeg-git-20171128-64bit-static/ffmpeg -i '$img_path$img_name' -ss $start_time -t $result -vcodec copy -acodec copy 'interval_video/$result_filename'");
exec("./ffmpeg-git-20171128-64bit-static/ffmpeg -ss $start -t $result -i '$img_path$img_name' -vcodec copy -acodec copy 'interval_video/$result_filename'");

// echo "./ffmpeg-git-20171128-64bit-static/ffmpeg -ss $start -t $result -i '$img_path$img_name' -vcodec copy -acodec copy 'interval_video/$result_filename'";
// echo "./ffmpeg-git-20171128-64bit-static/ffmpeg -i '$img_path$img_name' -ss $start -t $result -vcodec copy -acodec copy 'interval_video/$result_filename'";

echo "<a href='interval_video/$result_filename' download class='down' id='down_1'>down</a>";

?>
<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script type="text/javascript">
  $(document).ready(function(){
    var a = document.querySelectorAll('.down');
    for(var i=0; i<a.length;i++){
      url = a[i].getAttribute('id');
      $("#"+url+"")[0].click();
      alert("다운완료");

    }
    history.go(-1);
  });     

</script>
