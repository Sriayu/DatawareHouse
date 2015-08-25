<?php
/* @var $this ServerController */
/* @var $model Server */

$this->breadcrumbs=array(
	'Tbl Servers'=>array('index'),
	'Setting',
);
//
//$this->menu=array(
////	array('label'=>'List Server', 'url'=>array('index')),
//	array('label'=>'Tambah Profile Host', 'url'=>array('tambah')),
//);
?>

<h1>Pilih waktu sinkronisasi Data Warehouse</h1>

<?php echo $this->renderPartial('_form_sinkronisasi', array('model'=>$model)); ?>