<?php
/* @var $this TblOutputController */
/* @var $model TblOutput */

$this->breadcrumbs = array(
    'Tbl Outputs' => array('index'),
    'Manage',
);
$id = TUser::model()->findByAttributes(array('username' => "admin"));
$this->menu = array(
//	array('label'=>'List TblOutput', 'url'=>array('index')),
    array('label' => 'Add Host Profile', 'url' => array('TblServer/TambahKoneksi'),'visible' => $id->id),
    array('label' => 'Add User/Admin', 'url' => array('site/register')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#tbl-output-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Tabel Relation</h1>
<a href ="<?php echo $this->createUrl("tblServer/Simpandatabase", array("id"=>1)); ?>"><button style="width: 110px; height: 30px;"><font size="4px"><b>Add Table</b></font></button></a>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'tbl-output-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    'columns' => array(
        array(
            'header' => 'No',
            'value' => '$row+1'
        ),
        array(
            'header' => 'Table Name',
            'value' => '$data->tbl_output_name'
        ),
        array(
            'header' => 'Description',
            'value' => '$data->deskripsi'
        ),
        array(
            'header' => 'List Fields',
            'value' => '$data->list_fields'
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Action',
            'template' => '{Edit}',
            'buttons' => array
                (
                'Edit' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("tblServer/Simpandatabase")',
                ),
                /*'Delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("tblOutput/delete", array("id"=>$data->id))',
                ),*/
            ),
        ),       
    ),
));
?>
