<?php 
require_once(__DIR__ . '/system/core.class.php');
// size convertor
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

// Get uploaded file
$file = $_GET['file'];
$fileURL = base64_decode($file);
$filesize = filesize($fileURL);
$baseurl = file_url_destination;

// Check if file exists
if(!file_exists($fileURL){
header("Location: $baseurl");
}

$core = new Core();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=app_name?> - Download</title>
	<link rel="stylesheet" type="text/css" href="assets/main.css">
</head>
<body>
	<div class="wrapper">
		<img src="assets/images/logo.png">
<?php 
if(isset($_POST['submit'])){
  
	}
?>
        <!--<form>-->
	    <div class="download-area">	
		  <button class="download-btn" data-timer="<?=waitfor?>">Download&nbsp;[<?=sizeFormat($filesize)?>]</button>
		  <ul>
        <li>Report files: <a href="mailto:<?=app_contact_email?>"><?=app_contact_email?></a></li> 
        	</ul>
	    </div>
        <!--</form>-->
    </div>
</body>
	<?php echo'
  <script>
  const downloadBtn = document.querySelector(".download-btn");
const fileLink = "' . $fileURL .'";
const initTimer = () => {
    if(downloadBtn.classList.contains("disable-timer")) {
        return window.open(fileLink);
    }
    let timer = downloadBtn.dataset.timer;
    downloadBtn.classList.add("timer");
    downloadBtn.innerHTML = `Your download will begin in <b>${timer}</b> seconds`;
    const initCounter = setInterval(() => {
        if(timer > 0) {
            timer--;
            return downloadBtn.innerHTML = `Your download will begin in <b>${timer}</b> seconds`;
        }
        clearInterval(initCounter);
        window.open(fileLink);
        downloadBtn.innerText = "Your file is downloading...";
        setTimeout(() => {
            downloadBtn.classList.replace("timer", "disable-timer");
            downloadBtn.innerHTML = `<span class="text">Download Again</span>`;
        }, 3000);
    }, 1000);
}
downloadBtn.addEventListener("click", initTimer);
  </script>
  </script>'; ?>
</html>
