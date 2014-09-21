<?php
/* @var $this EmployeeController */
/* @var $model Employees */

$this->breadcrumbs=array(
	'Employees'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Employees', 'url'=>array('index')),
	array('label'=>'Create Employees', 'url'=>array('create')),
	array('label'=>'Update Employees', 'url'=>array('update', 'id'=>$model->pk_employee)),
	array('label'=>'Delete Employees', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_employee),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Employees', 'url'=>array('admin')),
);
?>

<h1>View Employees #<?php echo $model->pk_employee; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_employee',
		'fk_user',
		'name',
		'email',
		'neigborhod',
		'county',
		'phone',
		'zipcode',
		'birthdate',
		'street',
		'street_number',
		'street_number_int',
		'fk_state_dir',
		'entrance_date',
	),
)); ?>
