
<?php error_reporting(E_ALL); ?>
<h1><?php echo $title?></h1>
<ul>
<?php foreach($things as $item) :?>
    <li><?php echo $item; ?></li>
<?php endforeach ?>
</ul>