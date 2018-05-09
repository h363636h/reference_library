<?php
header('content-type:text/html;charset=utf-8');
include "lib/dbconn.php";

mysql_query("set session character_set_client=utf8");
mysql_query("set session character_set_connection=utf8");
mysql_query("set session character_set_results=utf8");

if(isset($_GET['path'])){
    $path = $_GET['path'];
    $path_view = substr($path,5,-1);
}else{
    $path = null;
}

if(isset($_POST['path'])){
    $path = $_POST['path'];
    $path_view = substr($path,5,-1);
}else{
    $post_path = null;
}

if(isset($_POST['full_path'])){

    $get_path = $_POST['full_path'];

}else if(isset($_GET['full_path'])){

	$get_path = $_GET['full_path'];

}
else{
    $get_path = null;
}


if(isset($_GET['interval_full_path'])){
	$interval_full_path = $_GET['interval_full_path'];
	// echo $interval_full_path;
}else{
	$interval_full_path = null;
}

if(isset($_GET['word'])){
    $word = $_GET['word'];
}

// echo $word;
if(isset($_GET['tag_name'])){
    $tag_name = $_GET['tag_name'];
    echo $tag_name;
}

if(isset($_GET['task'])){
	$task = $_GET['task'];
}

if(isset($_GET['start_sum'])){
    $start_sum = $_GET['start_sum'];
    // echo "start => ".$start_sum;
}
if(isset($_GET['end_sum'])){
    $end_sum = $_GET['end_sum'];
    // echo "end => ".$end_sum;
}

if(isset($_GET['img_name'])){
    $img_name = $_GET['img_name'];
}

///// auto complete => index/////
$auto_sql = "select * from tag";
$auto_result = mysql_query($auto_sql);
$json=array();

while($auto_row = mysql_fetch_array($auto_result)){
	array_push($json,$auto_row['tag']);

}
//////////////////////////

///// auto complete => main/////
$auto_sql2 = "select * from tag";
$auto_result2 = mysql_query($auto_sql2);
$main_json=array();

while($auto_row2 = mysql_fetch_array($auto_result2)){
    array_push($main_json,$auto_row2['tag']);

}
//////////////////////////

if(isset($tag_name)){
    
    $img_sql= "select *
		from tag t
		inner join img_tag it
		on t.tag = it.tag
		inner join img i
		on it.img_id = i.img_id
		where t.tag ='$tag_name' and  img_path =\"$path\" group by i.img_id order by t.tag";
    
}else if(isset($task) && $task=="tag" && isset($word)){

    $img_sql= "select *
		from tag t
		inner join img_tag it
		on t.tag = it.tag
		inner join img i
		on it.img_id = i.img_id
		where t.tag ='$word' group by i.img_id order by t.tag";
        
}else if(isset($task) && $task=="filename" && isset($word)){

    $img_sql= "select *	from img where img_name like '%$word%' order by img_name";

}else if(isset($task) && $task =="all"){

	$search_sql = "select *
		from tag t
		inner join img_tag it
		on t.tag = it.tag
		inner join img i
		on it.img_id = i.img_id
		where t.tag ='$word' group by i.img_id order by t.tag";
	$search_result = mysql_query($search_sql,$connect);
	$search_rowcnt = mysql_num_rows($search_result);

	if($search_rowcnt == 0){
		$img_sql= "select *	from img where img_name like '%$word%' order by img_name";
	}else{
		$img_sql = "select *
		from tag t
		inner join img_tag it
		on t.tag = it.tag
		inner join img i
		on it.img_id = i.img_id
		where t.tag ='$word' group by i.img_id order by t.tag";
	}
} else if(isset($task) && $task =="description" && isset($word)){
    $img_sql = "select * from img_frame i_f inner join img i on i_f.img_name = i.img_name where description like '%$word%'";
} else{
    $img_sql = "select * from img where img_path=\"$path\"  order by img_name";
}
// echo $img_sql;
$img_result = mysql_query($img_sql, $connect);
$img_rowcnt = mysql_num_rows($img_result);

//////실제 경로와 db에 저장된 데이터가 일치 하지 않을 경우 update 버튼 보이도록 하기 위함(db 업데이트 필요)//////
if(isset($path)){
$handle  = opendir($path);
    $files = array();
   
    // 디렉터리에 포함된 파일을 저장한다.
    while (false !== ($filename = readdir($handle))) {
        if($filename == "." || $filename == ".."){
            continue;
        }
    
        // 파일인 경우만 목록에 추가한다.
        if(is_file($path . "/" . $filename)){
            $files[] = $filename;
        }
    }
    
    // 핸들 해제
    closedir($handle);
    
    // 정렬, 역순으로 정렬하려면 rsort 사용
    sort($files);
    $dir_img_array = array();
    // 파일명을 출력한다.
    foreach ($files as $file) {
        $ext = pathinfo($file,PATHINFO_EXTENSION);
        if($ext =="avi" || $ext == "AVI" || $ext == "mkv" || $ext == "MKV" || $ext == "mp4" || $ext == "MP4" || $ext == "mov" || $ext == "MOV" || $ext == "JPG" || $ext =="jpg" || $ext =="png" || $ext == "PNG" || $ext == "webm" || $ext == "WEBM" || $ext == "flv" || $ext == "FLV" || $ext == "tga" || $ext == "TGA" || $ext == "tif" || $ext == "dpx" || $ext == "hdr" || $ext == "psd" || $ext == "PSD" ||$ext == "cin" || $ext == "exr" || $ext == "EXR" ||$ext == "jpeg" || $ext == "JPEG" || $ext == "ARW"){
            array_push($dir_img_array, array_pop(explode('/', $file)));
        }
    }
    $db_img_array = array();
    
    while ($img_row = mysql_fetch_array($img_result)) {
        array_push($db_img_array, array_pop(explode('/',$img_row['img_name'])));
    }
        
    $img_in = array_diff($dir_img_array, $db_img_array);
    $dir_size =  sizeof($dir_img_array);
    $db_size = sizeof($db_img_array);

    // echo json_encode($dir_img_array)."<br>";
    // echo json_encode($db_img_array)."<br>";
    // echo json_encode($img_in)."<br>";
}   

?>

<?php if(isset($path) || isset($word)){?>

<div id="img">
	<div class="clear"></div>
	        <?php
	        header('content-type:text/html;charset=utf-8');
	        include "os_chk.php";

	        if($user_os == "Linux"){
	        	echo "<font size='4' style='color : #6E6F70; padding-left:0%'><b> Path&nbsp;&nbsp; : &nbsp;&nbsp;</b>". $path_view ."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	        	if(isset($word)){
					
	        	}else{

		        	if($dir_size != $db_size ){
		        	    echo"<input type='button' onclick=\"submit_py('$path')\" value='UPDATE' class='update' >";
		        	}else if(json_encode($img_in) !="[]"){
		        		echo"<input type='button' onclick=\"submit_py(\"$path\")\" value='UPDATE' class='update' >";
		        	}else{

		        	}
	        	}

	        	if(isset($get_path)){
	        	    echo "<br><br><font size='4' style='color : #6E6F70; padding-left:0%'><b> Image Full Path </font>&nbsp;&nbsp;:&nbsp;&nbsp;</b><input type='text' value=\"$get_path\" id='copy' style='width:80%;height:30px; background-color:#FFEEEE; color : #632424; font-size:18px;'> &nbsp;&nbsp;<button class='clipboard btn btn-primary' data-clipboard-target='#copy'>copy</button>";
	        	}

	        }else{	            
	        	$win_path = str_replace('/', '\\', $path_view);
	        	$win_get_path = str_replace('/','\\',$get_path);
                $path = str_replace("'","00000", $path);
	        	
	        	if(isset($word)){
					
	        	}else{
					echo "<font size='4' style='color : #6E6F70; padding-left:0%'><b> Path&nbsp;&nbsp; : &nbsp;&nbsp;</b>". $win_path ."</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		        	if($dir_size != $db_size ){
		        		echo"<input type='button' onclick=\"submit_py('$path')\" value='UPDATE' class='update' >";
		        	}else if(json_encode($img_in) !="[]"){
		        		echo"<input type='button' onclick=\"submit_py('$path')\" value='UPDATE' class='update' >";
		        	} else{}
	        	}

		        if(isset($get_path)){
	        	    echo "<br><br><font size='4' style='color : #6E6F70; padding-left:0%'><b> Image Full Path </font>&nbsp;&nbsp;:&nbsp;&nbsp;</b><input type='text' value=\"$win_get_path\" id='copy' style='width:80%;height:30px; background-color:#FFEEEE; color : #632424; font-size:18px;'> &nbsp;&nbsp;<button class='clipboard btn btn-primary' data-clipboard-target='#copy'>copy</button>";
	        	}
	    	}
	        ?>

        	<br><br>   
    		<?php if(isset($get_path)){
    		    echo "<video width=98% id='videopos' controls style='border:1px solid #BD9798' autoplay loop>";
    		    echo "<source src=\"$get_path\">";
    		}else if(isset($start_sum)){
    		    echo "<video width=98% id='videopos' controls style='border:1px solid #BD9798' autoplay loop>";
    		    if(isset($interval_full_path)){
    		    	echo "<source src='$interval_full_path#t=$start_sum,$end_sum'>";
    		    }else{
    		    	echo "<source src='$path_view/$img_name#t=$start_sum,$end_sum'>";
    		    }
    		}else{
    		    echo "<video width=98% id='videopos' controls style='border:1px solid #BD9798' autoplay loop>";
        		    echo "<source src=''>";
    		}
    		?>
    		</video>
        		<table width="98%" height="30px" style="text-align:center;border:2px solid #DC9B9B;">
        			<tr>
        				<td style="padding:7px"><font color="#5D2122" size="3"><b><?php echo $get_path?></b></font></td>
        			</tr>
        			<tr>
            			<td style="padding:7px"><input type="button" value="pause" id="pauseBtn" />
							<button id="speed-3" class="btn btn-primary" name="speed-3">x(-3)</button>
							<button id="speed-2" class="btn btn-primary" name="speed-2">x(-2)</button>

            				<button id="rew" onclick="skip(-0.2)" class="btn btn-primary">-5</button>
            				<button id="rew" onclick="skip(-0.04)" class="btn btn-primary">-1</button>

                            <span id="currentFrame" style="color:#632424;font-weight: bold;">Frame : <b>0</b></span>
                 			<button id="fastFwd" onclick="skip(0.04)" class="btn btn-primary">+1</button>
                 			<button id="fastFwd" onclick="skip(0.2)" class="btn btn-primary">+5</button>            
                 			<button id="speed2" class="btn btn-primary">x2</button>
                 			<button id="speed3" class="btn btn-primary">x3</button>
							<br><br>
                 			<button onclick="get_start_frame()" class="btn btn-detail_insert">Get start frame</button> &nbsp;
                            <button onclick="get_end_frame()" class="btn btn-detail_insert">Get end frame</button>		
          				</td>
      				</tr>
        		</table>
			<div class="clear"></div><br>
    		<b style='color : #8F8D8C; font-size:17px;'> Total : <?php echo $img_rowcnt; ?></b>      
	            <form id="tag_search_form2" action="javascript:form_submit('<?php echo $path?>')" style="margin-left:80%">
            		<label>
            			<font size='2.5' style='color : #918F90; padding-left:0%'><b>TAG NAME &nbsp; </b></font>
            				<input type="text"  id="tag_search_text">
                            <!-- <input type="text"  id="main_tag_search"> -->
            				<input type="submit" value="검색" id="tag_search_form">
            		</label>
        		</form>  	
	        <button class="btn btn-primary"><label><input type="checkbox" id="select_all" name="select_all"/><span class='glyphicon glyphicon-ok'></span></button><br>
	        <font style="color:#8F8D8C"><b style='font-size:15px'>Select All</b></font></label>    
    		<button id="insert" class="btn btn-primary" style="margin-left:80%"><span class='glyphicon glyphicon-plus'></span><br>
    			<font style="color:#8F8D8C">Insert</font>
    		</button>
    		<button id="cart" class="btn btn-primary"><span class='glyphicon glyphicon-shopping-cart'></span><br><font style="color:#8F8D8C">Cart</font></button>
            <button id="download" class="btn btn-primary" onclick="now_playing('<?php echo $path; ?>')"><span class='glyphicon glyphicon-download-alt'></span><br><font style="color:#8F8D8C">Download</font></button>

    		<div class="clear"></div>
    		<br><br>
			<ul class="grid effect-3" id="grid">
			<?php

            if( json_encode($db_img_array) == "[]"){
                echo "<font color='#01335b;'> 데이터가 없습니다</font>";
            }else {
                $img_result2 = mysql_query($img_sql, $connect);
                for($i=0; $i<$img_rowcnt; $i++){
                    $img_rs = mysql_fetch_array($img_result2);
                    $img_path = array_pop(explode('/',$img_rs['full_path']));

                    // $img_name = addslashes($img_rs['img_name']);
                    $img_full_path = addslashes($img_rs['full_path']);

                    if($img_rs['type'] == 'img'){
                        
                        if($user_os == "Linux"){    //os 별 rv 경로 처리
                            
                            $rv=str_replace(" ","%20","rvlink:// '/".$img_rs['full_path']."'");
                            
                        }else{
                            
                            $rv=str_replace(" ","%20","rvlink:// '//reference".$img_rs['full_path']."'");                            
                        
                        }
                        if(isset($word)){
                            echo("

                                <li style='width:24%' id='img' name='cart[]' img_name='$img_rs[img_name]' img_id='$img_rs[img_id]' ondrop=\"drop(event,'$path','$img_rs[img_id]')\" ondragover='allowDrop(event)'>
                                <label>
                                    <input type='checkbox' name='images[]' class='checkbox' value='$img_rs[img_id]'>                           
                                <a href=\"$rv\" onclick=\"word_get_path('$img_full_path','$task','$word')\"><img src='thumnail/small_thum/$img_rs[thumnail]' width=100%></a>  <br>
                                <center><font color='red' style='float:left'><b>[IMG]</b></font><a href=\"$rv\" onclick=\"word_get_path('$img_full_path','$task','$word')\" style='width:300px;font-size:14px; font-color : #8A8A8A ;margin-top:-5px; padding-bottom:15px; word-break:break-all;'><b>$img_path</b></a></center>
                                <hr style='border : 1px double #c1c1c1;'><br>
                            ");
                        }else{
                            echo("
                                
                            <li style='width:24%' id='img' name='cart[]' img_name='$img_rs[img_name]' img_id='$img_rs[img_id]' ondrop=\"drop(event,'$path','$img_rs[img_id]')\" ondragover='allowDrop(event)'>
                                <label> 
                                    <input type='checkbox' name='images[]' class='checkbox'  value='$img_rs[img_id]'/> 
                                    <a href=\"$rv\" onclick=\"get_path('$path','$img_full_path')\">
                                        <img src='thumnail/small_thum/$img_rs[thumnail]' width=100% >
                                    </a><br>
                                    <center><font color='red' style='float:left'><b>[IMG]</b></font>
                                        <a href=\"$rv\" onclick=\"get_path('$path','$img_full_path')\" style='width:300px;font-size:14px; font-color : #8A8A8A ;margin-top:-5px; padding-bottom:15px; word-break:break-all;'>
                                            <b>$img_path</b>
                                        </a>
                                    </center>                                      
                            <hr style='border : 1px double #c1c1c1;'><br>                                       
                            ");
                        }

                        $tag_img_sql = "select i.img_id as img_id, t.tag as tag
                                                                from tag t
                                                                inner join img_tag it
                                                                on t.tag = it.tag
                                                                inner join img i
                                                                on it.img_id = i.img_id
                                                                where full_path = '$img_rs[full_path]' group by t.tag order by t.tag";

                        $tag_img_result = mysql_query($tag_img_sql,$connect);
                        $tag_img_cnt = mysql_num_rows($tag_img_result);
                                
                        for($i2 = 0; $i2 < $tag_img_cnt; $i2++){

                            $tag_img_rs = mysql_fetch_array($tag_img_result);                            
                            echo ("<div class='main_tag'>
                                    <a href=\"javascript:tag_search('$path','$tag_img_rs[tag]')\" style='float:left'><b>$tag_img_rs[tag]</b></a>
                                    <a href=\"javascript:delete_img_popup('$img_rs[img_id]','$tag_img_rs[tag]','$path')\" style='float:left'>&nbsp; x</a> 
                                    </div>");
                        }
                        echo("</label></li>");

                    }else{
                        
                        $frame= exec("./ffmpeg -i \"/DATA/$img_rs[full_path]\" 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");

                        $hour = explode(":",$frame)[0]*60*60;
                        $min = explode(":",$frame)[1]*60;
                        $sec = explode(":",$frame)[2];

                        $total_sec = $hour + $min + $sec;

                        $img_name = addslashes($img_rs['img_name']);
                        // echo $img_sql;

                        echo("


                        <li style='width:24%;' id='img' name='cart[]' img_name='$img_rs[img_name]' img_id='$img_rs[img_id]' ondrop=\"vid_drop(event,'$path','$img_rs[img_id]','$img_name','$total_sec')\" ondragover='allowDrop(event)'>
                            <label> 
                               <input type='checkbox' name='images[]' class='checkbox'  value='$img_rs[img_id]'/>
                                <a href = \"javascript:get_path('$path','$img_full_path')\">
                                <img src='thumnail/small_thum/$img_rs[thumnail]' class='trigger' id=\"$img_rs[full_path]\" width=100%></a>

                                 <a href = \"javascript:detail('$img_rs[img_id]','$img_name','$img_rs[img_path]','$path','$word')\">pop up</a>
                                ");
                                if(isset($word)){
                                    echo "
                                        <center><br>
                                        <b><font size='2' color='#17355C'><a href = \"javascript:word_get_path('$img_full_path','$task','$word')\" style='word-break:break-all;'>$img_path</a></font></b><br><br>
                                        <hr style='color:#E9C9C9'>
                                         </center>
                                    ";
                                }else{
                                    echo "
                                        <center><br>
                                        <b><a href = \"javascript:get_path('$path','$img_full_path')\" style='word-break:break-all;'>$img_path</a></b><br>
                                        <hr style='color:#E9C9C9'>
                                         </center>
                                    ";
                                }
                                    $tag_sql = "select distinct(tag) from img_frame join img_tag on img_frame.frame_id = img_tag.frame_id where img_name = \"$img_rs[img_name]\"";                                    
                                    $tag_result = mysql_query($tag_sql,$connect);

                                    while($row = mysql_fetch_array($tag_result)){

                                        $interval_sql = "select group_concat(interval_time separator '/')as interval_time,tag from img_frame join img_tag on img_frame.frame_id = img_tag.frame_id where tag='$row[tag]' and img_id=\"$img_rs[img_id]\" group by tag order by interval_time";
                                        $interval_result = mysql_query($interval_sql,$connect);
                                        $interval_cnt = mysql_num_rows($interval_result);

                                        for($i2=0; $i2<$interval_cnt; $i2++){

                                            $interval_rs = mysql_fetch_array($interval_result);
                                            $interval_list = [];
                                            $array = explode("/",$interval_rs['interval_time']);

                                            foreach ($array as $value) {
                                                $img_full_path = stripslashes($img_full_path);
                                                $interval_word = $img_full_path."#t=".$value;
                                                array_push($interval_list,$interval_word);                     
                                            }

                                            $encode = implode("!!",$interval_list);

                                            echo "<div class='main_tag'>
                                                    <b><p>
                                                        <a href=\"javascript:list('$encode')\" class='trigger' id=\"$encode\">".$interval_rs['tag']."</a>
                                                    </b></p></div>
                                                ";
                                        }


                                        $interval_all_sql = "select * from img_frame join img_tag on img_frame.frame_id=img_tag.frame_id where tag='$row[tag]' and img_id=\"$img_rs[img_id]\" order by interval_time";
                                        $interval_all_result = mysql_query($interval_all_sql,$connect);
                                        $interval_all_cnt = mysql_num_rows($interval_all_result);

                                        if($interval_all_cnt == 1){

                                        }else{

                                            for($i3=0; $i3<$interval_all_cnt; $i3++){
                                                $num = $i3+1;
                                                $interval_all_rs = mysql_fetch_array($interval_all_result);
                                                $interval_list = [];
                                                // $img_full_path = addslashes($img_rs['full_path']);
                                                // echo $img_full_path;

                                                // $img_full_path = stripslashes($img_full_path);

                                                $interval_all_word = $img_full_path."#t=".$interval_all_rs['interval_time'];
                                                array_push($interval_list,$interval_all_word);
                                                $encode = implode("!!",$interval_list);

                                                echo "<div class='main_tag'><p><b><a href=\"javascript:list('$encode')\" class='trigger' id=\"$encode\">"."#".$num."</a></b></p></div>";
                                            }
                                        }
                                    }
                                echo("</label></li>");          
                    }         
                }
            }
            echo "<div id='pop-up'><p><video width='100%' id='popup_vid'></video></p></div>";
            echo "<br><br><br>";

?>
	</ul>
	</form>
</div>

<div class="wrap-loading display-none">
    <div><img src="./images/loading.gif" /></div>
</div>  


<!------  태그 트리  ------>

<div id="floatMenu">
<h1><font style="color:black" ><center>TAG LIST</center></font></h1>

<?php
include "lib/dbconn.php";

$dept_sql = "select * from tag_dept where parent_id like '0%'order by tag";
$dept_result = mysql_query($dept_sql);
$dept_cnt = mysql_num_rows($dept_result);
echo("
			<div id='sidetree'>
				<div class='treeheader'>&nbsp;</div>
				<div id='sidetreecontrol' style='font-size:10px;padding-left : 58%;'><a href='?#'><b>CLOSE</a> | <a href='?#'>OPEN</a></b></div>
				<br>
				<ul id='tree'>
				&nbsp;
                <div class='root_drop' ondrop=\"tag_root_drop(event,this,'$path','$dept_rs[tag]','root')\" ondragover='allowDrop(event)' style='width : 100%;height:30px;'>
                    <a onclick=\"add_cate_tag('root','$path')\" ><b>+</b></a>
                </div>
");	//root 추가
for($i=0; $i<$dept_cnt; $i++){
		$dept_rs = mysql_fetch_array($dept_result);
		$cnt_sql = "select * from img_tag where tag='$dept_rs[tag]'";
        // echo $cnt_sql;
		$cnt_result = mysql_query($cnt_sql,$connect);
		$cnt = mysql_num_rows($cnt_result);
		echo "<li class='dept' id='$dept_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept_rs[tag]')\" ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
					<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept_rs[idx]','$path','$dept_rs[tag]')\" width=10 height=10>
					<b><span class='tag_edit' idx='$dept_rs[idx]' path='$path' tag='$dept_rs[tag]'>$dept_rs[tag] </span><a href='index.php?task=tag&word=$dept_rs[tag]' style='color:#973738; size=2'>($cnt)</a></b>
					<a onclick=\"add_cate_tag('$dept_rs[position]','$path')\">+</a>
				";
		//start
		$dept2_sql = "select * from tag_dept where parent_id='$dept_rs[position]' order by tag";	//dept2까지 존재 & tag O
		$dept2_result = mysql_query($dept2_sql);
		$dept2_cnt = mysql_num_rows($dept2_result);
		
		echo("<ul>");
		for($i2=0; $i2<$dept2_cnt; $i2++){
			$dept2_rs = mysql_fetch_array($dept2_result);
			$cnt_sql2 = "select * from img_tag where tag='$dept2_rs[tag]'";
			$cnt_result2 = mysql_query($cnt_sql2,$connect);
			$cnt2 = mysql_num_rows($cnt_result2);
			
			echo "<li class='dept'  id='$dept2_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept2_rs[tag]')\" ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
					<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept2_rs[idx]','$path','$dept2_rs[tag]')\" width=10 height=10>
					<b><span class='tag_edit' idx='$dept2_rs[idx]' path='$path' tag='$dept2_rs[tag]'>$dept2_rs[tag] </span><a href='index.php?task=tag&word=$dept2_rs[tag]' style='color:#973738; size=2'>($cnt2)</a></b>
					<a onclick=\"add_cate_tag('$dept2_rs[position]','$path')\">+</a>
					";		//dept2 출력
			
			//3start
			$dept3_sql = "select * from tag_dept where parent_id='$dept2_rs[position]' order by tag";//dept3까지 존재 & tag O
			$dept3_result = mysql_query($dept3_sql);
			$dept3_cnt = mysql_num_rows($dept3_result);
			
			echo("<ul>");
			
			for($i3=0; $i3<$dept3_cnt; $i3++){
				$dept3_rs = mysql_fetch_array($dept3_result);
				
				$cnt_sql3 = "select * from img_tag where tag='$dept3_rs[tag]'";
				$cnt_result3 = mysql_query($cnt_sql3,$connect);
				$cnt3 = mysql_num_rows($cnt_result3);
				
				echo "<li class='dept' id='$dept3_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept3_rs[tag]')\" ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
							<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept3_rs[idx]','$path','$dept3_rs[tag]')\" width=10 height=10>
							<b><span class='tag_edit' idx='$dept3_rs[idx]' path='$path' tag='$dept3_rs[tag]'>$dept3_rs[tag]</span><a href='index.php?task=tag&word=$dept3_rs[tag]' style='color:#973738; size=2'>($cnt3)</a></b>
							<a onclick=\"add_cate_tag('$dept3_rs[position]','$path')\">+</a>
						";	//dept3 출력
				
				//4start
				$dept4_sql = "select * from tag_dept where parent_id='$dept3_rs[position]' order by tag";
				$dept4_result = mysql_query($dept4_sql);
				$dept4_cnt = mysql_num_rows($dept4_result);
				
				echo "<ul>";
				
				for($i5=0; $i5<$dept4_cnt; $i5++){
					$dept4_rs = mysql_fetch_array($dept4_result);
					
					$cnt_sql4 = "select * from img_tag where tag='$dept4_rs[tag]'";
					$cnt_result4 = mysql_query($cnt_sql4,$connect);
					$cnt4 = mysql_num_rows($cnt_result4);
					
					echo "<li class='dept' id='$dept4_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept4_rs[tag]')\" ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
								<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept4_rs[idx]','$path','$dept4_rs[tag]')\" width=10 height=10>
								<b><span class='tag_edit' idx='$dept4_rs[idx]' path='$path' tag='$dept4_rs[tag]' >$dept4_rs[tag] </span><a href='index.php?task=tag&word=$dept4_rs[tag]' style='color:#973738; size=2'>($cnt4)</a></b>
								<a onclick=\"add_cate_tag('$dept4_rs[position]','$path')\">+</a>
							";	//dep4 출력
					
					//5 start
					$dept5_sql = "select * from tag_dept where parent_id='$dept4_rs[position]' order by tag";	//dept3까지 존재 & tag O
					$dept5_result = mysql_query($dept5_sql);
					$dept5_cnt = mysql_num_rows($dept5_result);
					
					echo "<ul>";
					
					for($i6=0; $i6<$dept5_cnt; $i6++){
						$dept5_rs = mysql_fetch_array($dept5_result);
						
						$cnt_sql5 = "select * from img_tag where tag='$dept5_rs[tag]'";
						$cnt_result5 = mysql_query($cnt_sql5,$connect);
						$cnt5 = mysql_num_rows($cnt_result5);
						
						echo "<li class='dept' id='$dept5_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept5_rs[tag]')\" ondragover='allowDrop(event)' ondragenter='dragEnter(event)' ondragleave='dragLeave(event)'>
									<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept5_rs[idx]','$path','$dept5_rs[tag]')\" width=10 height=10>
									<b><span class='tag_edit' idx='$dept5_rs[idx]' path='$path' tag='$dept5_rs[tag]' >$dept5_rs[tag] </span><a href='index.php?task=tag&word=$dept5_rs[tag]' style='color:#973738; size=2'>($cnt5)</a></b>
									<a onclick=\"add_cate_tag('$dept5_rs[position]','$path')\">+</a>
						";	//dept5 출력
						
						//6 start
						
						$dept6_sql = "select * from tag_dept where parent_id='$dept5_rs[position]' order by tag";	
						$dept6_result = mysql_query($dept6_sql);
						$dept6_cnt = mysql_num_rows($dept6_result);
						
						echo "<ul>";
						
						for($i8=0; $i8<$dept6_cnt; $i8++){
							$dept6_rs = mysql_fetch_array($dept6_result);
							
							$cnt_sql6 = "select * from img_tag where tag='$dept6_rs[tag]'";
							$cnt_result6 = mysql_query($cnt_sql6,$connect);
							$cnt6 = mysql_num_rows($cnt_result6);
							
							echo "<li class='dept' id='$dept6_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept6_rs[tag]')\" ondragover='allowDrop(event)'>
										<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept6_rs[idx]','$path','$dept6_rs[tag]')\" width=10 height=10>
										<b><span class='tag_edit' idx='$dept6_rs[idx]' path='$path' tag='$dept6_rs[tag]'>$dept6_rs[tag] </span><a href='index.php?task=tag&word=$dept6_rs[tag]' style='color:#973738; size=2'>($cnt6)</a></b>
										<a onclick=\"add_cate_tag('$dept6_rs[position]','$path')\">+</a>
							";	//dept6 출력
							
							//7 start
							
							$dept7_sql = "select * from tag_dept where parent_id='$dept6_rs[position]' order by tag";
							$dept7_result = mysql_query($dept7_sql);
							$dept7_cnt = mysql_num_rows($dept7_result);
							
							echo "<ul>";
							for($i10=0; $i10<$dept7_cnt; $i10++){
								$dept7_rs = mysql_fetch_array($dept7_result);
								
								$cnt_sql7 = "select * from img_tag where tag='$dept7_rs[tag]'";
								$cnt_result7 = mysql_query($cnt_sql7,$connect);
								$cnt7 = mysql_num_rows($cnt_result7);
								
								echo "<li class='dept' id='$dept7_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept7_rs[tag]')\" ondragover='allowDrop(event)'>
								<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept7_rs[idx]','$path','$dept7_rs[tag]')\" width=10 height=10>
								<b><span class='tag_edit' idx='$dept7_rs[idx]' path='$path' dept='$dept7_rs[tag]'>$dept7_rs[tag] </span><a href='index.php?task=tag&word=$dept7_rs[tag]' style='color:#973738; size=2'>($cnt7)</a></b>
								<a onclick=\"add_cate_tag('$dept7_rs[position]','$path')\">+</a>
								";	//dept7 출력
								
								//8 start
								$dept8_sql = "select * from tag_dept where parent_id='$dept7_rs[position]' order by tag";
								$dept8_result = mysql_query($dept8_sql);
								$dept8_cnt = mysql_num_rows($dept8_result);
								
								echo "<ul>";
								for ($i11=0; $i11<$dept8_cnt; $i11++){
									$dept8_rs = mysql_fetch_array($dept8_result);
									
									$cnt_sql8 = "select * from img_tag where tag='$dept8_rs[tag]'";
									$cnt_result8 = mysql_query($cnt_sql8,$connect);
									$cnt8 = mysql_num_rows($cnt_result8);
									
									echo "<li class='dept' id='$dept8_rs[tag]' draggable='true' ondragstart='drag(event)' ondrop=\"tag_drop(event,this,'$path','$dept8_rs[tag]')\" ondragover='allowDrop(event)'>
									<input class='delete' type='image' src='img/delete.png'  value='Delete' onclick=\"delete_tag_popup('$dept8_rs[idx]','$path','$dept8_rs[dept8]')\" width=10 height=10>
									<b><span class='tag_edit' idx='$dept8_rs[idx]' path='$path' dept='$dept8_rs[tag]'>$dept8_rs[tag] </span><a href='index.php?task=tag&word=$dept8_rs[tag]' style='color:#973738; size=2'>($cnt8)</a></b>
									";	//dept8 출력
								}	//8 end
								echo "</ul>";
								echo "</li>";
							}	//7 end
							echo "</ul>";
							echo "</li>";
						}// 6 end
						echo "</ul>";						
						echo "</li>";
					} //5 end
					echo "</ul>";
					echo "</li>";
				} //4 end
				echo "</ul>";
				echo "</li>";
			}//3 end
			echo "</ul>";
			echo "</li>";
		}
		echo"</ul>";
		echo "</li>";
}
echo("</ul></div>");

?>
</div>

<?php }?>
<div id='pop-up'><video width='100%' id='popup_vid'></video></div>
<br><b><br>
<a href="#" class="scrollToTop"><img src="images/up-arrow.png" width=50 height=50></a>   
<script src="js/masonry.pkgd.min.js"></script>
<script src="js/imagesloaded.js"></script>
<script src="js/classie.js"></script>
<script src="js/AnimOnScroll.js"></script>
		                  
<script src="js/float_dimensions.js" type="text/javascript" ></script>
<script src="js/jquery.cookie.js" type='text/javascript'></script>
<script src="js/jquery.treeview.js" type="text/javascript"></script>
<script src="js/video.js" type="text/javascript"></script>
<style type="text/css">

    #floatMenu {
        position:absolute;
        float : left;
        top:20%;
        width : 12%;
        margin-left : 69%;
        border : solid 2px #DCDCDC;
        padding : 10px;
        border-radius : 20px;

        -webkit-box-shadow: 10px 7px 20px -13px rgba(128,46,46,0.61);
        -moz-box-shadow: 10px 7px 20px -13px rgba(128,46,46,0.61);
        box-shadow: 10px 7px 20px -13px rgba(128,46,46,0.61);
    }

</style>

<script type='text/javascript'>
$(function() {
  var moveLeft = 20;
  var moveDown = 10;

  $('a.trigger').hover(function(e) {
    var interval_list = e.target.id;
    // a = interval_list.replace(/^[\\\/]|[\\\/]$/g,"1234")
    // alert(a);
    var split = interval_list.split("!!");
    var array = [];
    array.push(split);
    var nextVideo = split;
    $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
    var vid_num = nextVideo.length;

    var videoPlayer = document.getElementById("popup_vid");
    var curVideo = 0;   
    
    videoPlayer.src = nextVideo[curVideo];
    videoPlayer.autoplay = true;
    videoPlayer.loop = true;

    videoPlayer.load();

    videoPlayer.onpause = function(){
        curVideo = curVideo+1;
        videoPlayer.src = nextVideo[curVideo];
        videoPlayer.autoplay = true;
        videoPlayer.load();

        if(curVideo == vid_num ){   //영상이 끝까지 재생되었을 경우, 다시 처음으로 이동
            curVideo = 0;
            videoPlayer.src = nextVideo[curVideo];
            videoPlayer.autoplay = true;
            videoPlayer.load();
        }
    }
    $('div#pop-up').show();
  }, function() {
    $('div#pop-up').hide();
  });

  $('a.trigger').mousemove(function(e) {
    $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
  });



    $('img.trigger').hover(function(e) {
    var interval_list = e.target.id;

    var videoPlayer = document.getElementById("popup_vid");
    var curVideo = 0;   
    
    videoPlayer.src = interval_list;
    videoPlayer.autoplay = true;
    videoPlayer.loop = true;

    videoPlayer.load();

    $('div#pop-up').show();
  }, function() {
    $('div#pop-up').hide();
  });

  $('img.trigger').mousemove(function(e) {
    $("div#pop-up").css('top', e.pageY + moveDown);
  });
});

window.onload = function(){
    $(document).ready(function(){
        var clipboard = new Clipboard('.clipboard');
    });
};
 
new AnimOnScroll(document.getElementById('grid'),{
    minDuration : 0.1,
    maxDuration : 1.0,
    viewportFactor : 0.2
})

$(function(){

	var availableTags = <?php echo json_encode($json); ?>;
	$( "#tag_search" ).autocomplete({
		source: availableTags,
		delay:100
	});
});


var name = "#floatMenu";
var menuYloc = null;

$(document).ready(function(){
	menuYloc = parseInt($(name).css("top").substring(0,$(name).css("top").indexOf("px")))
	$(window).scroll(function () { 
		offset = menuYloc+$(document).scrollTop()+"px";
		$(name).animate({top:offset},{duration:500,queue:false});
	});
}); 
	    		
$(function(){
	$("#tree").treeview({
		collapsed: false,
		animated: "fast",
		control:"#sidetreecontrol",
		persist: "location"
	});
});
    

$('.tag_edit').click(function() {
	var $text = $(this),
	$input = $('<input type="text"/>')
	$text.hide()
	.after($input);

	$input.val($text.html()).show().focus()
	.keypress(function(e) {
    	var key = e.which
    	if (key == 13){ // enter key
    	var update_name = $input.val();
    	$.ajax({
    		type : "post",
    		data : {
    			update_tag : $input.val(),
    			idx:$text.attr('idx'),
    			path:$text.attr('path'),
    			tag:$text.attr('tag'),
    		},
    		url : "update_tag.php",
    		dataType:'html',
    		success : function(data){
    			$('#gallery').html(data);
    			$input.hide();
    			$text.html($input.val())
    			.show();
    		},error: function (XMLHttpRequest, textStatus, errorThrown) {
    			alert('Error: ' + XMLHttpRequest.responseText)
    			}
    		});
    	return false;
    	}
    }).focusout(function() {
        $input.hide();
        $text.show();
    })
});


function submit_py(path){
	var path = path;
	$.ajax({
		type : "post",
		url : "thum.php",
		data : {path : path},
		dataType:'html',
		success: function(data){
			$('#gallery').html(data);
		},beforeSend : function(){
			$('.wrap-loading').removeClass('display-none');
		},complete:function(){
			$('.wrap-loading').addClass('display-none');
		}, error:function (request, status,error){
			console.log("code : "+request.status+"\n"+"message : "+request.responseText+"\n"+"error : "+error);
		}
	});
}
		          
var id_arr = [];
var img_id_arr=[];
var thum_arr = [];

$("#insert").click(function(){
	var checkboxes = document.getElementsByName('images[]');
	var vals = "";
	var cart_arr = [];
	for (var i=0, n=checkboxes.length;i<n;i++){
		if (checkboxes[i].checked){
			cart_arr.push(checkboxes[i].value);
		}
	}
			         	
	$.ajax({
		type:"post",
		url : "get_thum.php",
		data : {thum_arr : cart_arr},
		success : function(data){
			alert("저장완료");
			console.log(data);
		}
	});
});

$("#cart").click(function(){
	var popUrl = "cart.php";
	var popOption = "width=1400px,height=1000px,resizable=no, scrollbars=yes, status=no";
	window.open(popUrl,"",popOption);
});

vid = document.getElementById("videopos");

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

function drop(ev,path,img_id) { //이미지 파일 태그 drop
	ev.preventDefault();
	var data = ev.dataTransfer.getData("text");
	var path = path;
		// var interval_id = interval_id;
	var img_id = img_id;
	// var img_name = img_name;
	// var end_time = total_sec;
	// var end_frame = parseInt(total_sec*24);
	// var full_path = full_path;

	var img_id_arr = [];
		
	ev.target.appendChild(document.getElementById(data));

	$('input[type=checkbox]').each(function () {
		if(this.checked == true){
			var val = $(this).val();
			img_id_arr.push(val);
		}
	});
		                
	if (img_id_arr.length ===0){
		$.ajax({
            type : "post",
            url : "insert_drag_tag.php",
            data : {tag:data,path:path,img_id:img_id,type:"img"},
			dataType : 'html'
        }).success(function(data){
			$('#gallery').html(data);
			console.log(img_id);
			return;
		});
	}else{
        // alert(img_id_arr);
		$.ajax({
            type : "post",
            url : "insert_drag_tag.php",
            data : {img_id_arr:img_id_arr,path:path,tag:data,type:"img"},
			dataType : 'html'
		}).success(function(data){
			$('#gallery').html(data);
			return;
		});
	}
}

function vid_drop(ev,path,img_id,img_name,total_sec) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var path = path;
        // var interval_id = interval_id;
    var img_id = img_id;
    var img_name = img_name;
    // alert(img_name);
    var end_time = total_sec;
    var end_frame = parseInt(total_sec*24);
        // var full_path = full_path;

    var img_id_arr = [];
        
    ev.target.appendChild(document.getElementById(data));

    $('input[type=checkbox]').each(function () {
        if(this.checked == true){
            var val = $(this).val();
            img_id_arr.push(val);
        }
    });
                   
    if (img_id_arr.length ===0){
        $.ajax({
            type : "post",
            url : "insert_drag_tag.php",
            data : {tag:data,path:path,img_id:img_id,img_name:img_name,end_frame:end_frame,end_time:end_time},
            dataType : 'html'
        }).success(function(data){
            $('#gallery').html(data);
            // console.log(data);
            return;
        });
    }else{
        $.ajax({
            type : "post",
            url : "insert_drag_tag.php",
            data : {vid_id_arr:img_id_arr,path:path,tag:data},
            dataType : 'html'
        }).success(function(data){
            $('#gallery').html(data);
            return;
        });
    }
}

function img_drop(ev,path,img_id){
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var path = path;
    // var interval_id = interval_id;
    var img_id = img_id;
    // var img_name = img_name;

    var img_id_arr = [];
        
    ev.target.appendChild(document.getElementById(data));

    $('input[type=checkbox]').each(function () {
        if(this.checked == true){
            var val = $(this).val();
            img_id_arr.push(val);
        }
    });
                        
    if (img_id_arr.length ===0){
        $.ajax({
            type:"post",
            url : "img_drag_tag.php",
            data : {tag:data,path:path,img_id:img_id},
            dataType : 'html'
        }).success(function(data){
            $('#gallery').html(data);
            // console.log(data);
            return;
        });

    }else{

        $.ajax({
            type:"post",
            url : "img_drag_tag.php",
            data : {img_id_arr:img_id_arr,path:path,tag:data},
            // url : 'img_drag_tag.php?img_id_arr='+ img_id_arr + '&path='+path + '&tag=' + data,
            dataType : 'html'
        }).success(function(data){
            $('#gallery').html(data);
            return;
        });
    }
}

	//////// check all 처리 ////////
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

function download_interval(img_path,img_name,start_time,end_time){
	$.ajax({
		type : "post",
		url : "video_py.php",
		data : {img_path:img_path,img_name:img_name,start_time : start_time,end_time:end_time},
		dataType:'html',
		success: function(data){
			$('#gallery').html(data);
		},beforeSend : function(){
			$('.wrap-loading').removeClass('display-none');
		},complete:function(){
			$('.wrap-loading').addClass('display-none');
		}, error:function (request, status,error){
			console.log("code : "+request.status+"\n"+"message : "+request.responseText+"\n"+"error : "+error);
		}
	});
}

vid.ontimeupdate = function(){
	setInterval(function(){
		getFrame();
	},(1000/24));
};
$("#pauseBtn").click(function () {
    vid.pause();
    vid.currentTime=0;
});

function getFrame(){
	curTime = vid.currentTime;
	theCurrentFrame = Math.floor(curTime*24);
	// time = Math.floor(vid.currentTime*24);
	document.getElementById("currentFrame").innerHTML = "Frame : " +theCurrentFrame;
}


function skip(value) {
   	video2 = document.getElementById('videopos');
   	video2.currentTime += value;
}  

function list(interval_list){
    // console.log(interval_list);
  	var split = interval_list.split("!!");
   	var array = [];
   	array.push(split);
   	var nextVideo = split;

    var vid_num = nextVideo.length;
    // console.log(nextVideo)
   	// alert(nextVideo);
   	// var nextVideo = ["/reference/project_reference/RUH/razor_show/롯데월드 레이저쇼.mp4#t=18.791666666667,113.125"]
   	// console.log(typeof(nextVideo));
   	var videoPlayer = document.getElementById("videopos");
   	var curVideo = 0;	
   	
    videoPlayer.src = nextVideo[curVideo];
   	videoPlayer.autoplay = true;
    videoPlayer.loop = true;

  	videoPlayer.load();

   	videoPlayer.onpause = function(){
   		curVideo = curVideo+1;
		videoPlayer.src = nextVideo[curVideo];
		videoPlayer.autoplay = true;
   		videoPlayer.load();

        if(curVideo == vid_num ){   //영상이 끝까지 재생되었을 경우, 다시 처음으로 이동
            curVideo = 0;
            videoPlayer.src = nextVideo[curVideo];
            videoPlayer.autoplay = true;
            videoPlayer.load();
        }
   	}
    window.scrollTo(0,0);
}

// var intervalRewind;
$("#speed-2").click(function(){
    if($(this).html() == "-2"){
        $(this).html('■');
        
        intervalRewind = setInterval(function(){
            vid.playbackRate = 1.0;
            if(vid.currentTime == 0){
                clearInterval(intervalRewind);
                vid.pause();
            }else{
                vid.currentTime += -.2;
            }
        },10);

    }else{
        $(this).html('-2');
        clearInterval(intervalRewind);
        vid.pause();
    }
});

$("#speed-3").click(function(){
    if($(this).html() == "-3"){
        $(this).html('■');
        
        intervalRewind = setInterval(function(){
            vid.playbackRate = 1.0;
            if(vid.currentTime == 0){
                clearInterval(intervalRewind);
                vid.pause();
            }else{
                vid.currentTime += -.3;
            }
        },10);

    }else{

        $(this).html('-3');
        clearInterval(intervalRewind);
        vid.pause();
    }
});

$("#pause").click(function(){
	clearInterval(intervalRewind);
	vid.pause();
});

$("#speed2").click(function(){
  	clearInterval(intervalRewind);
   	vid.playbackRate = 2.0;
   	if(vid.paused){
        vid.play();
        document.getElementById("speed2").innerText = "■";
    }else{
        vid.pause();
        document.getElementById("speed2").innerText = "+2";
    }
});

$("#speed3").click(function(){
  	clearInterval(intervalRewind);
   	vid.playbackRate = 3.0;
    if(vid.paused){
        vid.play();
        document.getElementById("speed3").innerText = "■";
    }else{
        vid.pause();
        document.getElementById("speed3").innerText = "+3";
    }
});


function get_start_frame(){
    curTime = vid.currentTime;
    get_start_frame = Math.floor(curTime*24);
    if(!window_name){
        alert("팝업창 x");
    }else{
        window_name.document.getElementById("start_frame").value=get_start_frame;
    }
}

function get_end_frame(){
    curTime = vid.currentTime;
    get_end_frame = Math.floor(curTime*24);
    if(!window_name){
    	alert("팝업창 x");
    }else{
        window_name.document.getElementById("end_frame").value=get_end_frame;
    }
}

function now_playing(path){
    alert(path);
    full_path = vid.currentSrc;
    alert(vid.currentSrc);
    full_path = full_path.replace("http://mgpipe.mg.com","/DATA");

    if(full_path == ""){
        alert("재생중인 영상이 없습니다.");
    }else{

        $.ajax({
            type : "post",
            url : "now_download.php",
            data : {full_path:full_path,path:path},
            dataType:'html',
            success: function(data){
                $('#gallery').html(data);
            },beforeSend : function(){
                $('.wrap-loading').removeClass('display-none');
            },complete:function(){
                $('.wrap-loading').addClass('display-none');
            }, error:function (request, status,error){
                console.log("code : "+request.status+"\n"+"message : "+request.responseText+"\n"+"error : "+error);
            }
        });
    }
}


</script>
