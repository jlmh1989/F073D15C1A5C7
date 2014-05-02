<?php
/* @var $this CatDocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Documents',
);

$this->menu=array(
	array('label'=>'Create CatDocuments', 'url'=>array('create')),
	array('label'=>'Manage CatDocuments', 'url'=>array('admin')),
);
?>

<h1>Cat&aacute;logo Documentos</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=> array(
            'pk_document',
            'desc_document',
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
