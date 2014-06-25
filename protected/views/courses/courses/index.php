<?php
/* @var $this CoursesController */
/* @var $dataProvider CActiveDataProvider */
$model->status = constantes::ACTIVO;
$this->breadcrumbs=array(
	'Courses',
);

$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
);
?>

<center><strong>Cursos Activos</strong></center>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'courses-grid',
	'dataProvider'=>$model->search(),
        'ajaxUpdate' => true,
        'columns'=> array(
            array('name'=>'desc_level',
                'header'=>'Nivel',
                'type'=>'raw',
                'value'=>'$data->fkLevel->desc_level'),
            'fkClient.client_name',
            'fkTeacher.name',
            array('name'=>'type',
                'header'=>'Tipo Curso',
                'type'=>'raw',
                'value'=>'$data->fkTypeCourse->desc_cat_detail_es'),
            /*
            array('name'=>'fk_group',
                'header'=>'Grupo',
                'type'=>'raw',
                'value'=>'$data->fkGroup->desc_group'),
             * 
             */
            'fkGroup.desc_group',
            'initial_date',
            'desc_curse',
            array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete}{update}',
                    'deleteConfirmation'=>'¿Seguro que quiere dar de baja el curso?',
                    'afterDelete'=>'$.fn.yiiGridView.update("courses-grid");',
		),
        ),
));
?>
