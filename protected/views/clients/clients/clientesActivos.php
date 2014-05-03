<?php
/* @var $this ClientsController */
/* @var $dataProvider CActiveDataProvider */
$model->status = constantes::ACTIVO;
$this->breadcrumbs=array(
	'Clients',
);

$this->menu=array(
	array('label'=>'Dar de Alta Cliente', 'url'=>array('create')),
        array('label'=>'Clientes Activos', 'url'=>array('index')),
        array('label'=>'Clientes Inactivos', 'url'=>array('clientesInactivos')),
    
	//array('label'=>'Manage Clients', 'url'=>array('admin')),
);
?>
<center><strong>Clientes Activos</strong></center>
<div class="search-form" style="height: 63px">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>
<?php


$this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'clients-grid',
	'dataProvider'=>$model->search(),
        'ajaxUpdate' => true,
        'columns'=> array(
            'client_name',
            'contact_phone',
            array('name'=>'contact_name',
                'header'=>'Nombre Contacto',
                'type'=>'raw',
                'value'=>'$data->contact_name'),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{delete},{update}',
                'deleteConfirmation'=>'¿Seguro que quiere dar de baja el cliente?',
                'afterDelete'=>'$.fn.yiiGridView.update("clients-grid");',
		),
        ),
));
?>
<a href="<?= Yii::app()->createUrl('clients/clients/crearPdf', array('status'=>'ACTIVOS'));?>" target="_blank">Exportar PDF</a>


