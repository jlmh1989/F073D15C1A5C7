<?php
/* @var $this StudentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Students',
);

$this->menu=array(
	array('label'=>'Create Students', 'url'=>array('create')),
	array('label'=>'Manage Students', 'url'=>array('admin')),
);
?>

<h1>Estudiantes</h1>

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
