<?php
/* @var $this ClientsController */
/* @var $model Students */

$this->breadcrumbs=array(
	'Estudiantes'
);

$this->menu=array(
	array('label'=>'Ver alumnos', 'url'=>array('alumnos')),
);
?>

<!-- <center><strong>Estudiantes</strong></center> -->

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
                    'template'=>'{view} {update}',
                    'buttons'=>array (
                        'update'=> array(
                            'url'=>'Yii::app()->createUrl("students/students/update", array("id"=>$data->pk_student))'
                        ),
                        'view'=>array(
                            'url'=>'Yii::app()->createUrl("students/students/view", array("id"=>$data->pk_student))'
                        )
                    ),
		),
	),
)); ?>
