<?php
/* @var $this CatStatusClassController */
/* @var $model CatStatusClass */

$this->breadcrumbs=array(
	'Cat Status Classes'=>array('index'),
	$model->pk_status_class=>array('view','id'=>$model->pk_status_class),
	'Update',
);
$this->menu=array(
	array('label'=>'Crear Estatus Clase', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Estatus Clase', 'url'=>array('index')),
);
/*
$this->menu=array(
	array('label'=>'List CatStatusClass', 'url'=>array('index')),
	array('label'=>'Create CatStatusClass', 'url'=>array('create')),
	array('label'=>'View CatStatusClass', 'url'=>array('view', 'id'=>$model->pk_status_class)),
	array('label'=>'Manage CatStatusClass', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>Actualizar Estatus Clase</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>