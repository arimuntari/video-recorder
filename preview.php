<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 12/1/2020
 * Time: 9:11 PM
 */
$file = $_GET["file"];
?>
<video controls poster="/images/w3html5.gif">
    <source src="video/<?php echo $file;?>" type="video/mkv">
</video>

