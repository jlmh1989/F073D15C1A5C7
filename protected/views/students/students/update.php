<?php

/* @var $this StudentsController */
/* @var $model Students */
//if (isset($_SESSION['updateProfile'])) {
if(Yii::app()->user->getState("rol") === constantes::ROL_ESTUDIANTE){
    $this->breadcrumbs = array(
        'Actualizar mi perfil',
    );

    $this->menu = array(
        array('label' => 'Ver Perfil', 'url' => array('perfil')),
    );
    //echo '<h3>Actualizar mi perfil</h3>';
} else if(Yii::app()->user->getState("rol") === constantes::ROL_CLIENTE){ 
    $this->breadcrumbs=array(
            'Alumnos'=>array("clients/clients/alumnos"),
            $model->name,
            'Actualizar perfil'
    );

    $this->menu=array(
            array('label'=>'Ver alumnos', 'url'=>Yii::app()->createUrl("clients/clients/alumnos")),
        );
    //echo '<h3>Actualizar datos del Estudiante</h3>';
} else if(Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO){ 
    if($_SESSION['adminAlumno']['source'] === 'curso'){
        $this->breadcrumbs=array(
            'Cursos'=>array('teachers/teachers/cursos'),
            'Curso['.$_SESSION['adminAlumno']['descCurso'].']',
            'Admin Alumnos'=>array("teachers/teachers/adminAlumnos"),
            $model->name,
            "Actualizar Perfil"
        );
        $this->menu=array(
                array('label'=>'Admin alumnos', 'url'=>Yii::app()->createUrl("teachers/teachers/adminAlumnos")),
        );
    }elseif($_SESSION['adminAlumno']['source'] === 'alumnos'){
        $this->breadcrumbs=array(
            'Alumnos'=>array("teachers/teachers/alumnos"),
            $model->name,
            'Actualizar perfil'
        );
        $this->menu=array(
                array('label'=>'Ver alumnos', 'url'=>Yii::app()->createUrl("teachers/teachers/alumnos")),
        );
    }elseif ($_SESSION['adminAlumno']['source'] === 'editarAlumno') {
        $this->breadcrumbs=array(
            'Cursos'=>array('teachers/teachers/cursos'),
            'Curso['.$_SESSION['adminAlumno']['descCurso'].']',
            $model->name,
            'Actualizar Perfil'
        );
        $this->menu=array(
                array('label'=>'Cursos', 'url'=>Yii::app()->createUrl("teachers/teachers/cursos")),
        );
    }
    
    //echo '<h3>Actualizar datos del Estudiante</h3>';
} else {
    $this->breadcrumbs = array(
        'Students' => array('index'),
        $model->name => array('view', 'id' => $model->pk_student),
        'Actualizar datos',
    );

    $this->menu = array(
        array('label' => 'Estudiantes', 'url' => array('index')),
        array('label' => 'Alta estudiante', 'url' => array('create')),
    );
    //echo '<h3>Actualizar datos del Estudiante</h3>';
}
?>

<?php $this->renderPartial('_form', array('model' => $model, 'modelUser' => $modelUser,)); ?>