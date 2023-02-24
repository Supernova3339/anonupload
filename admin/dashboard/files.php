<?php
include 'main.php';
$dir = '../../files/';
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/

// Handle success messages
if (isset($_GET['success_msg'])) {
    if ($_GET['success_msg'] == 1) {
        $success_msg = 'File deleted successfully!';
    }
    if ($_GET['success_msg'] == 2) {
        $success_msg = 'File updated successfully!';
    }
    if ($_GET['success_msg'] == 3) {
        $success_msg = 'File created successfully!';
    }
    if ($_GET['success_msg'] == 4) {
        $success_msg = 'Files deleted successfully!';
    }
}

// Handle error messages
if (isset($_GET['error_msg'])) {
    if ($_GET['error_msg'] == 1) {
        $error_msg = 'File Cant Be Deleted';
    }
    if ($_GET['error_msg'] == 2) {
        $error_msg = 'File Upload Error';
    }
    if ($_GET['error_msg'] == 3) {
        $error_msg = 'An Error Occured';
    }
    if ($_GET['error_msg'] == 4) {
        $error_msg = 'File path doesnt exist.';
    }
    if ($_GET['error_msg'] == 5) {
        $error_msg = 'File path not found.';
    }
}

// filelist

function list_directory_files($dir)
{
    if (is_dir($dir)) {
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if ($file != '.' && $file != '..' && $file != 'Thumbs.db' && $file != 'index.php') {
                    echo '<tr>';
                    echo '<td>';
                    echo $file;
                    echo '</td>';
                    echo '<td>';
                    echo '<a class="link1" href="?path='.$dir.''.$file.'">Download</a>';
                    echo '<a  class="link1" href="?delete&file='.$dir.''.$file.'">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }

            closedir($handle);
        }
    }
}

// download file

if (isset($_GET['path'])) {
    //Read the url
    $url = $_GET['path'];

    //Clear the cache
    clearstatcache();

    //Check the file path exists or not
    if (file_exists($url)) {

//Define header information
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($url).'"');
        header('Content-Length: '.filesize($url));
        header('Pragma: public');

        //Clear system output buffer
        flush();

        //Read the size of the file
        readfile($url, true);

        //Terminate from the script
        exit();
    } else {
        // do nothing
    }
}
// do nothing

if (isset($_GET['delete'], $_GET['file'])) {
    $delfile = $_GET['file'];
    /*
    header("Location: $delfile");
    */
    if (unlink($delfile)) {
        // file was successfully deleted
        header('Refresh:0 url=files.php?success_msg=1');
    } else {
        // there was a problem deleting the file
        header('Refresh:0 url=files.php?error_msg=1');
    }
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<?=template_admin_header('Files', 'files')?>

<h2>Files</h2>

<div class="content-header links">
    <button class="btn" onclick="exportTableToExcel('data');"><i class="fa-solid fa-file-excel"></i>&nbsp;Export page to .xls</button>
</div>

<!-- Display Success Alert -->
<?php if (isset($success_msg)) { ?>
<div class="msg success">
    <i class="fas fa-check-circle"></i>
    <p><?=$success_msg?></p>
    <i class="fas fa-times"></i>
</div>
<?php } ?>

<!-- Display Error Message -->
<?php if (isset($error_msg)) { ?>
<div class="msg error">
    <i class="fa fa-exclamation-triangle"></i>
    <p><?=$error_msg?></p>
    <i class="fas fa-times"></i>
</div>
<?php } ?>

<div class="content-block">
    <div class="table">   
     <table id="data">
     <thead>
       <tr>
         <td>File</td>
         <td>Actions</td>
       </tr>
     </thead>
     <tbody>
      <tr>
       <?php list_directory_files($dir); ?>
     </tbody>
     </table>
    </div>
</div>

<script>
  $(document).ready(function(){
        $('#data').after('<div id="nav"></div>');
        var rowsShown = 25;
        var rowsTotal = $('#data tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<a class="btn disabled" href="#" rel="'+i+'">'+pageNum+'</a> ');
        }
        $('#data tbody tr').hide();
        $('#data tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
    });
    
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'exported_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>

<?=template_admin_footer()?>