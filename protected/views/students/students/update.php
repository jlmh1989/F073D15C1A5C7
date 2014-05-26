<?php

/* @var $this StudentsController */
/* @var $model Students */
if (isset($_SESSION['updateProfile'])) {
    $this->breadcrumbs = array(
        'Update',
    );

    $this->menu = array(
        array('label' => 'Ver Perfil', 'url' => array('perfil')),
    );
    echo '<h3>Actualizar mi perfil</h3>';
} else {
    $this->breadcrumbs = array(
        'Students' => array('index'),
        $model->name => array('view', 'id' => $model->pk_student),
        'Update',
    );

    $this->menu = array(
        array('label' => 'Estudiantes', 'url' => array('index')),
        array('label' => 'Alta estudiante', 'url' => array('create')),
    );
    echo '<h3>Actualizar datos del Estudiante</h3>';
}
?>

<?php $this->renderPartial('_form', array('model' => $model, 'modelUser' => $modelUser,)); ?>