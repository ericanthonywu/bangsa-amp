<?php
/* @var $this HalamanController */

$this->breadcrumbs=array(
	'Halaman',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php 
	foreach($data as $user){
		echo $user['page_title'];
	}
	//print_r($data);
?>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>
