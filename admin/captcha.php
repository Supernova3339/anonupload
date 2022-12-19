<?php
session_start();
// Generate random 6 character string
$captcha_code = substr(str_shuffle('01234567890123456789abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz'), 0, 6);
// Update the session variable
$_SESSION['captcha'] = $captcha_code;
// Create the image canvas - width: 150px; height: 50px;
$final_image = imagecreate(150, 50);
// Background color (RGBA)
$rgba = [241, 245, 248, 0];
// Set the background color
$image_bg_color = imagecolorallocatealpha($final_image, 241, 245, 248, 0);
// Convert the captcha text to an array
$captcha_code_chars = str_split($captcha_code);
// Iterate the above array
for($i = 0; $i < count($captcha_code_chars); $i++) {
    // Create the character image canvas
    $char_small = imagecreate(130, 16);
    $char_large = imagecreate(130, 16);
    // Character background color
    $char_bg_color = imagecolorallocate($char_small, 241, 245, 248);
    // Character color
    $char_color = imagecolorallocate($char_small, rand(80,180), rand(80,180), rand(80, 180));
    // Draw the character on the canvas
    imagestring($char_small, 1, 1, 0, $captcha_code_chars[$i], $char_color);
    // Copy the image and enlarge it
    imagecopyresampled($char_large, $char_small, 0, 0, 0, 0, rand(250, 400), 16, 84, 8);
    // Rotate the character image
    $char_large = imagerotate($char_large, rand(-6,6), 0);
    // Add the character image to the main canvas
    imagecopymerge($final_image, $char_large, 20 + (20 * $i), 15, 0, 0, imagesx($char_large), imagesy($char_large), 70);
    // Destroy temporary canvases
    imagedestroy($char_small);
    imagedestroy($char_large);
}
// Output the created image
header('Content-type: image/png');
imagepng($final_image);
imagedestroy($final_image);
?>