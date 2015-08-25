<?php
/* @var $this TblOutputController */
/* @var $data TblOutput */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_table')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->code_table), array('view', 'id'=>$data->code_table)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tbl_output_name')); ?>:</b>
	<?php echo CHtml::encode($data->tbl_output_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deskripsi')); ?>:</b>
	<?php echo CHtml::encode($data->deskripsi); ?>
	<br />


</div>