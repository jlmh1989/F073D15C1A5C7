<?php
/* @var $this StudentsController */
/* @var $model Students */
if(Yii::app()->user->getState("rol") === constantes::ROL_CLIENTE){
    $this->breadcrumbs=array(
            'Alumnos',
            $model->name,
    );
    
    $this->menu=array(
            array('label'=>'Ver alumnos', 'url'=>Yii::app()->createUrl("clients/clients/alumnos")),
        );
}else if(Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO){
    $this->breadcrumbs=array(
            'Alumnos',
            $model->name,
    );
    
    $this->menu=array(
            array('label'=>'Ver alumnos', 'url'=>Yii::app()->createUrl("teachers/teachers/alumnos")),
        );
}else{
    $this->breadcrumbs=array(
            'Students'=>array('index'),
            $model->name,
    );

    $this->menu=array(
            array('label'=>'Estudiantes', 'url'=>array('index')),
            array('label'=>'Alta estudiante', 'url'=>array('create')),
    );
}
?>

<h3>Ver perfil estudiante <?php echo $model->name; ?></h3>

<table class="zebra">
    <tr>
        <th id="user_th" colspan="4" class="zebra_th" style="text-align: center">&MediumSpace;</th>
    </tr>
    <tr class="even_">
        <td height="30px" style="font-weight: bold">Usuario:</td>
        <td><?= $model->fkUser->username ?></td>
        <td style="font-weight: bold">Empresa:</td>
        <td width="240px"><?= $model->fkClient->client_name ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">Nombre:</td>
        <td><?= $model->name ?></td>
        <td style="font-weight: bold">Email:</td>
        <td width="240px"><?= $model->email ?></td>
    </tr>
    <tr class="even_">
        <td height="30px" style="font-weight: bold">Colonia:</td>
        <td><?= $model->neigborhod ?></td>
        <td style="font-weight: bold">Municipio:</td>
        <td width="240px"><?= $model->county ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">Tel&eacute;fono:</td>
        <td><?= $model->phone ?></td>
        <td style="font-weight: bold">C&oacute;digo Postal:</td>
        <td width="240px"><?= $model->zipcode ?></td>
    </tr>
    <tr class="even_">
        <td style="font-weight: bold">Fecha Nacimiento:</td>
        <td><?= $model->birthdate ?></td>
        <td style="font-weight: bold">Calle:</td>
        <td width="240px"><?= $model->street ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">N&uacute;mero:</td>
        <td><?= $model->street_number ?></td>
        <td style="font-weight: bold">N&uacute;mero Interior:</td>
        <td width="240px"><?= $model->street_number_int ?></td>
    </tr>
    <tr class="even_">
        <td height="30px" style="font-weight: bold">Estado:</td>
        <td><?= $model->fkStateDir->desc_cat_detail_es ?></td>
        <td></td>
        <td></td>
    </tr>
</table>
