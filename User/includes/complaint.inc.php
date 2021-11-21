<?php
session_start();
$id = $_SESSION["userid"];
ob_start();
set_time_limit(0); 
require_once 'dbh.inc.php';

$state  = "";
$success=0;

if (isset($_POST['btn-upload'])) {

    $trainNo = $_POST['trainNo'];
    $detail = $_POST['detail'];
    $Ctype = $_POST['Ctype'];
    $filename = $_FILES['file']['name'];

    if($filename==null){
      $sql = "INSERT complaints SET userId = '$id', trainNo = '$trainNo', detail = '$detail', Ctype = '$Ctype';";
      $i = mysqli_query($conn, $sql);
      
      if ($i == 1) {
  
        $success = 1;
  
        mysqli_close($conn);
      } 
      else {
        mysqli_close($conn);
        $success=2;
      }

    }
  
    else{
  
    $tmpname = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
  
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
  
    $fp      = fopen($tmpname, 'r');
    $content = fread($fp, filesize($tmpname));
    $content = addslashes($content);
    fclose($fp);
  
  
    if (
      $ext == "png" || $ext == "PNG" || $ext == "JPG" || $ext == "jpg" || $ext == "jpeg" || $ext == "JPEG"
      || $ext == "pdf" || $ext == "PDF" || $ext == "doc" || $ext == "DOC" || $ext == "docx" || $ext == "DOCX"
      || $ext == "XLS" || $ext == "xls" || $ext == "XLSX" || $ext == "xlsx" || $ext == "xlsm" || $ext == "XLSM" || $ext == "TXT"
    ) { 
      
      
      $sql = "INSERT complaints SET userId = '$id', photo = '$content', trainNo = '$trainNo', detail = '$detail', Ctype = '$Ctype';";
      $i = mysqli_query($conn, $sql);
      if ($i == 1) {
  
        $success = 1;
  
        mysqli_close($conn);
      } else {
        mysqli_close($conn);
        $success=2;
      }
    } 
    else {
      mysqli_close($conn);
      $state = 'File Format might not be supported, please check and try again';
    }
  }


          header("location: ../User-complaints.php?error=none");
          exit();
  }
  else{
      header("location: ../User-complaints.php");
      exit();
  }
  ?>