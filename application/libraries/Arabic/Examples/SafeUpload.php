<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Safe Upload Examples for Arabic Filename</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
</head>

<body>
<div class="Paragraph">
<h2 dir="ltr">Safe Upload Examples Output:</h2>
<p><i>PHP5 is not capable of addressing files with multi-byte characters in their names at all.</i></p>

<?php
/**
 * Example of Safe Upload Examples for Arabic Filename
 *
 * @category  I18N
 * @package   I18N_Arabic
 * @author    Khaled Al-Sham'aa <khaled@ar-php.org>
 * @copyright 2006-2011 Khaled Al-Sham'aa
 *
 * @license   LGPL <http://www.gnu.org/licenses/lgpl.txt>
 * @link      http://www.ar-php.org
 */

if (isset($_POST['submit'])) {

    include '../../Arabic.php';
    $Arabic = new I18N_Arabic('Transliteration');
    
    // Continue only if the file was uploaded via HTTP POST
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

        // Is file size less than 1 MB = 1,048,576 Byte
        if ($_FILES['image']['size'] < 1048576) {

            // Detect MIME Content-type for a file 
            $mime = mime_content_type($_FILES['image']['tmp_name']);
            
            // List of accepted MIME Content-type
            $images = array('image/jpeg', 'image/gif', 'image/png', 'image/svg+xml');

            if (in_array($mime, $images)) {

                // PHP5 is not capable of addressing files with multi-byte characters in their names at all.
                // This is why we use Transliteration functionality in Arabic class
                $filename = trim($Arabic->ar2en($_FILES['image']['name']));

                // Moves an uploaded file to a new location
                move_uploaded_file($_FILES['image']['tmp_name'], $filename);
                
                echo "<a href=\"$filename\" target=_blank>$filename</a><br />";
            } else {
                echo '<h3>You can upload image file only (i.e. gif, jpg, png, and svg)!</h3>';
            }
        } else {
            echo '<h3>You can not upload file bigger than 1MB!</h3>';
        }
    } else {
        echo '<h3>You have to select file first to upload it!</h3>';
    }
}

?>

<form  action="SafeUpload.php" method="post" enctype="multipart/form-data">

    <input name="image" type="file" size="60">

    <input name="submit" type="submit" value="Upload">

</form>

</div><br />

<div class="Paragraph">
<h2>Safe Upload Examples Code:</h2>
<?php
$code = <<< END
<?php

if(isset(\$_POST['submit'])){

    require '../../Arabic.php';
    \$Arabic = new I18N_Arabic('Transliteration');
    
    // Continue only if the file was uploaded via HTTP POST
    if (is_uploaded_file(\$_FILES['image']['tmp_name'])) {

        // Is file size less than 1 MB = 1,048,576 Byte
        if (\$_FILES['image']['size'] < 1048576) {

            // Detect MIME Content-type for a file 
            \$mime = mime_content_type(\$_FILES['image']['tmp_name']);
            
            // List of accepted MIME Content-type
            \$images = array('image/jpeg', 'image/gif', 'image/png', 'image/svg+xml');

            if (in_array(\$mime, \$images)) {

                // PHP5 is not capable of addressing files with multi-byte characters in their names at all.
                // This is why we use Transliteration functionality in Arabic class
                \$filename = trim(\$Arabic->ar2en(\$_FILES['image']['name']));
                
                // Moves an uploaded file to a new location
                move_uploaded_file (\$_FILES['image']['tmp_name'], \$filename);
                
                echo "<a href=\"\$filename\" target=_blank>\$filename</a><br />";
            } else {
                echo '<h3>You can upload image file only (i.e. gif, jpg, png, and svg)!</h3>';
            }
        } else {
            echo '<h3>You can not upload file bigger than 1MB!</h3>';
        }
    } else {
        echo '<h3>You have to select file first to upload it!</h3>';
    }
}

?>

<form  action="SafeUpload.php" method="post" enctype="multipart/form-data">

    <input name="image" type="file" size="60">

    <input name="submit" type="submit" value="Upload">

</form><br />
END;

highlight_string($code);
?>
</div>
</body>
</html>