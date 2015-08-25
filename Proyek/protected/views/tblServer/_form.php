<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="form" style="background-color:  #09f">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tbl-server-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <div class="row ">
        <?php echo $form->labelEx($model, 'hostname'); ?>
        <?php echo $form->dropDownList($model,'id', CHtml::listData(TblServer::model()->findAll(array('order' => 'hostname')),'id','hostname'),array('prompt' => '--Choose Host Profile--')); ?>
    </div>
    <div class="row buttons">
        <a href ="<?php echo $this->createURL("tblServer/daftar_database&id=$model->id");?>"><button style="size: 100px;">Search</button></a>
    </div>

    <div class="row buttons">

    </div>
<?php $this->endWidget(); ?>

</div><!-- form -->