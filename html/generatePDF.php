<?php 
require_once("../fpdf/fpdf.php");
//  require_once("./fpdf.php");
 require_once( "../inc/db_connect.php" );

 class PDF_Rotate extends FPDF
 {
 var $angle=0;
 
 function Rotate($angle,$x=-1,$y=-1)
 {
     if($x==-1)
         $x=$this->x;
     if($y==-1)
         $y=$this->y;
     if($this->angle!=0)
         $this->_out('Q');
     $this->angle=$angle;
     if($angle!=0)
     {
         $angle*=M_PI/180;
         $c=cos($angle);
         $s=sin($angle);
         $cx=$x*$this->k;
         $cy=($this->h-$y)*$this->k;
         $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
     }
 }
 
 function _endpage()
 {
     if($this->angle!=0)
     {
         $this->angle=0;
         $this->_out('Q');
     }
     parent::_endpage();
 }
 }
  class PDF extends PDF_Rotate
  {
  function Header()
  {
      //Put the watermark
      $this->SetFont('Arial','B',50);
      $this->SetTextColor(192,192,192);
      $this->RotatedText(35,190,'G r a d u a t e  S c h o o l',45);
  }
  
  function RotatedText($x, $y, $txt, $angle)
  {
      //Text rotated around its origin
      $this->Rotate($angle,$x,$y);
      $this->Text($x,$y,$txt);
      $this->Rotate(0);
  }
  }
  
  $pdf=new PDF();
  $pdf->AddPage();
  $pdf->SetFont('times','','14');
  $pdf->Image('../assets/img/logo/ตราสัญลักษณ์ประจำมหาวิทยาลัยมหาสารคาม.svg.png',92,15,25);
  $pdf->SetY(38);
  $pdf->SetFont('times','','14');
  $pdf->Cell(0,10,'Mahasarakham Uniuversity',0,1,'C');
  $pdf->Cell(0,5,'Title: Result Language Exam',0,1,'C');
  $query = "SELECT * FROM info_result_language_exam ";
 
  $mysqli = connect();
  $result = mysqli_query($mysqli,$query); 
  $row =mysqli_fetch_assoc($result) ;
 
 
  $pdf->SetFont('times','','14');
  $pdf->Cell(31,10,'studentID',1,0,'C');
  $pdf->Cell(20,10,'type',1,0,'C');
  $pdf->Cell(20,10,'score',1,0,'C');
  $pdf->Cell(32,10,'date',1,0,'C');
  $pdf->Cell(30,10,'term',1,0,'C');
  $pdf->Cell(30,10,'year',1,0,'C');
  $pdf->Cell(0,10,'result',1,1,'C');
 
  
  do {
  $pdf->Cell(31,10,$row['stu_id'],1,0,'C');
  $pdf->Cell(20,10,$row['types'] ,1,0,'C');
  $pdf->Cell(20,10,$row['score'],1,0,'C');
  $pdf->Cell(32,10,$row['dates'],1,0,'C');
  $pdf->Cell(30,10,$row['term'],1,0,'C');
  $pdf->Cell(30,10,$row['years'],1,0,'C');
  $pdf->Cell(0,10,$row['result'],1,1,'C');
  
  } while ($row =mysqli_fetch_assoc($result) );
  $pdf->SetFont('times','B','10');
  $pdf->Cell(0,10,'Type 1=exam, 2=compare |  Result 0=fail, 1=pass',0,1,'L');
  $pdf->Cell(0,10,'sig(.................................................................)',0,1,'R');
  $pdf->Cell(0,5,'(....................................................)      ',0,1,'R');
  $pdf->Cell(0,5,'Dean of the Graduate School         ',0,1,'R');
  $pdf->Cell(0,5,'Date......../............/...........            ',0,1,'R');
  $pdf->Output('Result.pdf', 'I');  
 
  $pdf->Output();
 
 
//  $pdf = new FPDF();
//  $pdf->AddPage();
//  $pdf->SetFont('times','','14');

//  $pdf->Image('../assets/img/logo/ตราสัญลักษณ์ประจำมหาวิทยาลัยมหาสารคาม.svg.png',92,8,25);
//  $pdf->SetY(38);
//  $pdf->SetFont('times','','14');
//  $pdf->Cell(0,0,'Mahasarakham Uniuversity',0,1,'C');
//  $pdf->Cell(0,10,'Title: Result Language Exam',0,1,'C');
//  $query = "SELECT * FROM info_result_language_exam ";

//  $mysqli = connect();
//  $result = mysqli_query($mysqli,$query); 
//  $row =mysqli_fetch_assoc($result) ;


//  $pdf->SetFont('times','','14');
//  $pdf->Cell(31,10,'studentID',1,0,'C');
//  $pdf->Cell(20,10,'type',1,0,'C');
//  $pdf->Cell(20,10,'score',1,0,'C');
//  $pdf->Cell(32,10,'date',1,0,'C');
//  $pdf->Cell(30,10,'term',1,0,'C');
//  $pdf->Cell(30,10,'year',1,0,'C');
//  $pdf->Cell(0,10,'result',1,1,'C');

 
//  do {
//  $pdf->Cell(31,10,'61011213145',1,0,'C');
//  $pdf->Cell(20,10,$row['types'] ,1,0,'C');
//  $pdf->Cell(20,10,$row['score'],1,0,'C');
//  $pdf->Cell(32,10,$row['dates'],1,0,'C');
//  $pdf->Cell(30,10,$row['term'],1,0,'C');
//  $pdf->Cell(30,10,$row['years'],1,0,'C');
//  $pdf->Cell(0,10,$row['result'],1,1,'C');
 
//  } while ($row =mysqli_fetch_assoc($result) );
//  $pdf->SetFont('times','B','10');
//  $pdf->Cell(0,10,'Type 1=exam, 2=compare |  Result 0=fail, 1=pass',0,1,'L');
//  $pdf->Cell(0,10,'sig(.................................................................)',0,1,'R');
//  $pdf->Cell(0,5,'(....................................................)      ',0,1,'R');
//  $pdf->Cell(0,5,'Dean of the Graduate School        ',0,1,'R');
//  $pdf->Cell(0,5,'Date......../............/...........            ',0,1,'R');
//  $pdf->Output('file.pdf', 'I');  

?>

