<?php
/* @var $this TMenuController */
/* @var $model TMenu */

$this->breadcrumbs=array(
	'Tmenus'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TMenu', 'url'=>array('index')),
	array('label'=>'Manage TMenu', 'url'=>array('admin')),
);
?>

<h1>Create TMenu</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>