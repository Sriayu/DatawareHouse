<?php
/* @var $this TblAccountController */
/* @var $model TblAccount */

$this->breadcrumbs=array(
	'Tbl Accounts'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TblAccount', 'url'=>array('index')),
	array('label'=>'Create TblAccount', 'url'=>array('create')),
	array('label'=>'View TblAccount', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TblAccount', 'url'=>array('admin')),
);
?>

<h1>Update TblAccount <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>