<?php
/* @var $this TUserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tusers',
);

$this->menu=array(
	array('label'=>'Create TUser', 'url'=>array('create')),
	array('label'=>'Manage TUser', 'url'=>array('admin')),
);
?>

<h1>Tusers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
