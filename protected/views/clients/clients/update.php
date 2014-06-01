<?php
/* @var $this ClientsController */
/* @var $model Clients */
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
            'Clients'=>array('index'),
            $model->pk_client=>array('view','id'=>$model->pk_client),
            'Update',
    );

    $this->menu=array(
            array('label'=>'Dar de Alta Cliente', 'url'=>array('create')),
            array('label'=>'Clientes Activos', 'url'=>array('index')),
            array('label'=>'Clientes Inactivos', 'url'=>array('clientesInactivos')),
    );
    echo '<h3>Actualizar Datos del Cliente</h3>';
}
?>

<?php $this->renderPartial('_form', array('model'=>$model, 
                                          'modelTECA'=>$modelTECA, 
                                          'modelTEBD'=>$modelTEBD,
                                          'modelUser'=>$modelUser,)); ?>