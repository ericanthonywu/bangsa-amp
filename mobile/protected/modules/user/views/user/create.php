<?php
$this->breadcrumbs=array(
	'Manajemen User'=>array('default/index'),
	'Tambah User Baru'
);
?>
<h1>Tambah User Baru</h1>

<?php
	echo $this->renderPartial('/user/_form', array('model'=>$model,'profile'=>$profile));
?>