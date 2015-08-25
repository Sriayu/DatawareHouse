<?php
/* @var $this ServerController */
/* @var $model Server */

$this->breadcrumbs=array(
	'Servers'=>array('index'),
	'tambah',
);
//
//$this->menu=array(
////	array('label'=>'List Server', 'url'=>array('index')),
//	array('label'=>'Tambah Profile Host', 'url'=>array('tambah')),
//);
?>

<h1>Tambah Profile Host</h1>

<?php echo $this->renderPartial('_form_tambahKoneksi', array('model'=>$model)); ?>