<?php
/* @var $this ClientsController */
/* @var $model Clients */

$this->breadcrumbs=array(
	'Clients'=>array('index'),
	$model->pk_client=>array('view','id'=>$model->pk_client),
	'Update',
);

$this->menu=array(
        array('label'=>'Dar de Alta Cliente', 'url'=>array('create')),
        array('label'=>'Clientes Activos', 'url'=>array('index')),
        array('label'=>'Clientes Inactivos', 'url'=>array('clientesInactivos')),
        /*
	array('label'=>'List Clients', 'url'=>array('index')),
	array('label'=>'Create Clients', 'url'=>array('create')),
	array('label'=>'View Clients', 'url'=>array('view', 'id'=>$model->pk_client)),
	array('label'=>'Manage Clients', 'url'=>array('admin')),
        */
);
?>

<h3>Actualizar Datos del Cliente <?php //echo $model->pk_client; ?></h3>

<?php $this->renderPartial('_form', array('model'=>$model, 
                                          'modelTECA'=>$modelTECA, 
                                          'modelTEBD'=>$modelTEBD,
                                          'modelUser'=>$modelUser,)); ?>