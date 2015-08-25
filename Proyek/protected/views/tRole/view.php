<?php
/* @var $this TRoleController */
/* @var $model TRole */

$this->breadcrumbs=array(
	'Troles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TRole', 'url'=>array('index')),
	array('label'=>'Create TRole', 'url'=>array('create')),
	array('label'=>'Update TRole', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TRole', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TRole', 'url'=>array('admin')),
);
?>

<h1>View TRole #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name_role',
	),
)); ?>
