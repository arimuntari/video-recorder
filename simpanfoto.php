<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 11/24/2020
 * Time: 10:08 AM
 */

$target_dir = "video/";

$file = $_FILES['foto']['name'];
$temp_name = $_FILES['foto']['tmp_name'];
$path = pathinfo($file);
$ext = $path['extension'];
$path_filename_ext = $target_dir.time().".".$ext;
move_uploaded_file($temp_name,$path_filename_ext);