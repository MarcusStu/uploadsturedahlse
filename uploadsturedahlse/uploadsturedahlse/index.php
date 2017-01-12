 
<?php 
session_start();
        if(isset($_FILES['UploadFileField'])){
        
            $UploadName = $_FILES['UploadFileField']['name'];
            $UploadName = mt_rand(100000, 999999).$UploadName;
            $UploadTmp = $_FILES['UploadFileField']['tmp_name'];
            $UploadType = $_FILES['UploadFileField']['type'];
            $FileSize = $_FILES['UploadFileField']['size'];

            $UploadName = preg_replace("#[^a-z0-9.]#i", "", $UploadName);

            $_SESSION['message_uploadtobig'] = "";
            $_SESSION['message_uploadcomplete'] = "";
            $_SESSION['message_uploadnofileselected'] = "";
            $_SESSION['upload_link'] = '';


            // 209715200 Bytes = 200 MB
            if (($FileSize > 209715200)) {
                $_SESSION['message_uploadtoobig'] = "Error - File exceeds 200MB limit!";
                die("Error - File exceeds 200MB limit");
            }

            if(!$UploadTmp) {
                $_SESSION['message_uploadnofileselected'] = "No File Selected, Please Upload Again!";
                die("No File Selected, Please Upload Again");
            }else {
                $_SESSION['message_uploadcomplete'] = "File Uploaded Successfully!";
                move_uploaded_file($UploadTmp, "uploads/$UploadName");
                 $upload_message = "<a target='_blank' href='/upload/uploads/$UploadName'>$UploadName</a>";
                 $upload_message2 = "https://sturedahl.se/upload/uploads/$UploadName";
                 $_SESSION['upload_link'] = $upload_message;
                 $_SESSION['upload_link2'] = $upload_message2;
                 header('location: /upload/?success');
            }
    }

    
?>
<!DOCTYPE html>
<html>    
<head>

<title>S-Upload</title>

<!-- Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- My CSS -->
<link href="css/styles.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

</head>
<body>    

<div class="fileuploadholder shadow">
<form action="index.php" method="post" enctype="multipart/form-data" name="FileUploadForm" id="FileUploadForm">
<!--<label id="label_choose" for="UploadFileField"><span class="fa fa-upload"></span> Choose File..</label>

<input class="inputfile" type="file" name="UploadFileField" id="UploadFileField" data-multiple-caption="{count} files selected" multiple required />
-->

            <div id="browse_btn" class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        <span class="fa fa-upload"></span> Browse&hellip; <input class="inputfile" type="file" name="UploadFileField" id="UploadFileField" style="display: none;" multiple required>
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
        


<input class="form-control btn btn-primary" type="submit" name="UploadButton" id="UploadButton" value="Upload" />
<div id="upload_info_text">
<small><img src="bock.png" /> max <text style="color:#00ff00;">200 MB</text></small>
<br />
<small><img src="bock.png" /> all file types allowed</small>
</div>
</div>

<div class="fileuploadedbox">

<?php
    if (isset($_SESSION['message_uploadtoobig'])) {
    echo "<div style='color:#ff0000;' id='upload_toobig'>".$_SESSION['message_uploadtoobig']."</div>";
    unset($_SESSION['message_uploadtoobig']);
}
?>

<?php
    if (isset($_SESSION['message_uploadnofileselected'])) {
    echo "<div style='color:#ff0000;' id='upload_nofileselected'>".$_SESSION['message_uploadnofileselected']."</div>";
    unset($_SESSION['message_uploadnofileselected']);
}
?>

<?php
    if (isset($_SESSION['message_uploadcomplete'])) {
    echo "<div style='color:#00ff00;' id='upload_complete'>".$_SESSION['message_uploadcomplete']."</div>";
    unset($_SESSION['message_uploadcomplete']);
}
?>

<?php
    if (isset($_SESSION['upload_link'])) {
    echo "<input id='upload_link' value=".$_SESSION['upload_link2']." autofocus='autofocus' onfocus='this.select()' />";
    echo "<br />";
    echo "<a id='copy-button' class='btn btn-default btn-xs' data-clipboard-target='#upload_link' href='#'><i class='fa fa-clipboard' aria-hidden='true'></i> Copy URL</a>";
    unset($_SESSION['upload_link']);
}
?>

</div>

<div id="footer_div" class="footer">
<p>&copy; 2016-<?php echo date("Y"); ?> Marcus Sturedahl Designs</p>
</div>




<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.12/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="js/myjs.js"></script>

</body>    
</html> 

