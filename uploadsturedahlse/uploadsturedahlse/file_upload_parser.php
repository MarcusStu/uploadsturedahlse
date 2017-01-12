<?php
$fileName = $_FILES["UploadFileField"]["name"]; // The File Name
$fileTmpLoc = $_FILES["UploadFileField"]["tmp_name"]; // File in the PHP temp folder
$fileType = $_FILES["UploadFileField"]["type"]; // The File Type
$fileSize = $_FILES["UploadFileField"]["size"]; // The File Size in bytes
$fileErrorMsg = $_FILES["UploadFileField"]["error"]; // 0 for false and 1 for true

if (!$fileTmpLoc) { //if file not chosen
        echo "<text style='color:#ff0000;'>ERROR: </text>Please choose a file before uploading.";
        exit();
}

//if (move_uploaded_file($fileTmpLoc, "uploads/$fileName")) {
//        echo "$fileName upload is complete. Please wait for the unique URL..";
//} else {
//        echo "move_uploaded_file function failed";
//}

?>