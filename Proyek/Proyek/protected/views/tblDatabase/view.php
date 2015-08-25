<?php
/* @var $this TblDatabaseController */
/* @var $model TblDatabase */

$this->breadcrumbs=array(
	'Tbl Databases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TblDatabase', 'url'=>array('index')),
	array('label'=>'Create TblDatabase', 'url'=>array('create')),
	array('label'=>'Update TblDatabase', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TblDatabase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblDatabase', 'url'=>array('admin')),
);
?>

<h1>View TblDatabase #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'database_name',
		'id_server',
	),
)); ?>
