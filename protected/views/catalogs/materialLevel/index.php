<?php
/* @var $this MaterialLevelController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Material Levels',
);

$this->menu=array(
	array('label'=>'Create MaterialLevel', 'url'=>array('create')),
	array('label'=>'Manage MaterialLevel', 'url'=>array('admin')),
);
?>

<h1>Cat&aacute;logo Material Niveles</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=> array(
            'fk_level',
            'fk_material',
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
		),
        ),
)); ?>
