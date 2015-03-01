<?php
/* @var $this LoanMaterialController */
/* @var $dataProvider CActiveDataProvider */
$titulo = 'Materiales asignados.';
if(Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA){
    $this->breadcrumbs=array(
            'Materiales prestados',
    );
    $titulo = 'Materiales prestados.';
}else{
    $this->breadcrumbs=array(
	'Materiales asignados',
    );
}
?>

<h1><?= $titulo ?></h1>

<?php 
if(Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA){
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$data,
        'columns'=> array(
            array('name'=>'fkCatMaterial',
                'header'=>'Nombre Material',
                'type'=>'raw',
                'value'=>'$data->fkCatMaterialDetail->fkCatMaterial->desc_material'),
            array('name'=>'material_code',
                'header'=>'C&oacute;digo Material',
                'type'=>'raw',
                'value'=>'$data->fkCatMaterialDetail->material_code'),
            array('name'=>'fkCourse',
                'header'=>'Curso',
                'type'=>'raw',
                'value'=>'$data->fkCourse->desc_curse'),  
            array('name'=>'pick_date',
                'header'=>'Fecha de pr&eacute;stamo',
                'type'=>'raw',
                'value'=>'$data->pick_date'),  
            array('name'=>'drop_date',
                'header'=>'Fecha l&iacute;mite de entrega',
                'type'=>'raw',
                'value'=>'$data->drop_date'),  
            array('name'=>'fkTeacher',
                'header'=>'Nombre Maestro',
                'type'=>'raw',
                'value'=>'$data->fkTeacher->name'),  
            'comment'
        ),
));
}else{
    $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$data,
        'columns'=> array(
            array('name'=>'fkCatMaterial',
                'header'=>'Nombre Material',
                'type'=>'raw',
                'value'=>'$data->fkCatMaterialDetail->fkCatMaterial->desc_material'),
            array('name'=>'material_code',
                'header'=>'C&oacute;digo Material',
                'type'=>'raw',
                'value'=>'$data->fkCatMaterialDetail->material_code'),
            array('name'=>'fkCourse',
                'header'=>'Curso',
                'type'=>'raw',
                'value'=>'$data->fkCourse->desc_curse'),  
            array('name'=>'pick_date',
                'header'=>'Fecha de pr&eacute;stamo',
                'type'=>'raw',
                'value'=>'$data->pick_date'),  
            array('name'=>'drop_date',
                'header'=>'Fecha l&iacute;mite de entrega',
                'type'=>'raw',
                'value'=>'$data->drop_date'),  
            'comment'
        ),
));
}
?>
