<?php
/* @var $this TMenuController */
/* @var $model TMenu */

$this->breadcrumbs=array(
	'Tmenus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TMenu', 'url'=>array('index')),
	array('label'=>'Create TMenu', 'url'=>array('create')),
	array('label'=>'View TMenu', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TMenu', 'url'=>array('admin')),
);
?>

<h1>Update TMenu <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>