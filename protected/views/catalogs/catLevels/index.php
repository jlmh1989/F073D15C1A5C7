<?php
/* @var $this CatLevelsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Levels',
);

$this->menu=array(
	array('label'=>'Crear Nivel', 'url'=>array('create')),
	array('label'=>'Ver Catálogo Nivel', 'url'=>array('index')),
);
?>

<h1>Cat&aacute;logo Niveles</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'columns'=> array(
            'pk_level',
            'desc_level',
            'fk_associated_book',
            'total_hours',
            array('name'=>'status',
                'header'=>'Estatus',
                'type'=>'raw',
                'value'=>'constantes::$opcion_status[$data->status]'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{update}',
		),
        ),
)); ?>
