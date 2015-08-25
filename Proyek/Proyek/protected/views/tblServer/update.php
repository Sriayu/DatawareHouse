<?php
/* @var $this TblServerController */
/* @var $model TblServer */

$this->breadcrumbs=array(
	'Tbl Servers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
$this->menu=array(
	array('label'=>'List TblServer', 'url'=>array('index')),
	array('label'=>'Create TblServer', 'url'=>array('create')),
	array('label'=>'View TblServer', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblServer', 'url'=>array('admin')),
);
?>

<h1>Update TblServer <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>