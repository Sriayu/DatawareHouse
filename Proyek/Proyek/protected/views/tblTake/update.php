<?php
/* @var $this TblTakeController */
/* @var $model TblTake */

$this->breadcrumbs=array(
	'Tbl Takes'=>array('index'),
	$model->code_table=>array('view','id'=>$model->code_table),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblTake', 'url'=>array('index')),
	array('label'=>'Create TblTake', 'url'=>array('create')),
	array('label'=>'View TblTake', 'url'=>array('view', 'id'=>$model->code_table)),
	array('label'=>'Manage TblTake', 'url'=>array('admin')),
);
?>

<h1>Update TblTake <?php echo $model->code_table; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>