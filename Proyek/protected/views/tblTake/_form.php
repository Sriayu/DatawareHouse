<?php
/* @var $this TblTakeController */
/* @var $model TblTake */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tbl-take-form',
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
		<?php echo $form->labelEx($model,'tbl_name'); ?>
		<?php echo $form->textField($model,'tbl_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'tbl_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attribute'); ?>
		<?php echo $form->textField($model,'attribute',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'attribute'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_database'); ?>
		<?php echo $form->textField($model,'id_database',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'id_database'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_tbl_output'); ?>
		<?php echo $form->textField($model,'id_tbl_output',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'id_tbl_output'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->