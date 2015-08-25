<?php
/* @var $this TblOutputController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Outputs',
);

$this->menu=array(
	array('label'=>'Create TblOutput', 'url'=>array('create')),
	array('label'=>'Manage TblOutput', 'url'=>array('admin')),
);
?>

<h1>Tbl Outputs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
