<?php
/* @var $this TMenuController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tmenus',
);

$this->menu=array(
	array('label'=>'Create TMenu', 'url'=>array('create')),
	array('label'=>'Manage TMenu', 'url'=>array('admin')),
);
?>

<h1>Tmenus</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
