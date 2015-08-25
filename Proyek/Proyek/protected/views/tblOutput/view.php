<?php
/* @var $this TblOutputController */
/* @var $model TblOutput */

$this->breadcrumbs=array(
	'Tbl Outputs'=>array('index'),
	$model->code_table,
);

$this->menu=array(
	array('label'=>'List TblOutput', 'url'=>array('index')),
	array('label'=>'Create TblOutput', 'url'=>array('create')),
	array('label'=>'Update TblOutput', 'url'=>array('update', 'id'=>$model->code_table)),
	array('label'=>'Delete TblOutput', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code_table),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblOutput', 'url'=>array('admin')),
);
?>

<h1>View TblOutput #<?php echo $model->code_table; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code_table',
		'tbl_output_name',
		'deskripsi',
	),
)); ?>
