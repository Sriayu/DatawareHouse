<?php
/* @var $this TMenuPrivilegesController */
/* @var $data TMenuPrivileges */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('menu_id')); ?>:</b>
	<?php echo CHtml::encode($data->menu_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_view')); ?>:</b>
	<?php echo CHtml::encode($data->allow_view); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_add')); ?>:</b>
	<?php echo CHtml::encode($data->allow_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_edit')); ?>:</b>
	<?php echo CHtml::encode($data->allow_edit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_delete')); ?>:</b>
	<?php echo CHtml::encode($data->allow_delete); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_admin')); ?>:</b>
	<?php echo CHtml::encode($data->allow_admin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_Tambah')); ?>:</b>
	<?php echo CHtml::encode($data->allow_Tambah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_Simpan_database')); ?>:</b>
	<?php echo CHtml::encode($data->allow_Simpan_database); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('allow_Daftar_database')); ?>:</b>
	<?php echo CHtml::encode($data->allow_Daftar_database); ?>
	<br />

	*/ ?>

</div>