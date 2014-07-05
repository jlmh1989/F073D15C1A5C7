<?php
/* @var $this TeachersController */
/* @var $model Students */

$this->breadcrumbs=array(
        'Cursos'=>array('teachers/teachers/cursos'),
	'Curso['.$_SESSION['adminAlumno']['descCurso'].']',
        'Admin Alumnos'
);
$this->menu=array(
	array('label'=>'Cursos', 'url'=>Yii::app()->createUrl("teachers/teachers/cursos")),
    );
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'students-grid',
	'dataProvider'=>$model->searchByCourse(),
	'filter'=>  $model,
	'columns'=>array(
		'name',
                'fkClient.client_name',
		'email',
		'neigborhod',
		'county',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view} {update} {delete}',
                    'buttons'=>array (
                        'update'=> array(
                            'url'=>'Yii::app()->createUrl("students/students/update", array("id"=>$data->pk_student))'
                        ),
                        'view'=>array(
                            'url'=>'Yii::app()->createUrl("students/students/view", array("id"=>$data->pk_student))'
                        ),
                        'delete'=>array(
                            'url'=>'Yii::app()->createUrl("teachers/teachers/deleteStudent", array("id"=>$data->pk_student))'
                        )
                    ),
                    'deleteConfirmation'=>'¿Seguro que quiere dar de baja el Estudiante?',
		),
	),
)); ?>

