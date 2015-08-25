<?php
/* @var $this TblTakeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Takes',
);

$this->menu=array(
	array('label'=>'Create TblTake', 'url'=>array('create')),
	array('label'=>'Manage TblTake', 'url'=>array('admin')),
);
?>

<h1>Tbl Takes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
