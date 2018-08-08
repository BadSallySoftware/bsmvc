
<?php 
error_reporting(E_ALL); 
include "header.php";
?>
<h1><?php echo $title?></h1>
<ul>
<?php foreach($things as $item) :?>
    <li><?php echo $item; ?></li>
<?php endforeach ?>
</ul>

<?php 
include "footer.php";
?>