<?php
/* @var $this CatLevelDetailController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Level Details',
);

$this->menu=array(
	array('label'=>'Create CatLevelDetail', 'url'=>array('create')),
	array('label'=>'Manage CatLevelDetail', 'url'=>array('admin')),
);
?>

<h1>Cat&aacute;logo Niveles Detalle</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=> array(
            array('name'=>'fk_level',
                'header'=>'Nivel',
                'type'=>'raw',
                'value'=>'$data->fkLevel->desc_level'),
            'topics',
            'duration',
            'unit',
            'pages',
            array('name'=>'is_exam',
                'header'=>'Es examen',
                'type'=>'raw',
                'value'=>'constantes::$opcion_si_no[$data->is_exam]'),
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
