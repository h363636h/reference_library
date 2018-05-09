<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time',0);

if(isset($_POST['full_path'])){
  $full_path = $_POST['full_path'];
}
if(isset($_POST['path'])){
  $path = $_POST['path'];
}

$full_path = html_entity_decode(preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($full_path)), null, 'UTF-8');	//유니코드 변환


//태그 선택 후, 해당 태그에 해당하는 영상 다운받으려고 하는 경우

// $full_path = str_replace("%20"," ",$full_path);

$split_full_path = split("/",$full_path);
$img_name = array_pop($split_full_path);	//파일명 호출

$split_time = split("#t=",$img_name);	//현재 재생 중인 영상
	$path = dirname($full_path)."/";	//페이지 리로드 시 필요 	
	$interval_time = array_pop($split_time);	//구간만 구하기 위함
	$interval = split(",",$interval_time);	//시작, 끝 시간 구하기 위함

	$start_time = $interval[0];
	$end_time = $interval[1];
if($end_time > 0){

	$result = $end_time - $start_time;

	$ext = substr(strrchr($split_time[0],"."),1);

	$file_name = substr($split_time[0],0,-4)."(".round($start_time*24)."-".round($end_time*24).").".$ext;


	exec("./ffmpeg-git-20171128-64bit-static/ffmpeg -ss $start_time -t $result -i '$path$split_time[0]' -vcodec copy -acodec copy 'interval_video/$file_name'");
	// echo "./ffmpeg-git-20171128-64bit-static/ffmpeg -ss $start_time -t $result -i '$path$split_time[0]' -vcodec copy -acodec copy 'interval_video/$file_name'";
	echo "<a href='interval_video/$file_name' download class='down' id='down_1'>down</a>";

}else{
	// echo "./ffmpeg-git-20171128-64bit-static/ffmpeg -i '$full_path' -vcodec copy -acodec copy 'interval_video/$img_name'";
	exec("./ffmpeg-git-20171128-64bit-static/ffmpeg -i '$full_path' -vcodec copy -acodec copy 'interval_video/$img_name'");
	echo "<a href='interval_video/$img_name' download class='down' id='down_1'>down</a>";
}

// if($end_time > 0){
// 	exec("./ffmpeg-git-20171128-64bit-static/ffmpeg -ss $start_time -t $result -i '$full_path' -vcodec copy -acodec copy 'interval_video/test.mkv'");
// 	// echo "./ffmpeg-git-20171128-64bit-static/ffmpeg -ss $start_time -t $result -i '$split_time[0]' -vcodec copy -acodec copy 'interval_video/$img_name'";

// }else{
// 	echo "./ffmpeg-git-20171128-64bit-static/ffmpeg -i '$full_path' -vcodec copy -acodec copy 'interval_video/$img_name'";
// 	exec("./ffmpeg-git-20171128-64bit-static/ffmpeg -i '$full_path' -vcodec copy -acodec copy 'interval_video/$img_name'");
// }
// echo "./ffmpeg-git-20171128-64bit-static/ffmpeg -i '$full_path' -vcodec copy -acodec copy 'interval_video/$img_name'";


// echo "<a href='interval_video/$img_name' download class='down' id='down_1'>down</a>";
echo "<script>window.reloadDiv('$path');</script>";

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
 		        // alert("다운완료");
 	  }
 	      // history.go(-1);
  });     
</script>
