<?php 
require_once(__DIR__ . '/system/core.class.php');
session_start();

// size converter

function sizeFormat($bytes){ 
$kb = 1024;
$mb = $kb * 1024;
$gb = $mb * 1024;
$tb = $gb * 1024;

if (($bytes >= 0) && ($bytes < $kb)) {
return $bytes . ' B';

} elseif (($bytes >= $kb) && ($bytes < $mb)) {
return ceil($bytes / $kb) . ' KB';

} elseif (($bytes >= $mb) && ($bytes < $gb)) {
return ceil($bytes / $mb) . ' MB';

} elseif (($bytes >= $gb) && ($bytes < $tb)) {
return ceil($bytes / $gb) . ' GB';

} elseif ($bytes >= $tb) {
return ceil($bytes / $tb) . ' TB';
} else {
return $bytes . ' B';
}
}

$maxsize = max_size;
$core = new Core();
?>
<!DOCTYPE html>
<html>
<head>
        
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php if(app_name&&app_desc == ''){ echo 'AnonUpload - Secure and anonymous file sharing'; } if(app_name&&app_desc){ echo app_name . ' - ' . app_desc; } ?></title>
	    <!-- for discord -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?= app_name; ?>" />
        <meta property="og:description" content="<?= app_desc; ?>" />
        
	<link rel="stylesheet" type="text/css" href="assets/main.css">
</head>
<body>
	<div class="wrapper">
		<?php if(app_logoimage == ''){ ?>
		<img src="assets/images/logo.png">
		<?php } if(app_logoimage){ ?>
		<img src="<?=app_logoimage?>">
		<?php } ?>
<?php 
if(isset($_POST['submit'])){
	if($core->FileTypeVerification($_FILES["fileToUpload"])){
		if($core->FileSizeVerification($_FILES["fileToUpload"])){
			$newfilename = $core->FileNameConvertor($_FILES["fileToUpload"]);
			if($core->UploadFile($_FILES["fileToUpload"], $newfilename)){
				?>
				<div class="notification success">
					Success ! Your file is available here: <a href="<?= file_url_destination.'/'.file_destination.'/'.$newfilename; ?>"><?= file_url_destination.'/'.file_destination.'/'.$newfilename; ?></a>
				</div>
				<?php
			}else{
				?>
				<div class="notification error">
					An error occured while trying to upload your file
				</div>
				<?php
			}
		}else{
			?>
			<div class="notification error">
			Your File Is Too Big
			</div>
			<?php
		}
	}else{
		?>
		<div class="notification error">
			Incorrect File Format
		</div>
		<?php
	}
}

?>
        <form method="post" action="#" enctype="multipart/form-data">
		  <input type="file" name="fileToUpload">
		  <p>Drag a file here or click to upload</p>
		  <button name="submit" type="submit">Upload</button>
		  <ul>
        		<li>Supported files: <?= FILELIST; ?></li> 
        	</ul>
        	<br>
        	<ul>
        	    <li>Maximum filesize: <?php echo sizeFormat($maxsize); ?></li>
        	</ul>
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
	<?php if(!plausibledatadomain&&plausibledomain == ''){ ?>
		
	<?php }else{ ?>
	<script defer data-domain="<?=plausibledatadomain?>" src="<?=plausibledomain?>/js/script.js"></script>
	<?php }  ?>
	
</body>
</html>
