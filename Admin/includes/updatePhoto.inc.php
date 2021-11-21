<?php
require_once 'dbh.inc.php';
session_start();
$id = $_SESSION['userid'];
ob_start();
set_time_limit(0); 

$state  = "";
$success=0;
$photo_status='';

if (isset($_POST['btn-upload'])) {


  $filename = $_FILES['file']['name'];
  if($filename==null){
    $success=2;
    header("Location: ../Admin-viewProfile.php?error=none_1");
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
    
    $sql = "UPDATE admins SET admin_photo = '$content' WHERE admisId = '$id';";
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
echo $content;
        header("location: ../Admin-viewProfile.php?error=none_1");
        exit();
}
else{
    header("location: ../Admin-viewProfile.php?");
    exit();
}
?>