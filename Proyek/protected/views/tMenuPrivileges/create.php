<?php
/* @var $this TMenuPrivilegesController */
/* @var $model TMenuPrivileges */

$this->breadcrumbs=array(
	'Tmenu Privileges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TMenuPrivileges', 'url'=>array('index')),
	array('label'=>'Manage TMenuPrivileges', 'url'=>array('admin')),
);
?>

<h1>Create TMenuPrivileges</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>