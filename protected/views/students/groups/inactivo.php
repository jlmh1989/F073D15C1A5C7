<?php
/* @var $this GroupsController */
/* @var $dataProvider CActiveDataProvider */
$model->status = constantes::INACTIVO;
$this->breadcrumbs=array(
	'Groups',
);

$this->menu=array(
	array('label'=>'Crear Grupo', 'url'=>array('create')),
	array('label'=>'Grupos Activos', 'url'=>array('index')),
        array('label'=>'Grupos Inactivos', 'url'=>array('inactivo')),
);
?>

<h1>Grupos Inactivos</h1>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'group-grid',
	'dataProvider'=>$model->search(),
        'columns'=> array(
            'pk_group',
            'desc_group',
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete},{update}',
                    'deleteConfirmation'=>'¿Seguro que quiere dar de baja el grupo?',
                    'afterDelete'=>'$.fn.yiiGridView.update("group-grid");',
		),
        ),
));
?>
