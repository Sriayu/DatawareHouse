<?php
/* @var $this TMenuController */
/* @var $model TMenu */

$this->breadcrumbs=array(
	'Tmenus'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TMenu', 'url'=>array('index')),
	array('label'=>'Create TMenu', 'url'=>array('create')),
	array('label'=>'Update TMenu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TMenu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TMenu', 'url'=>array('admin')),
);
?>

<h1>View TMenu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'parent_id',
		'menu_name',
		'menu_controller',
	),
)); ?>
