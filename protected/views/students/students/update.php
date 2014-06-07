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
            'Alumnos',
            $model->name,
            'Actualizar perfil'
    );

    $this->menu=array(
            array('label'=>'Ver alumnos', 'url'=>Yii::app()->createUrl("clients/clients/alumnos")),
        );
    //echo '<h3>Actualizar datos del Estudiante</h3>';
} else if(Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO){ 
    $this->breadcrumbs=array(
            'Alumnos',
            $model->name,
            'Actualizar perfil'
    );

    $this->menu=array(
            array('label'=>'Ver alumnos', 'url'=>Yii::app()->createUrl("teachers/teachers/alumnos")),
        );
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