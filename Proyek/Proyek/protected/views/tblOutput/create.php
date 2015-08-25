<?php
/* @var $this TblOutputController */
/* @var $model TblOutput */

$this->breadcrumbs=array(
	'Tbl Outputs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblOutput', 'url'=>array('index')),
	array('label'=>'Manage TblOutput', 'url'=>array('admin')),
);
?>

<h1>Create TblOutput</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>