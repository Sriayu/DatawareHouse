<?php
/* @var $this TblDatabaseController */
/* @var $data TblDatabase */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('database_name')); ?>:</b>
	<?php echo CHtml::encode($data->database_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_server')); ?>:</b>
	<?php echo CHtml::encode($data->id_server); ?>
	<br />


</div>