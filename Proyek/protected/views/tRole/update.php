<?php
/* @var $this TRoleController */
/* @var $model TRole */

$this->breadcrumbs=array(
	'Troles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TRole', 'url'=>array('index')),
	array('label'=>'Create TRole', 'url'=>array('create')),
	array('label'=>'View TRole', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TRole', 'url'=>array('admin')),
);
?>

<h1>Update TRole <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>