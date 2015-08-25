<?php
/* @var $this TblAccountController */
/* @var $model TblAccount */

$this->breadcrumbs=array(
	'Tbl Accounts'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblAccount', 'url'=>array('index')),
	array('label'=>'Manage TblAccount', 'url'=>array('admin')),
);
?>

<h1>Create TblAccount</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>