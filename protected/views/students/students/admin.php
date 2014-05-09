<?php
/* @var $this StudentsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Students'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Estudiantes', 'url'=>array('index')),
	array('label'=>'Alta estudiante', 'url'=>array('create')),
);
?>

<center><strong>Estudiantes</strong></center>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'students-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
                'fkClient.client_name',
		'email',
		'neigborhod',
		'county',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete},{update}',
                    'deleteConfirmation'=>'¿Seguro que quiere dar de baja el estudiante?',
                    'afterDelete'=>'$.fn.yiiGridView.update("students-grid");',
		),
	),
)); ?>
