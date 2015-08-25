<?php
/* @var $this TblTakeController */
/* @var $data TblTake */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_table')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->code_table), array('view', 'id'=>$data->code_table)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tbl_name')); ?>:</b>
	<?php echo CHtml::encode($data->tbl_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('attribute')); ?>:</b>
	<?php echo CHtml::encode($data->attribute); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_database')); ?>:</b>
	<?php echo CHtml::encode($data->id_database); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tbl_output')); ?>:</b>
	<?php echo CHtml::encode($data->id_tbl_output); ?>
	<br />


</div>