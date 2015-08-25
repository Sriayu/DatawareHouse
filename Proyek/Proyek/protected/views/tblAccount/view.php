<?php
/* @var $this TblAccountController */
/* @var $model TblAccount */

$this->breadcrumbs=array(
	'Tbl Accounts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblAccount', 'url'=>array('index')),
	array('label'=>'Create TblAccount', 'url'=>array('create')),
	array('label'=>'Update TblAccount', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblAccount', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblAccount', 'url'=>array('admin')),
);
?>

<h1>View TblAccount #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'password',
		'level',
	),
)); ?>
