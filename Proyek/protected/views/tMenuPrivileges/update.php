<?php
/* @var $this TMenuPrivilegesController */
/* @var $model TMenuPrivileges */

$this->breadcrumbs=array(
	'Tmenu Privileges'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TMenuPrivileges', 'url'=>array('index')),
	array('label'=>'Create TMenuPrivileges', 'url'=>array('create')),
	array('label'=>'View TMenuPrivileges', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TMenuPrivileges', 'url'=>array('admin')),
);
?>

<h1>Update TMenuPrivileges <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>