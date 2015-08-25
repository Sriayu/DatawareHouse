<?php
/* @var $this TblOutputController */
/* @var $model TblOutput */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tbl-output-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'code_table'); ?>
		<?php echo $form->textField($model,'code_table',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'code_table'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tbl_output_name'); ?>
		<?php echo $form->textField($model,'tbl_output_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'tbl_output_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deskripsi'); ?>
		<?php echo $form->textField($model,'deskripsi',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'deskripsi'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->