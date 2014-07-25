<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */

$this->breadcrumbs=array(
	'Catálogo Detalle'=>array('index'),
	$model->desc_cat_detail_es=>array('view','id'=>$model->pk_cat_detail),
	'Actualizar',
);
$this->menu=array(
	array('label'=>'Crear Catálogo Detalle', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Detalle', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatDetail', 'url'=>array('index')),
	array('label'=>'Create CatDetail', 'url'=>array('create')),
	array('label'=>'View CatDetail', 'url'=>array('view', 'id'=>$model->pk_cat_detail)),
	array('label'=>'Manage CatDetail', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Actualizar Cat&aacute;logo Detalle</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>