<?php
/* @var $this StudentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Students',
);

$this->menu=array(
	array('label'=>'Estudiantes', 'url'=>array('index')),
	array('label'=>'Alta estudiante', 'url'=>array('create')),
);
?>
<center><strong>Estudiantes</strong></center>

<?php 
/*
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); 
*/
$this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
        'columns'=> array(
            array('name'=>'fk_client',
                'header'=>'Cliente',
                'type'=>'raw',
                'value'=>'$data->fkClient->client_name'),
            'name',
            'email',
            'neigborhod',
            'county',
            'phone',
            array(
                'class'=>'CButtonColumn',
                'template'=>'{view}',
		),
        ),
));
?>
