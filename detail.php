<?php 
/*
상세 페이지
구간 등록, 수정, 삭제
태그 삽입
*/

if(isset($_GET['img_name'])){
  $img_name = str_replace("00000","&",$_GET['img_name']);
  // $img_name = $_GET['img_name'];
}
// echo $img_name;
if(isset($_GET['img_id'])){
  $img_id = $_GET['img_id'];
}
// echo $img_id;
if(isset($_GET['img_path'])){
  $img_path = $_GET['img_path'];
}

if(isset($_GET['path'])){
  $path = $_GET['path'];
}

if(isset($_GET['word'])){
  $word = $_GET['word'];
}

// echo $word;
include "lib/dbconn.php";

$select_sql = "select * from img_frame where img_name=\"$img_name\" order by start_frame";
$select_result = mysql_query($select_sql, $connect);
$select_cnt = mysql_num_rows($select_result);
// echo $select_sql;

///// auto complete /////
$auto_sql = "select * from tag";
$auto_result = mysql_query($auto_sql);
$json=array();

while($auto_row = mysql_fetch_array($auto_result)){
  array_push($json,$auto_row['tag']);
  // echo $auto_row['tag'];
}

?>
<html>
<head>
<link href="css/button.css" rel="stylesheet">
<link href="css/tag.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script type="text/javascript">

function update_popup(frame_id,img_name,start_frame,end_frame){
  var popUrl = "update_frame_form.php?frame_id=" + frame_id + "&img_name="+img_name+"&start_frame=" + start_frame + "&end_frame=" +end_frame;
  var popOption = "width=370, height=220,resizable=no, scrollbars=no, status=no;";
  window.open(popUrl,"",popOption);
}

function delete_popup(idx,path,tag){
  var popUrl = "delete_img_form.php?idx=" + idx + "&path=" + path+"&tag="+tag;
  var popOption = "width=370, height=140,resizable=no, scrollbars=no, status=no;";
  window.open(popUrl,"",popOption);
}

function delete_interval_popup(frame_id,path){
  var popUrl = "delete_frame_form.php?frame_id=" + frame_id + "&path="+path;
  var popOption = "width=370, height=140,resizable=no, scrollbars=no, status=no;";
  window.open(popUrl,"",popOption);
}

function allowDrop(ev) {
	ev.preventDefault();
}

function drag(ev) {
	ev.dataTransfer.setData("text", ev.target.id);
}

function dragEnter(event) {
	event.target.style.background="#A8D5FF";
}

function dragLeave(event) {
	event.target.style.background = "#E3EFFF";
	event.target.style.border="";
}

function interval_play(start_frame,end_frame,path,img_name){

	start_frame = start_frame/24;
	end_frame = end_frame/24;
	window.opener.reloadDiv_interval(start_frame,end_frame,path,img_name)
//	window.close()	
}

function interval_word_play(start_frame,end_frame,img_name,word,path){

  start_frame = start_frame/24;
  end_frame = end_frame/24;
  window.opener.location.href="index.php?task=tag&word="+word + "&start_sum=" + start_frame + "&end_sum=" + end_frame + "&img_name=" + img_name + "&path="+path;
  // window.opener.reloadDiv_word_interval(start_frame,end_frame,img_name,word)
//  window.close()  
}

function drop(ev,frame_id,img_id,path) {
	ev.preventDefault();
	var data = ev.dataTransfer.getData("text");
	
	var frame_id = frame_id;
	var img_id = img_id;

	$.ajax({
		url : 'detail_insert_drag_tag.php?img_id='+ img_id + '&frame_id='+frame_id + '&tag=' + data,
		dataType : 'html',
		async : false
	}).success(function(data){
		window.opener.reloadDiv(path)
		window.location.reload();
		return;
	});
}

function video_py(img_path,img_name,start_time,end_time){
  var rep_img_name = img_name.replace("&","00000")
  // img_name
	$.ajax({
		url : "video_py.php?img_path=" + img_path + "&img_name=" + rep_img_name + "&start_time=" + start_time + "&end_time="+end_time,
		dataType:'html'
	}).success(function(data){
		alert(data);
// 		window.location.reload();
// 		return;
	});
}

function submit_interval(){
  var checkboxes = document.getElementsByName('files[]');

  var interval_arr = [];

  for(var i=0, n=checkboxes.length; i<n; i++){
    if(checkboxes[i].checked){
      var val = checkboxes[i].value;
      interval_arr.push(val.split("&&")[0]);
    }
  }
  // alert(interval_arr);

  var nextVideo = interval_arr;
  var videoPlayer = window.opener.document.getElementById('videopos');
  var curVideo = 0;
  videoPlayer.src = nextVideo[curVideo];
  videoPlayer.autoplay = true;
  videoPlayer.load();

  videoPlayer.onpause = function(){

    curVideo = curVideo+1;
    videoPlayer.src = nextVideo[curVideo];
    videoPlayer.autoplay = true;
    videoPlayer.load();
  }  
}

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
  });

  $(function() {
    var availableTags = <?php echo json_encode($json); ?>;

    $("#detail_tag").autocomplete({
      source: availableTags,
      delay:100
    });
  });

  function detail_edit(frame_id,description){
    // alert(frame_id);
    var popUrl = "detail_description_form.php?frame_id=" + frame_id + "&description="+description;
    var popOption = "width=600, height=300,resizable=no, scrollbars=no, status=no;";
    window.open(popUrl,"",popOption);
  }
</script>
<style>
body{
    color : #632424;
    font-family : Avantgarde, TeX Gyre Adventor, URW Gothic L, sans-serif;	
    }
#detail_table {
    border-collapse: collapse;
    width: 100%;
}

#detail_table td, #detail_table th {
    border: 1px solid #ddd;
    padding: 8px;
}

#detail_table tr:nth-child(even){
  background-color: #FFF9F9;
}

#detail_table tr:hover{
  background-color: #EFEFEF;
}

#detail_table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: center;
    background-color: #632424;
    color: white;
}
a#detail{
  color:white;
}
a#detail:hover{
  color:#DB9700;
}

input[type=checkbox]{
  width: 15px;
  height:15px;
  background:white;
  /*visibility:hidden;*/
}
</style>
</head>
<body>
<br>

<?php echo "<center><font size='5'><b>[ $img_name ]</b></font></center>"; ?>

<br><br>
<form name="insert_frame" id="insert_frame" method="post" action="detail_insert_tag.php">
  <table id="detail_table" border="1" width="100%">
    <tr style="text-align:center; height:40px;">
      <th><input type="checkbox" id="select_all"></th>
      <th><b>구간</b></th>
      <th><b>Description</b></th>
      <th><b>태그</b></th>
      <th><b>삭제</b></th>
      <th><b>수정</b></th>
      <th><b>다운로드</b></th>
    </tr>
    
    <?php 
    $full_path= substr($path,5,-1)."/".$img_name;

    for($i=0; $i<$select_cnt; $i++){
        $select_rs = mysql_fetch_array($select_result);
        $start_time = $select_rs['start_frame']/24;
        $end_time = $select_rs['end_frame']/24;
        $interval_info = $full_path."#t=".$start_time.",".$end_time;
        $img_name = $select_rs['img_name'];
        $frame_id = $select_rs['frame_id'];

        $val = $interval_info."&&".$img_name."&&".$frame_id;
        // $arr = array("interval_info"=>$value,"img_id"=>$select_rs['img_id'],"frame_id"=>$select_rs['frame_id']);
        // $test_val =  json_encode($arr);
        // echo $test_val;

        echo "<tr style='height:80px'>
                <th style='width:4%'><input type='checkbox' name='files[]' class='checkbox' value=\"$val\"></th>
                <td style='width:15%'><b>
              ";
        if($word != ""){
          echo "<a href=\"javascript:interval_word_play('$select_rs[start_frame]','$select_rs[end_frame]','$img_name','$word','$img_path')\">";
        }else{
          echo "<a href=\"javascript:interval_play('$select_rs[start_frame]','$select_rs[end_frame]','$img_path','$img_name')\">";
        }
        echo "
                    $select_rs[start_frame] <font size='2' color='#555'>frame</font> ~ $select_rs[end_frame] <font size='2' color='#555'>frame</font>
                  </a>
                </b></td>
                <td style='width:30%'>

                      $select_rs[description]

                    <br>
                  <center><a class='btn btn-detail' href=\"javascript:detail_edit('$select_rs[frame_id]','$select_rs[description]')\">수정 및 등록</a></center>                    
                </td>
                <td><div id=interval_list frame_id='$select_rs[frame_id]' ondrop=\"drop(event,'$select_rs[frame_id]','$img_id','$path')\" ondragover='allowDrop(event)' style='height:80px;'>
        ";

        $frame_sql = "select * from img_tag where frame_id='$select_rs[frame_id]' and img_id='$img_id'";
        // echo $frame_sql;
        $frame_result = mysql_query($frame_sql,$connect);
        $frame_cnt = mysql_num_rows($frame_result);
        
        for($i2=0; $i2<$frame_cnt; $i2++){
            $frame_rs = mysql_fetch_array($frame_result);
            echo "<div class='tag'>
                    <a style='float:left; color:#705D30;'><b>".$frame_rs['tag'] ."</b></a>
                    <a href=\"javascript:delete_popup('$frame_rs[idx]','$path','$frame_rs[tag]')\" style='float:left;'><b style='color:#632424'>&nbsp; x </b></a>
                  </div>";
        }
        echo "</div>
                </td>
                <td style='width:3%'><a class='btn btn-detail' onclick=\"delete_interval_popup('$select_rs[frame_id]','$path')\">삭제</a></td>
                <td style='width:3%'><a class='btn btn-detail' onclick=\"update_popup('$select_rs[frame_id]','$select_rs[img_name]','$select_rs[start_frame]','$select_rs[end_frame]')\">수정</a></td>
                <td style='width:3%'><a class='btn btn-detail' href=\"video_py.php?img_path=$img_path&img_name=$img_name&start_time=$select_rs[start_frame]&end_time=$select_rs[end_frame]\" id='detail'>다운로드</a></td>
              </tr>";
    }   
    ?>
    <tr style='height:80px'>
      <th></th>
      <td><input type="text" name="start_frame" value="" style="width:45px" id="start_frame"><b><font size='2'> frame ~ <input type="text" name="end_frame" value="" style="width:45px" id="end_frame"> frame</b></td>
      <td colspan="5" align="center"><input type="submit" value="등록" class='btn btn-primary'></td>
    </tr>
  </table>
  <br>
  
  <input type="hidden" name="img_path" value="<?php echo $img_path?>">
  <input type="hidden" name="img_name" value="<?php echo $img_name?>">
  <input type="hidden" name="img_id" value="<?php echo $img_id?>">
  <input type="hidden" name="path" value="<?php echo $path?>">

  <label><b>Tag :</b></label> &nbsp;&nbsp;<input type="text" name="detail_tag" id="detail_tag">&nbsp;&nbsp;<input type="submit" value="태그 등록" class="btn btn-detail_insert">
</form>

<button onclick="javascript:submit_interval()" style="margin-left:45%" class='btn btn-primary'>재생</button>
<button type='button' class='btn btn-primary' onclick='javascript:window.close()'><span class='glyphicon glyphicon-remove'></span>취소</button>

</body>
</html>