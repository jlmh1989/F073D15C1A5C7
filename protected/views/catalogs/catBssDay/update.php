<?php
/* @var $this CatBssDayController */
/* @var $model CatBssDay */

$this->breadcrumbs=array(
	'Cat Bss Days'=>array('index'),
	$model->pk_bss_day=>array('view','id'=>$model->pk_bss_day),
	'Update',
);

$this->menu=array(
        array('label'=>'Ver Catálogo Día Laboral', 'url'=>array('index')),
	array('label'=>'Crear Día Laboral', 'url'=>array('create')),
);
/*
$this->menu=array(
	array('label'=>'List CatBssDay', 'url'=>array('index')),
	array('label'=>'Create CatBssDay', 'url'=>array('create')),
	array('label'=>'View CatBssDay', 'url'=>array('view', 'id'=>$model->pk_bss_day)),
	array('label'=>'Manage CatBssDay', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Actualizar D&iacute;a Laboral</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>