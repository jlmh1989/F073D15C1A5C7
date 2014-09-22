<?php
/* @var $this CatMaterialDetailController */
/* @var $model CatMaterialDetail */

$this->breadcrumbs=array(
	 'Catálogo Material'=>array("catalogs/catMaterial/index"),
	'Material Detalle'=>array("index"),
	'Actualizar['.$model->pk_material_detail.']',
);

$this->menu=array(
        array('label'=>'Crear Material Detalle', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Material Detalle', 'url'=>array('index')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>