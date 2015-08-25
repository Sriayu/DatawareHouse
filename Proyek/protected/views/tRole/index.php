<?php
/* @var $this TRoleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Troles',
);

$this->menu=array(
	array('label'=>'Create TRole', 'url'=>array('create')),
	array('label'=>'Manage TRole', 'url'=>array('admin')),
);
?>

<h1>Troles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
