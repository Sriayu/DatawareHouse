<?php
/* @var $this TblDatabaseController */
/* @var $model TblDatabase */

$this->breadcrumbs=array(
	'Tbl Databases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblDatabase', 'url'=>array('index')),
	array('label'=>'Create TblDatabase', 'url'=>array('create')),
	array('label'=>'View TblDatabase', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblDatabase', 'url'=>array('admin')),
);
?>

<h1>Update TblDatabase <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>