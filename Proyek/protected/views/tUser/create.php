<?php
/* @var $this TUserController */
/* @var $model TUser */

$this->breadcrumbs=array(
	'Tusers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TUser', 'url'=>array('index')),
	array('label'=>'Manage TUser', 'url'=>array('admin')),
);
?>

<h1>Create TUser</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>