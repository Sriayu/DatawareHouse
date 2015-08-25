<?php
/* @var $this TMenuPrivilegesController */
/* @var $model TMenuPrivileges */

$this->breadcrumbs=array(
	'Tmenu Privileges'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List TMenuPrivileges', 'url'=>array('index')),
	array('label'=>'Create TMenuPrivileges', 'url'=>array('create')),
	array('label'=>'Update TMenuPrivileges', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete TMenuPrivileges', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TMenuPrivileges', 'url'=>array('admin')),
);
?>

<h1>View TMenuPrivileges #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'menu_id',
		'allow_view',
		'allow_add',
		'allow_edit',
		'allow_delete',
		'allow_admin',
		'allow_Tambah',
		'allow_Simpan_database',
		'allow_Daftar_database',
	),
)); ?>
