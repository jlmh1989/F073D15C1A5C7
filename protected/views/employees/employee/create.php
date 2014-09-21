<?php
/* @var $this EmployeeController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Empleados', 'url'=>array('index')),
	array('label'=>'Alta empleado', 'url'=>array('create')),
);
?>



<?php $this->renderPartial('_form', array('model'=>$model,'modelUser'=>$modelUser)); ?>