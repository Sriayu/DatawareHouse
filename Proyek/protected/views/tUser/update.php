<?php
/* @var $this TUserController */
/* @var $model TUser */

$this->breadcrumbs=array(
	'Tusers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TUser', 'url'=>array('index')),
	array('label'=>'Create TUser', 'url'=>array('create')),
	array('label'=>'View TUser', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TUser', 'url'=>array('admin')),
);
?>

<h1>Update TUser <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>