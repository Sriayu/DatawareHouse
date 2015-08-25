<?php
/* @var $this TblServerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Servers',
);

$this->menu=array(
	array('label'=>'Create TblServer', 'url'=>array('create')),
	array('label'=>'Manage TblServer', 'url'=>array('admin')),
);
?>

<h1>Tbl Servers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
