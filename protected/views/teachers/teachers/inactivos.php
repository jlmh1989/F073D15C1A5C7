<?php
$model->status = constantes::INACTIVO;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->breadcrumbs=array(
	'Teachers',
);

$this->menu=array(
	array('label'=>'Dar de Alta Maestro', 'url'=>array('create')),
	array('label'=>'Maestros Activos', 'url'=>array('index')),
        array('label'=>'Maestros Inactivos', 'url'=>array('inactivos')),
);
?>
<center><strong>Maestros Inactivos</strong></center>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'teachers-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'name',
                array('name'=>'Direcci&oacute;n',
                      'type'=>'raw',
                      'value'=>'$data->street." ".$data->street_numer." ".$data->street_number_int.", ".$data->county.", ".$data->fkStateDir->desc_cat_detail_es'),
		//'street',
		//'street_numer',
		//'street_number_int',
                //'county',
                //array('name'=>'Estado',
                //      'type'=>'raw',
                //      'value'=>'$data->fkStateDir->desc_cat_detail_es'),
                'phone',
                'email',
                'birthdate',
                /*
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete},{update}',
                    'deleteConfirmation'=>'¿Seguro que quiere dar de baja el maestro?',
                    'afterDelete'=>'$.fn.yiiGridView.update("teachers-grid");',
		),
                */
	),
)); ?>
<a href="<?= Yii::app()->createUrl('teachers/teachers/crearPdf', array('status'=>'INACTIVOS'));?>" target="_blank">Exportar PDF</a>