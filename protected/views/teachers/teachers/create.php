<?php
/* @var $this TeachersController */
/* @var $model Teachers */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Dar de Alta Maestro', 'url'=>array('create')),
	array('label'=>'Maestros Activos', 'url'=>array('index')),
        array('label'=>'Maestros Inactivos', 'url'=>array('inactivos')),
);
?>

<?php $this->renderPartial('_form', array(
                            'model'=>$model,
                            'modelCD'=>$modelCD,
                            'modelUser'=>$modelUser,)); ?>