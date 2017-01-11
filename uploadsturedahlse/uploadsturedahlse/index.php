<?php


?>
  
<?php require_once "phpuploader/include_phpuploader.php" ?>    
<?php session_start(); ?>
<html>    
<head>

<!-- Bootstrap -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>    
        	<div>
	
<hr/>
	
	<?php
		$uploader=new PhpUploader();
		
		$uploader->MultipleFilesUpload=true;
		$uploader->InsertText="Select multiple files (Max 200MB)";
		
		$uploader->MaxSizeKB=204800;
		$uploader->AllowedFileExtensions="*.jpg,*.png,*.gif,*.bmp,*.txt,*.zip,*.rar";
		
		$uploader->SaveDirectory="uploads";
		
		$uploader->FlashUploadMode="Partial";
		
		$uploader->Render();
		
	?>
	
	</div>
		
	<script type='text/javascript'>
	function CuteWebUI_AjaxUploader_OnTaskComplete(task)
	{
		var div=document.createElement("DIV");
		var link=document.createElement("A");
		link.setAttribute("href","uploads/"+task.FileName);
		link.innerHTML="You have uploaded file : uploads/"+task.FileName;
		link.target="_blank";
		div.appendChild(link);
		document.body.appendChild(div);
	}
	</script>

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</body>    
</html> 

