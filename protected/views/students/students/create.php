<?php
/* @var $this StudentsController */
/* @var $model Students */
if(isset($_SESSION['crearAlumno'])){
    $this->breadcrumbs=array(
            'Cursos'=>array('teachers/teachers/cursos'),
            'Curso['.$_SESSION['crearAlumno']['descCurso'].']',
            'Nuevo Alumno',
    );
    $this->menu=array(
	array('label'=>'Cursos', 'url'=>Yii::app()->createUrl("teachers/teachers/cursos")),
    );
}else{
    $this->breadcrumbs=array(
            'Students'=>array('index'),
            'Create',
    );
    $this->menu=array(
	array('label'=>'Estudiantes', 'url'=>array('index')),
	array('label'=>'Alta estudiante', 'url'=>array('create')),
    );
}
?>

<?php $this->renderPartial('_form', array('model'=>$model,'modelUser'=>$modelUser)); ?>