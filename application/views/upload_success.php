<html>
<head>
<title>Success Message</title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<link href="http://localhost/ci_image_upload_download/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="content1">
<h3>Your file was successfully uploaded!</h3><br>
<div id="message1"><!-- Uploaded file specification will show up here -->
<h4><u>Details</u> :-</h4>
	<ul>
	<?php foreach ($upload_data as $item => $value):?>
	<li><b><?php echo $item;?></b> : <?php echo $value;?></li><br/>
	<?php endforeach; ?>
	</ul></div>
	
<hr><hr id="line1"> 
	<div id="selectImage1">
	<p ><?php echo anchor('upload_controller/file_view', 'Upload Another File!',array('id'=>'uploadagain')); ?></p>
	</div>
</div>
</body>
</html>


