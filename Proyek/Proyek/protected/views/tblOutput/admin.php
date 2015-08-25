<?php
/* @var $this TblOutputController */
/* @var $model TblOutput */

$this->breadcrumbs = array(
    'Tbl Outputs' => array('index'),
    'Manage',
);

$this->menu = array(
//	array('label'=>'List TblOutput', 'url'=>array('index')),
    array('label' => 'Tambah Profile Host', 'url' => array('tblServer/tambah')),
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

<h1>Tabel and databases lists</h1>
<a href ="<?php echo $this->createUrl("tblServer/create"); ?>"><button style="width: 110px; height: 30px;"><font size="4px"><b>Add Table</b></font></button></a>

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
            'header' => 'Deskription',
            'value' => '$data->deskripsi'
        ),
        array(
            'header' => 'List Fields',
            'value' => '$data->list_fields'
        ),
        array(
            'class' => 'CButtonColumn',
            'header' => 'Action',
            'template' => '{Edit}    {Delete}',
            'buttons' => array
                (
                'Edit' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("tblServer/simpan_database", array("id"=>4))',
                ),
                'Delete' => array(
                    'label' => 'Delete',
                    'url' => 'Yii::app()->createUrl("tblOutput/Delete", array("id"=>$data->id))',
                ),
            ),
        ),       
    ),
));
?>
