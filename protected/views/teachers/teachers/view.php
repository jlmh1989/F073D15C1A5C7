<?php
/* @var $this TeachersController */
/* @var $model Teachers */

$this->breadcrumbs=array(
	'Teachers'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Dar de Alta Maestro', 'url'=>array('create')),
	array('label'=>'Maestros Activos', 'url'=>array('index')),
        array('label'=>'Maestros Inactivos', 'url'=>array('inactivos')),
);
/*
$this->menu=array(
    
	array('label'=>'List Teachers', 'url'=>array('index')),
	array('label'=>'Create Teachers', 'url'=>array('create')),
	array('label'=>'Update Teachers', 'url'=>array('update', 'id'=>$model->pk_teacher)),
	array('label'=>'Delete Teachers', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_teacher),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Teachers', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>View Teachers #<?php echo $model->pk_teacher; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_teacher',
		'fk_rate',
		'name',
		'street',
		'street_numer',
		'street_number_int',
		'neighborhood',
		'fk_nationality',
		'fk_state_dir',
		'county',
		'zipcode',
		'birthdate',
		'fk_state_birth',
		'fk_education',
		'nationality_other',
		'fk_status_document',
		'phone',
		'cellphone',
		'email',
		'entrance_score',
		'spesification',
		'comments',
		'status',
	),
)); ?>
