<?php
/* @var $this TMenuPrivilegesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tmenu Privileges',
);

$this->menu=array(
	array('label'=>'Create TMenuPrivileges', 'url'=>array('create')),
	array('label'=>'Manage TMenuPrivileges', 'url'=>array('admin')),
);
?>

<h1>Tmenu Privileges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
