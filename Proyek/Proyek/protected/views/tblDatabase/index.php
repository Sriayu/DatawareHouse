<?php
/* @var $this TblDatabaseController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Databases',
);

$this->menu=array(
	array('label'=>'Create TblDatabase', 'url'=>array('create')),
	array('label'=>'Manage TblDatabase', 'url'=>array('admin')),
);
?>

<h1>Tbl Databases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
