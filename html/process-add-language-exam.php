<?php 
require_once( "../inc/db_connect.php" );
$mysqli = connect();


?>

<?php 
 $sid =$_POST['stu_id'];
 $types=$_POST['types'];
 $score = $_POST['score']; 
  //$Certificates = $_FILES['certificates'];    
 $dates = $_POST['dates'];  
 $term = $_POST['term'];
 $years =$_POST['years'];
 $result =$_POST['result'];
 $examType =$_POST['examType'];
 $round =$_POST['round'];

 $uploaddir = 'fileUpload/';
 $uploadfiles =$_FILES['certificates']['name'];
$uploadfile = $_FILES['certificates']['tmp_name'];

echo '<pre>';
if (move_uploaded_file($_FILES['certificates']['tmp_name'], 'fileUpload/'.$uploadfiles)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

//echo 'Here is some more debugging info:';
// print_r($_FILES);

// print "</pre>";

 
$sql ="INSERT INTO info_result_language_exam (stu_id,types,score,certificates,dates,
 term,years,result,examType,round) VALUES ('$sid','$types','$score','$uploadfiles','$dates','$term','$years','$result','$examType','$round')";
 //echo $sql;
//  $rs = $mysqli->query( $sql );
if ($mysqli->query($sql)) {
  // echo "seccess";
  echo '<script>alert("บันทึกการเพิ่มข้อมูลแล้ว");window.location="./language-exam.php";</script>';
}
else {
  //echo "error";
  echo '<script>alert("พบข้อผิดพลาด!!")</script>';
}
?>