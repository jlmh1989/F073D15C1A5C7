<?php
/* @var $this EmployeeController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->name=>array('view','id'=>$model->pk_employee),
	'Update',
);

$this->menu=array(
	array('label'=>'List Employees', 'url'=>array('index')),
	array('label'=>'Create Employees', 'url'=>array('create')),
	array('label'=>'View Employees', 'url'=>array('view', 'id'=>$model->pk_employee)),
	array('label'=>'Manage Employees', 'url'=>array('admin')),
);
?>

<h1>Update Employees <?php echo $model->pk_employee; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>