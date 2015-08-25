<?php
/* @var $this TRoleController */
/* @var $data TRole */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name_role')); ?>:</b>
	<?php echo CHtml::encode($data->name_role); ?>
	<br />


</div>