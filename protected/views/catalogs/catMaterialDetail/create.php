<?php
/* @var $this CatMaterialDetailController */
/* @var $model CatMaterialDetail */

$this->breadcrumbs=array(
	'Catálogo Material'=>array("catalogs/catMaterial/index"),
	'Material Detalle'=>array("index"),
	'Crear',
);

$this->menu=array(
	array('label'=>'Ver Catálogo Material Detalle', 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>