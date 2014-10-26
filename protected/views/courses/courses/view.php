<?php
/* @var $this CoursesController */
/* @var $model Courses */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$model->pk_course,
);
$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
        array('label'=>'Ver Progreso', 'url'=>array('progreso')),
);
/*
$this->menu=array(
	array('label'=>'List Courses', 'url'=>array('index')),
	array('label'=>'Create Courses', 'url'=>array('create')),
	array('label'=>'Update Courses', 'url'=>array('update', 'id'=>$model->pk_course)),
	array('label'=>'Delete Courses', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pk_course),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Courses', 'url'=>array('admin')),
);
 * 
 */
?>

<h1>View Courses #<?php echo $model->pk_course; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'pk_course',
		'fk_level',
		'fk_client',
		'fk_teacher',
		'fk_type_course',
		'fk_group',
		'initial_date',
		'desc_curse',
		'other_level',
	),
)); ?>
