<?php
/* @var $this CatRatesController */
/* @var $model CatRates */

$this->breadcrumbs=array(
	'Cat Rates'=>array('index'),
	'Create',
);
$this->menu=array(
	array('label'=>'Crear Tarifa', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Tarifa', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatRates', 'url'=>array('index')),
	array('label'=>'Manage CatRates', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Crear Tarifa</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>