<?php
/* @var $this ClassroomAddressController */
/* @var $model ClassroomAddress */

$this->breadcrumbs=array(
	'Classroom Addresses'=>array('index'),
	$model->pk_classroom_direction,
);

$this->menu=array(
	array('label'=>'List ClassroomAddress', 'url'=>array('index')),
	array('label'=>'Create ClassroomAddress', 'url'=>array('create')),
	array('label'=>'Update ClassroomAddress', 'url'=>array('update', 'id'=>$model->pk_classroom_direction)),
	array('label'=>'Delete ClassroomAddress', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_classroom_direction),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ClassroomAddress', 'url'=>array('admin')),
);
?>

<h1>View ClassroomAddress #<?php echo $model->pk_classroom_direction; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_classroom_direction',
		'fk_client',
		'street',
		'street_number',
		'street_number_int',
		'neighborhood',
		'county',
		'fk_state_dir',
		'country',
		'zipcode',
		'status',
		'phone',
	),
)); ?>
