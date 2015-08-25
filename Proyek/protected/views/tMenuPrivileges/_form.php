<?php
/* @var $this TMenuPrivilegesController */
/* @var $model TMenuPrivileges */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tmenu-privileges-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_id'); ?>
		<?php echo $form->textField($model,'menu_id'); ?>
		<?php echo $form->error($model,'menu_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_view'); ?>
		<?php echo $form->textField($model,'allow_view'); ?>
		<?php echo $form->error($model,'allow_view'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_add'); ?>
		<?php echo $form->textField($model,'allow_add'); ?>
		<?php echo $form->error($model,'allow_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_edit'); ?>
		<?php echo $form->textField($model,'allow_edit'); ?>
		<?php echo $form->error($model,'allow_edit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_delete'); ?>
		<?php echo $form->textField($model,'allow_delete'); ?>
		<?php echo $form->error($model,'allow_delete'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_admin'); ?>
		<?php echo $form->textField($model,'allow_admin'); ?>
		<?php echo $form->error($model,'allow_admin'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_Tambah'); ?>
		<?php echo $form->textField($model,'allow_Tambah'); ?>
		<?php echo $form->error($model,'allow_Tambah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_Simpan_database'); ?>
		<?php echo $form->textField($model,'allow_Simpan_database'); ?>
		<?php echo $form->error($model,'allow_Simpan_database'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'allow_Daftar_database'); ?>
		<?php echo $form->textField($model,'allow_Daftar_database'); ?>
		<?php echo $form->error($model,'allow_Daftar_database'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->