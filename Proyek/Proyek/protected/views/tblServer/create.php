<?php
/* @var $this TblServerController */
/* @var $model TblServer */

$this->breadcrumbs=array(
	'Tbl Servers'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Server', 'url'=>array('index')),
	array('label'=>'Tambah Profile Host', 'url'=>array('tambah')),
);
?>

<h1>Koneksi Ke Server</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>