<?php
/* @var $this TblTakeController */
/* @var $model TblTake */

$this->breadcrumbs=array(
	'Tbl Takes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblTake', 'url'=>array('index')),
	array('label'=>'Manage TblTake', 'url'=>array('admin')),
);
?>

<h1>Create TblTake</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>