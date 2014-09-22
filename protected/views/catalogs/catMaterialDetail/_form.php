<?php
/* @var $this CatMaterialDetailController */
/* @var $model CatMaterialDetail */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'cat-material-detail-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        ));
        ?>
        <tr>
            <th class="zebra_th" style="text-align: center" colspan="4">
<?= $model->isNewRecord ? 'CREAR DETALLE DE MATERIAL - '.$_SESSION['CatMaterial']['desc_material'] : 'ACTUALIZAR DETALLE DE MATERIAL - '.$_SESSION['CatMaterial']['desc_material'] ?>   
            </th>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model, 'material_code'); ?></td>
            <td><?php echo $form->textField($model, 'material_code', array('size' => 45, 'maxlength' => 45)); ?>
                <?php echo $form->error($model, 'material_code'); ?></td>

            <td>
                <?php echo $form->labelEx($model, 'availability'); ?></td>
            <td width="250">
                <?php echo $form->dropDownList($model, 'availability', constantes::$opcion_estado_material, 
                    array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO)
                    ); ?>
                <?php echo $form->error($model, 'availability'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo $form->labelEx($model, 'comment'); ?>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">
                <?php echo $form->textArea($model, 'comment', array('rows'=>2, 'maxlength' => 300, 'style' => 'resize: none; width : 99%')); ?>
                <?php echo $form->error($model, 'comment'); ?>
            </td>
        </tr>
        <tr>
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
            <td><?php echo $form->hiddenField($model, 'fk_cat_material'); ?></td>
            <td></td>
            <td></td>
    </tr>
<?php $this->endWidget(); ?>
    </table>
</div><!-- form -->