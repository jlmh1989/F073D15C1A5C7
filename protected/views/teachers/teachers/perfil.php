<?php
/* @var $this TeachersController */
/* @var $model Teachers */
$this->breadcrumbs=array(
	'Perfil',
);

$this->menu=array(
	array('label'=>'Actualizar Perfil', 'url'=>array('updateProfile')),
);
?>

<table class="zebra">
    <tr>
        <th id="user_th" colspan="4" class="zebra_th" style="text-align: center">MI PERFIL</th>
    </tr>
    <tr class="even_">
        <td width="170px" height="30px" style="font-weight: bold">Usuario:</td>
        <td><?= $model->fkUser->username ?></td>
        <td width="170px" style="font-weight: bold">Nombre:</td>
        <td><?= $model->name ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">Calle:</td>
        <td><?= $model->street ?></td>
        <td style="font-weight: bold">N&uacute;mero:</td>
        <td><?= $model->street_numer ?></td>
    </tr>
    <tr class="even_">
        <td height="30px" style="font-weight: bold">N&uacute;mero Interior:</td>
        <td><?= $model->street_number_int ?></td>
        <td style="font-weight: bold">Colonia:</td>
        <td><?= $model->neighborhood ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">Nacionalidad:</td>
        <td><?= $model->fkNationality->desc_cat_detail_es ?></td>
        <td style="font-weight: bold">Estado:</td>
        <td ><?= $model->fkStateDir->desc_cat_detail_es ?></td>
    </tr>
    <tr class="even_">
        <td height="30px"  style="font-weight: bold">Municipio:</td>
        <td><?= $model->county ?></td>
        <td style="font-weight: bold">C&oacute;digo Postal:</td>
        <td><?= $model->zipcode ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">Fecha Nacimiento:</td>
        <td><?= $model->birthdate ?></td>
        <td style="font-weight: bold">Estado de Nacimiento:</td>
        <td><?= $model->fkStateBirth->desc_cat_detail_es ?></td>
    </tr>
    <tr class="even_">
        <td height="30px" style="font-weight: bold">Educaci&oacute;n:</td>
        <td><?= $model->fkEducation->desc_cat_detail_es ?></td>
        <td style="font-weight: bold">Otra Nacionalidad:</td>
        <td><?= $model->nationality_other ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">Estatus Documento:</td>
        <td><?= $model->fkStatusDocument->desc_cat_detail_es ?></td>
        <td style="font-weight: bold">Tel&eacute;fono:</td>
        <td><?= $model->phone ?></td>
    </tr>
    <tr class="even_">
        <td height="30px" style="font-weight: bold">Celular:</td>
        <td><?= $model->cellphone ?></td>
        <td style="font-weight: bold">Correo:</td>
        <td><?= $model->email ?></td>
    </tr>
    <tr class="odd_">
        <td height="30px" style="font-weight: bold">Calificaci&oacute;n en Examen de Ingreso:</td>
        <td><?= $model->entrance_score ?></td>
        <td style="font-weight: bold">Tarifa:</td>
        <td><?= $model->rate ?></td>
    </tr>
    <tr class="even_">
        <td height="30px" style="font-weight: bold">Especificaciones:</td>
        <td><?= $model->spesification ?></td>
        <td style="font-weight: bold">Comentarios:</td>
        <td><?= $model->comments ?></td>
    </tr>
</table>