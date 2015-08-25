<?php
/* @var $this TblServerController */
/* @var $model TblServer */

$this->breadcrumbs=array(
	'Tbl Servers'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblServer', 'url'=>array('index')),
	array('label'=>'Create TblServer', 'url'=>array('create')),
	array('label'=>'Update TblServer', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblServer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblServer', 'url'=>array('admin')),
);
?>

<h1>View TblServer #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'hostname',
		'port',
		'host',
		'username',
		'password',
	),
)); ?>
