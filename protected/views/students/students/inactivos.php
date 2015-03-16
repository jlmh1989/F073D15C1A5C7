<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index')
);

$this->menu=array(
	array('label'=>'Estudiantes Activos', 'url'=>array('index')),
        array('label'=>'Estudiantes Inactivos', 'url'=>array('inactivos')),
	array('label'=>'Alta estudiante', 'url'=>array('create')),
);
?>

<center><strong>Estudiantes Inactivos</strong></center>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'students-grid',
        'dataProvider'=>$data,
	'filter'=>$model,
	'columns'=>array(
		'name',
                'fkClient.client_name',
		'email',
		'neigborhod',
		'county',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{update}',
                    'deleteConfirmation'=>'¿Seguro que quiere dar de baja el estudiante?',
                    'afterDelete'=>'$.fn.yiiGridView.update("students-grid");',
		),
	),
)); ?>
