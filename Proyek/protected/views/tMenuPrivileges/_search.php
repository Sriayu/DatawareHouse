<?php
/* @var $this TMenuPrivilegesController */
/* @var $model TMenuPrivileges */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'menu_id'); ?>
		<?php echo $form->textField($model,'menu_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_view'); ?>
		<?php echo $form->textField($model,'allow_view'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_add'); ?>
		<?php echo $form->textField($model,'allow_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_edit'); ?>
		<?php echo $form->textField($model,'allow_edit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_delete'); ?>
		<?php echo $form->textField($model,'allow_delete'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_admin'); ?>
		<?php echo $form->textField($model,'allow_admin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_Tambah'); ?>
		<?php echo $form->textField($model,'allow_Tambah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_Simpan_database'); ?>
		<?php echo $form->textField($model,'allow_Simpan_database'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'allow_Daftar_database'); ?>
		<?php echo $form->textField($model,'allow_Daftar_database'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->