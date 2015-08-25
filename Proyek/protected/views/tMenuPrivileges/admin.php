<?php
/* @var $this TMenuPrivilegesController */
/* @var $model TMenuPrivileges */

$this->breadcrumbs=array(
	'Tmenu Privileges'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List TMenuPrivileges', 'url'=>array('index')),
	array('label'=>'Create TMenuPrivileges', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tmenu-privileges-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Tmenu Privileges</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'tmenu-privileges-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user_id',
		'menu_id',
		'allow_view',
		'allow_add',
		'allow_edit',
		/*
		'allow_delete',
		'allow_admin',
		'allow_Tambah',
		'allow_Simpan_database',
		'allow_Daftar_database',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
