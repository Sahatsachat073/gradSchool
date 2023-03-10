<?php 
require_once( "../inc/db_connect.php" );
$mysqli = connect();
$query = "SELECT * FROM info_result_language_exam ";
// $query = "SELECT * FROM info_student WHERE STUDENTCODE =".$_SESSION['SES_EN_REG_USER'] ;
$result = mysqli_query($mysqli,$query);

// require_once("./fpdf.php");

// $pdf = new FPDF();
// $pdf->AddPage();
// $pdf->AddFont('sarabun','','times.php');

// $pdf->Image('../assets/img/logo/ตราสัญลักษณ์ประจำมหาวิทยาลัยมหาสารคาม.svg.png',92,8,25);
// $pdf->SetY(38);
// $pdf->SetFont('sarabun','','18');
// $pdf->Cell(0,10,'Result Language Exam',0,1,'C');

// $pdf->Output();
?>
<style>
   @media print{
        #hid{
          display: none; /* ซ่อน  */
        }
      }
</style>
<!DOCTYPE html>
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Account settings - Account </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/icons/brands/google.png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <?php include "./header.php" ?>
  </head>

  <body>
    
                  
                  
                   <center> <img class="center" src="../assets/img/logo/ตราสัญลักษณ์ประจำมหาวิทยาลัยมหาสารคาม.svg.png"   srcset="" width="80" > </center>
                    <h5 class="card-header text-center" >ผลการสอบวัดความรู้ภาษาอังกฤษสําหรับนิสิตระดับบัณฑิตศึกษา</h5>
                    <div class="card-body">
                    <div class="table">
                                    <table class="table table-bordered ">
                                      
                                      <thead>
                                        <tr align="center">
                                          <th class="text-nowrap">รหัสนิสิต</th>
                                          <th class="text-nowrap ">คะแนน</th>
                                          <th class="text-nowrap ">ประเภทการสอบ</th>
                                          <th class="text-nowrap ">วันที่ประกาศผล</th>
                                          <th class="text-nowrap">ภาคเรียนที่</th>
                                          <th class="text-nowrap">ปีการศึกษา</th>
                                          <th class="text-nowrap text-center">ผลการสอบ</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody class="table-border-bottom-0">
                                      <?php while($row = $result->fetch_assoc()): ?>
                                        <tr align="center">
                                          <td class="text-nowrap"></td>
                                          <td class="text-nowrap"><?php echo $row["score"] ?></td>
                                          <td class="text-nowrap"><?php 
                                          if ($row["types"]=='1') {
                                            echo "สอบ";
                                          }elseif ($row["types"]=='2') {
                                            echo "เทียบ";
                                          } ?></td>
                                          
                                          <td class="text-nowrap "><?php echo $row["dates"] ?></td>
                                          <td class="text-nowrap"><?php echo $row["term"] ?></td>
                                          <td class="text-nowrap"><?php echo $row["years"] ?></td>
                                          <td class="text-nowrap"><?php 
                                          if ($row["result"]=='1') {
                                            echo "ไม่ผ่าน";
                                          }elseif ($row["result"]=='2') {
                                            echo "ผ่าน";
                                          } ?></td>
                                          
                                          
                                        </tr>
                                        <?php endwhile ?>
                                      </tbody>
                                    </table>
                                    <button id="hid" onclick="window.print();" class="btn btn-info"> print </button>
                          

                        

                    </div>
                  
    

</body>
</html>
