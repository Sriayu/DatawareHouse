<?php
/* @var $this TblDatabaseController */
/* @var $model TblDatabase */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tbl-database-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'database_name'); ?>
		<?php echo $form->textField($model,'database_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'database_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_server'); ?>
		<?php echo $form->textField($model,'id_server'); ?>
		<?php echo $form->error($model,'id_server'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->