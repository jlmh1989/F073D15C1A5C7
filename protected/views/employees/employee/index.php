<?php
/* @var $this EmployeeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Employees',
);


$this->menu=array(
	array('label'=>'Empleados', 'url'=>array('index')),
	array('label'=>'Alta Empleado', 'url'=>array('create')),
);
?>

<h1>Empleados</h1>

<?php 

$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
?>