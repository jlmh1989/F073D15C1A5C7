<?php
/* @var $this CatStatusClassController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cat Status Classes',
);

$this->menu=array(
	array('label'=>'Create CatStatusClass', 'url'=>array('create')),
	array('label'=>'Manage CatStatusClass', 'url'=>array('admin')),
);
?>

<h1>Cat&aacute;logo Estatus de Clase</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=> array(
            'pk_status_class',
            'desc_status_class',
            'long_desc',
            array('name'=>'is_reschedule_motive',
                'header'=>'Reprogramado',
                'type'=>'raw',
                'value'=>'constantes::$opcion_si_no[$data->is_reschedule_motive]'),
            array('name'=>'fkTypeClass',
                'header'=>'Tipo Clase',
                'type'=>'raw',
                'value'=>'$data->fkTypeClass->desc_cat_detail_es'),
            array('name'=>'fkRoleClass',
                'header'=>'Rol en Clase',
                'type'=>'raw',
                'value'=>'$data->fkRoleClass->desc_cat_detail_es'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
		),
        ),
)); ?>
