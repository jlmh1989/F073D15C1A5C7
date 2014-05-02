<?php
/* @var $this CatLevelsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Levels',
);

$this->menu=array(
	array('label'=>'Create CatLevels', 'url'=>array('create')),
	array('label'=>'Manage CatLevels', 'url'=>array('admin')),
);
?>

<h1>Cat&aacute;logo Niveles</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
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
                'template'=>'{view}',
		),
        ),
)); ?>
