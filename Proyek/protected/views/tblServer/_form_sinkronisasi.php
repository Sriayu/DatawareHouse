<?php
/* @var $this ServerController */
/* @var $model Server */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'tbl-server-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <html>
        <body>
            <form>
                <table>
                    <tr>
                        <td><p class="note">Pilih waktu sinkronisasi data warehouse: <span class="required">*</span></p></td>
                        <td><?php echo $form->errorSummary($model); ?></td>
                    </tr>
                    <tr>
                         <td><?php echo $form->labelEx($model, 'Update database setiap'); ?></td><br />
                    </tr>
                    <tr>
                       
                        <td><?php echo $form->dropDownList($model, 'id', CHtml::listData(TSetting::model()->findAll(array('order' => 'waktu_update')), 'id', 'waktu_update')); ?></td>
                       
                    </tr>
                    <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Simpan' : 'Save'); ?></td>
                    </tr>
                </table>
            </form>
        </body>
    </html>
    <?php $this->endWidget(); ?>

</div><!-- form -->
