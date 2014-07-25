<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */

$this->breadcrumbs=array(
	'Catálogo Detalle'=>array('index'),
	'Crear Nuevo',
);
$this->menu=array(
	array('label'=>'Crear Catálogo Detalle', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Detalle', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatDetail', 'url'=>array('index')),
	array('label'=>'Manage CatDetail', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Crear C&aacute;talogo Detalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>