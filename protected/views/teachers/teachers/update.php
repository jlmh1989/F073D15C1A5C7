<?php
/* @var $this TeachersController */
/* @var $model Teachers */

if (isset($_SESSION['updateProfile'])) {
    $this->breadcrumbs = array(
        'Update',
    );

    $this->menu = array(
        array('label' => 'Ver Perfil', 'url' => array('perfil')),
    );
    echo '<h3>Actualizar mi perfil</h3>';
} else{
    $this->breadcrumbs=array(
            'Teachers'=>array('index'),
            $model->name=>array('view','id'=>$model->pk_teacher),
            'Update',
    );

    $this->menu=array(
            array('label'=>'Dar de Alta Maestro', 'url'=>array('create')),
            array('label'=>'Maestros Activos', 'url'=>array('index')),
            array('label'=>'Maestros Inactivos', 'url'=>array('inactivos')),
    );
    echo '<h3>Actualizar datos del Maestro.</h3>';
}
?>

<?php $this->renderPartial('_form', array('model'=>$model,'modelCD'=>$modelCD,'modelUser'=>$modelUser,)); ?>