<?php
/* @var $this TblAccountController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tbl Accounts',
);

$this->menu=array(
	array('label'=>'Create TblAccount', 'url'=>array('create')),
	array('label'=>'Manage TblAccount', 'url'=>array('admin')),
);
?>

<h1>Tbl Accounts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
