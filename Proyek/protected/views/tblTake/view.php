<?php
/* @var $this TblTakeController */
/* @var $model TblTake */

$this->breadcrumbs=array(
	'Tbl Takes'=>array('index'),
	$model->code_table,
);

$this->menu=array(
	array('label'=>'List TblTake', 'url'=>array('index')),
	array('label'=>'Create TblTake', 'url'=>array('create')),
	array('label'=>'Update TblTake', 'url'=>array('update', 'id'=>$model->code_table)),
	array('label'=>'Delete TblTake', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->code_table),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TblTake', 'url'=>array('admin')),
);
?>

<h1>View TblTake #<?php echo $model->code_table; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'code_table',
		'tbl_name',
		'attribute',
		'id_database',
		'id_tbl_output',
	),
)); ?>
