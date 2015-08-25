<?php
/* @var $this TblDatabaseController */
/* @var $model TblDatabase */

$this->breadcrumbs=array(
	'Tbl Databases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TblDatabase', 'url'=>array('index')),
	array('label'=>'Manage TblDatabase', 'url'=>array('admin')),
);
?>

<h1>Create TblDatabase</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>