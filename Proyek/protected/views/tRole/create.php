<?php
/* @var $this TRoleController */
/* @var $model TRole */

$this->breadcrumbs=array(
	'Troles'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TRole', 'url'=>array('index')),
	array('label'=>'Manage TRole', 'url'=>array('admin')),
);
?>

<h1>Create TRole</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>