<?php
/**
 * Created by PhpStorm.
 * User: Muntari
 * Date: 11/24/2020
 * Time: 9:52 AM
 */

$path    = 'video';
$files = array_diff(scandir($path), array('..', '.'));
$no=0;
?>
<table class="table table-bordered">
    <tr class="table-primary">
        <td>No.</td>
        <td>Video</td>
        <td colspan="2">Aksi</td>
    </tr>
    <?php
    foreach($files as $value){
        $no++;
        ?>
        <tr>
            <td><?php echo $no;?></td>
            <td>
                <video  width="300px" height="180px" controls >
                    <source src="video/<?php echo $value;?>" type="video/mp4">
                </video></td>
            <td align="center"><a class="btn btn-success btn-sm" href="foto/<?php echo $value;?>" download="file-image.jpeg"><i class="fa fa-download"></i> </a></td>
        </tr>
        <?php
    }
    ?>
</table>
