<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('default/index'),
	(UserModule::t('Update')),
);
?>

<h1><?php echo  UserModule::t('Edit ').$model->username; ?></h1>

<?php
	echo $this->renderPartial('/user/_form', array('model'=>$model,'profile'=>$profile));
?>