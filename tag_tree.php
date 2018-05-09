
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
                <div class='root_drop'ondrop=\"tag_root_drop(event,this,'$path','$dept_rs[tag]','root')\" ondragover='allowDrop(event)' style='width : 100%;height:30px;'>
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