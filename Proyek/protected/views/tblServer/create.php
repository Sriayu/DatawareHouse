<?php
/* @var $this TblServerController */
/* @var $model TblServer */

$this->breadcrumbs=array(
	'Tbl Servers'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Server', 'url'=>array('index')),
	array('label'=>'Add Host Profile', 'url'=>array('TambahKoneksi')),
);
?>

<h1 align="center">Connection to Server</h1>

<font align="center"><?php echo $this->renderPartial('_form', array('model'=>$model)); ?></font>