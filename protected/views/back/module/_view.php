<?php
/* @var $this ModuleController */
/* @var $data Module */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->module_id), array('view', 'id'=>$data->module_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_name')); ?>:</b>
	<?php echo CHtml::encode($data->module_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_title')); ?>:</b>
	<?php echo CHtml::encode($data->module_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_description')); ?>:</b>
	<?php echo CHtml::encode($data->module_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('module_url')); ?>:</b>
	<?php echo CHtml::encode($data->module_url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('searchable')); ?>:</b>
	<?php echo CHtml::encode($data->searchable); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('access')); ?>:</b>
	<?php echo CHtml::encode($data->access); ?>
	<br />


</div>