<?php
/* @var $this TUserController */
/* @var $model TUser */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tuser-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'f_name'); ?>
		<?php echo $form->textField($model,'f_name',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'f_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

        <div class="row">
        <?php echo $form->labelEx($model, 'repassword'); ?>
        <?php echo $form->passwordField($model, 'repassword'); ?>
        <?php echo $form->error($model, 'repassword'); ?>
    </div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'id_role'); ?>
		<?php echo $form->dropDownList($model,'id_role', CHtml::listData(TRole::model()->findAll(array('order' => 'name_role')),'id','name_role'),array('prompt' => '--Choose User Role--')); ?>
		<?php echo $form->error($model,'id_role'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Register'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->