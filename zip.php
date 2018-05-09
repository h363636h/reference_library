<?php 
session_start();

ini_set('memory_limit', '-1');
ini_set('max_execution_time',0);

include "lib/dbconn.php";
include "os_chk.php";

echo json_encode($_POST['files']);

// if(isset($_POST['files'])){
//     $files = $_POST['files'];
// }

// $ref_path = array();
// foreach ($files as $file){
//     $select_sql = "select * from img where img_id='$file'";
// echo $select_sql;
//     $select_result = mysql_query($select_sql,$connect);
    
//     while($row = mysql_fetch_array($select_result)){
//         array_push($ref_path,$row['img_path'].$row['img_name']);
//     }
// }
// echo json_encode($ref_path);
// $ref_path = implode(" ",$ref_path);

// if($user_os == "Linux"){
//     echo "zip -r /DATA/reference_library/reference.zip '$ref_path'";
//     exec("zip -r /DATA/reference_library/reference.zip '$ref_path'",$output,$return);
// }else{
//     exec("zip -r \\DATA\\reference_library\\reference.zip '$ref_path'",$output,$return);
// } 
// if(!$return){
//     $zip_name = "reference.zip";
//     header('Content-Type: application/zip');
//     header('Content-disposition: attachment; filename='.$zip_name);
//     ob_clean();
   
//     flush();
//     $fp = fopen($zip_name, "r");
//     fpassthru($fp);
//     fclose($fp);
    
//     unlink($zip_name);
//     unset($_SESSION['thum']);
  
    
// }else{
//     echo "<script>alert('다운로드 실패');history.go(-1);</script>";
// }

?>
