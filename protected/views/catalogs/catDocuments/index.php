<?php
/* @var $this CatDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Documents',
);

$this->menu=array(
	array('label'=>'Crear Documento', 'url'=>array('create')),
	array('label'=>'Ver Documentos', 'url'=>array('index')),
);
?>

<h1>Cat&aacute;logo Documentos</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=> array(
            'pk_document',
            'desc_document',
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
