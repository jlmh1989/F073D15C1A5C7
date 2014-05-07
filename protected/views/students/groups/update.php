<?php
/* @var $this GroupsController */
/* @var $model Groups */

$this->breadcrumbs=array(
	'Groups'=>array('index'),
	$model->pk_group=>array('view','id'=>$model->pk_group),
	'Update',
);

$this->menu=array(
	array('label'=>'Crear Grupo', 'url'=>array('create')),
	array('label'=>'Grupos Activos', 'url'=>array('index')),
        array('label'=>'Grupos Inactivos', 'url'=>array('inactivo')),
);
?>

<h1>Actualizar Grupo <?php echo $model->pk_group; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>