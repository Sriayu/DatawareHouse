<?php
/* @var $this ServerController */
/* @var $model Server */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'server-form',
	'enableAjaxValidation'=>false,
)); ?>
<html>
    <body>
        <form>
            <table>
                <tr>
                    <td><p class="note">Isi Kolom yang Bertanda <span class="required">*</span></p></td>
                    <td><?php echo $form->errorSummary($model); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model,'hostname'); ?></td>
                    <td><?php echo $form->textField($model,'hostname',array('size'=>20,'maxlength'=>20)); ?></td>
                    <td><?php echo $form->error($model,'hostname'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model,'host'); ?></td>
                    <td><?php echo $form->textField($model,'host',array('size'=>20,'maxlength'=>20)); ?></td>
                    <td><?php echo $form->error($model,'host'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model,'port'); ?></td>
                    <td><?php echo $form->textField($model,'port',array('size'=>20,'maxlength'=>20)); ?></td>
                    <td><?php echo $form->error($model,'port'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model,'username'); ?></td>
                    <td><?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?></td>
                    <td><?php echo $form->error($model,'username'); ?></td>
                </tr>
                <tr>
                    <td><?php echo $form->labelEx($model,'password'); ?></td>
                    <td><?php echo $form->passwordField($model,'password',array('size'=>20,'maxlength'=>20)); ?></td>
                    <td><?php echo $form->error($model,'password'); ?></td>
                </tr>
                <tr>
                    <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Save'); ?></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php $this->endWidget(); ?>

</div><!-- form -->
