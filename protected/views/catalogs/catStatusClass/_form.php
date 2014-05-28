<?php
/* @var $this CatStatusClassController */
/* @var $model CatStatusClass */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-status-class-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <td><?php echo $form->labelEx($model,'desc_status_class'); ?></td>
            <td width="250"><?php echo $form->textField($model,'desc_status_class',array('size'=>25,'maxlength'=>25)); ?>
            <?php echo $form->error($model,'desc_status_class'); ?></td>

            <td><?php echo $form->labelEx($model,'long_desc'); ?></td>
            <td><?php echo $form->textField($model,'long_desc',array('size'=>60,'maxlength'=>200)); ?>
            <?php echo $form->error($model,'long_desc'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'is_reschedule_motive'); ?></td>
            <td><?php echo $form->dropDownList($model,'is_reschedule_motive', constantes::getOpcionSiNo(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'is_reschedule_motive'); ?></td>

            <td><?php echo $form->labelEx($model,'fk_type_class'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_type_class', CatDetail::model()->getCatDetailsOptions(constantesCatalogos::TIPO_CURSO, constantes::LANG), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'fk_type_class'); ?></td>
        </tr>
        <tr>
            <td><?php echo $form->labelEx($model,'fk_role_class'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_role_class', CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ROLES_EN_CLASE, constantes::LANG), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'fk_role_class'); ?></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<?php $this->endWidget(); ?>
    </table>
</div><!-- form -->