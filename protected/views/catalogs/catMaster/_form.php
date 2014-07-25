<?php
/* @var $this CatMasterController */
/* @var $model CatMaster */
/* @var $form CActiveForm */
?>

<div class="form">
    <table width="100%" border="0" class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-master-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    <tr>
        <th colspan="4" class="zebra_th" style="text-align: center"><?= $model->isNewRecord ? 'Crear' : 'Actualizar' ?> C&aacute;talogo General</th>
    </tr>
    <tr>
            <td><?php echo $form->labelEx($model,'desc_cat_master'); ?></td>
		<td><?php echo $form->textField($model,'desc_cat_master',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'desc_cat_master'); ?></td>

                <td style="visibility: <?= $model->isNewRecord ? 'hidden' : 'visible' ?>"><?php echo $form->labelEx($model,'status'); ?></td>
            <td style="visibility: <?= $model->isNewRecord ? 'hidden' : 'visible' ?>"><?php echo $form->dropDownList($model,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'status'); ?></td>
        </tr>

        <tr>
	<div class="row buttons">
            <td><?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?></td>
            <td></td>
            <td></td>
            <td></td>
	</div>
        </tr>
<?php $this->endWidget(); ?>
</table>
</div><!-- form -->