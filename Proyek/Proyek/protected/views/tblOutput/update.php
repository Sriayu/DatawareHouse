<?php
/* @var $this TblOutputController */
/* @var $model TblOutput */

$this->breadcrumbs=array(
	'Tbl Outputs'=>array('index'),
	$model->code_table=>array('view','id'=>$model->code_table),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblOutput', 'url'=>array('index')),
	array('label'=>'Create TblOutput', 'url'=>array('create')),
	array('label'=>'View TblOutput', 'url'=>array('view', 'id'=>$model->code_table)),
	array('label'=>'Manage TblOutput', 'url'=>array('admin')),
);
?>

<h1>Update TblOutput <?php echo $model->code_table; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>