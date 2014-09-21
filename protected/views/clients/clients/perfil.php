<?php
/* @var $this ClientsController */
/* @var $model Clients */
/* @var $modelTEBD BillingData */
$this->breadcrumbs=array(
	'Perfil',
);

$this->menu=array(
	array('label'=>'Actualizar Perfil', 'url'=>array('updateProfile')),
);

Yii::app()->clientScript->registerScript('script',
    'if('.$model->billing_data.' !== '.constantes::SI.'){
        $(".bd").hide();
    }',
    CClientScript::POS_READY);
?>
<table class="zebra">
    <tr>
        <th class="zebra_th" colspan="4" style="text-align: center">MI PERFIL</th>
    </tr>
    <tr class="even_">
        <td width="170px" height="25px" style="font-weight: bold">Usuario:</td>
        <td><?= $model->fkUser->username ?></td>
        <td width="170px" style="font-weight: bold">Nombre del Cliente:</td>
        <td><?= $model->client_name ?></td>
    </tr>
    <tr class="odd_">
        <td width="170px" height="25px" style="font-weight: bold">Tipo de Cliente:</td>
        <td><?= $model->fkTypeClient->desc_cat_detail_es ?></td>
        <td width="170px" style="font-weight: bold"></td>
        <td></td>
    </tr>
    <tr>
        <th colspan="4" style="text-align: center">CONTACTO ADMINISTRATIVO</th>
    </tr>
    <tr class="even_">
        <td width="170px" height="25px" style="font-weight: bold">Nombre:</td>
        <td><?= $model->contact_name ?></td>
        <td width="170px" style="font-weight: bold">Correo:</td>
        <td><?= $model->contact_mail ?></td>
    </tr>
    <tr class="odd_">
        <td width="170px" height="25px" style="font-weight: bold">Tel&eacute;fono:</td>
        <td><?= $model->contact_phone ?></td>
        <td width="170px" style="font-weight: bold">Extensi&oacute;n:</td>
        <td><?= $model->contact_phone_ext ?></td>
    </tr>
    <tr class="even_">
        <td width="170px" height="25px" style="font-weight: bold">P&aacute;gina Web:</td>
        <td><?= $model->client_web ?></td>
        <td width="170px" style="font-weight: bold">Celular:</td>
        <td><?= $model->contact_cellphone ?></td>
    </tr>
    <tr class="bd">
        <th colspan="4" style="text-align: center">DATOS FISCALES</th>
    </tr>
    <tr class="even_ bd">
        <td width="170px" height="25px" style="font-weight: bold">Calle:</td>
        <td><?= $modelTEBD->street ?></td>
        <td width="170px" style="font-weight: bold">N&uacute;mero:</td>
        <td><?= $modelTEBD->street_number ?></td>
    </tr>
    <tr class="odd_ bd">
        <td width="170px" height="25px" style="font-weight: bold">N&uacute;mero Interior:</td>
        <td><?= $modelTEBD->street_number_int ?></td>
        <td width="170px" style="font-weight: bold">Raz&oacute;n Social:</td>
        <td><?= $modelTEBD->bussiness_name ?></td>
    </tr>
    <tr class="even_ bd">
        <td width="170px" height="25px" style="font-weight: bold">Municipio:</td>
        <td><?= $modelTEBD->county ?></td>
        <td width="170px" style="font-weight: bold">Colonia:</td>
        <td><?= $modelTEBD->neighborhood ?></td>
    </tr>
    <tr class="odd_ bd">
        <td width="170px" height="25px" style="font-weight: bold">Estado:</td>
        <td><?= $modelTEBD->state ?></td>
        <td width="170px" style="font-weight: bold">Pa&iacute;s:</td>
        <td><?= $modelTEBD->country ?></td>
    </tr>
    <tr class="even_ bd">
        <td width="170px" height="25px" style="font-weight: bold">C&oacute;digo Postal:</td>
        <td><?= $modelTEBD->zipcode ?></td>
        <td width="170px" style="font-weight: bold">RFC:</td>
        <td><?= $modelTEBD->rfc ?></td>
    </tr>
</table>
