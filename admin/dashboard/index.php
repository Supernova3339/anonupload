<?php
include 'main.php';
include_once '../../system/config.php';
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

*/
// Get total files in uploads directory
?>
<?php
  $directory = "../.$file_url_destination./files/"; // dir location
if (glob($directory . "*.*") != false)
{
 $filecount = count(glob($directory. "*.*" && $file != "index.php"));
 
}
// file size of upload dir

function folderSize($dir){
$count_size = 0;
$count = 0;
$dir_array = scandir($dir);
  foreach($dir_array as $key=>$filename){
    if($filename!=".." && $filename!="." && $filename!="index.php"){
       if(is_dir($dir."/".$filename)){
          $new_foldersize = foldersize($dir."/".$filename);
          $count_size = $count_size+ $new_foldersize;
        }else if(is_file($dir."/".$filename)){
          $count_size = $count_size + filesize($dir."/".$filename);
          $count++;
        }
   }
 }
return $count_size;
}

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

// get size of folders in a folder 
$plugin_count = count(glob('../../plugins/*', GLOB_ONLYDIR));

?>
<?=template_admin_header('Dashboard', 'dashboard')?>

<h2>Dashboard</h2>

<div class="dashboard">
    <div class="content-block stat">
        <div class="data">
            <h3>Total Files</h3>
            <p><?php echo $filecount ?></p>
        </div>
        <i class="fas fa-file"></i>
    </div>

    <div class="content-block stat">
        <div class="data">
            <h3>Storage Used</h3>
            <p><?php echo sizeFormat(folderSize($directory)); ?></p>
        </div>
        <i class="fas fa-database"></i>
    </div>

    <div class="content-block stat">
        <div class="data">
            <h3>Plugins Installed</h3>
            <p><?php echo $plugin_count; ?></p>
        </div>
        <i class="fas fa-plug"></i>
    </div>

    <div class="content-block stat">
        <div class="data">
            <h3>Version</h3>
            <p>
            1.0
            </p>
        </div>
        <i class="fas fa-info"></i>
    </div>
</div>
  <br>
<?php if(!plausibledatadomain&plausibledomain&plausibleembedtoken){
  echo '
<div class="alert warning">
  <span class="closebtn">&times;</span>  
  <strong>Warning!</strong>&nbsp;Plausible analytics have not been configured.
</div>
  }';
  
if(plausibledatadomain&plausibledomain&plausibleembedtoken){
  echo '
<iframe plausible-embed src="' . plausibledomain . '/share/' . plausibledatadomain . '?auth= ' . plausibleembedtoken . '&embed=true&theme=light&background=%23EBECED" scrolling="no" frameborder="0" loading="lazy" style="width: 1px; min-width: 100%; height: 1600px;"></iframe>
<script async src="' . plausibledomain . 'js/embed.host.js"></script> ';
}
 

template_admin_footer();
