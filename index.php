<?php 
require_once(__DIR__ . '/system/core.class.php');

$core = new Core();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= app_name; ?> - <?= app_desc; ?></title>
	<link rel="stylesheet" type="text/css" href="assets/main.css">
</head>
<body>
	<div class="wrapper">
		<img src="assets/images/logo.png">
<?php 
if(isset($_POST['submit'])){
	if($core->FileTypeVerification($_FILES["fileToUpload"])){
		if($core->FileSizeVerification($_FILES["fileToUpload"])){
			$newfilename = $core->FileNameConvertor($_FILES["fileToUpload"]);
			if($core->UploadFile($_FILES["fileToUpload"], $newfilename)){
				?>
				<div class="notification success">
					Success ! Your file are available here: <a href="<?= file_url_destination.'/'.file_destination.'/'.$newfilename; ?>"><?= file_url_destination.'/'.file_destination.'/'.$newfilename; ?></a>
				</div>
				<?php
			}else{
				?>
				<div class="notification error">
					An error occured while trying to upload your file(s).
				</div>
				<?php
			}
		}else{
			?>
			<div class="notification error">
			Your file is too high/low.
			</div>
			<?php
		}
	}else{
		?>
		<div class="notification error">
			Incorrect file format.
		</div>
		<?php
	}
}

?>
        <form method="post" action="" enctype="multipart/form-data">
  <input type="file" name="fileToUpload">
  <p>Drag your file here or click in this area.</p>
  <button type="submit">Upload</button>
</form>
	</div>



	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script type="text/javascript">
$(document).ready(function(){
  $('form input').change(function () {
  	if(this.files.length == 0){}else{
    	$('form p').text("File selected: "+this.files[0].name);
	}
  });
});
    </script>
</body>
</html>
