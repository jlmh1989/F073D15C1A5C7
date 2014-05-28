<?php
/* @var $this CatDetailController */
/* @var $model CatDetail */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-detail-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

        <tr>
	<div class="row">
            <td><?php echo $form->labelEx($model,'desc_cat_detail_es'); ?></td>
		<td width="240px"><?php echo $form->textField($model,'desc_cat_detail_es',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'desc_cat_detail_es'); ?></td>
	</div>

	<div class="row">
            <td><?php echo $form->labelEx($model,'desc_cat_detail_en'); ?></td>
		<td><?php echo $form->textField($model,'desc_cat_detail_en',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'desc_cat_detail_en'); ?></td>
	</div>
        </tr>
        
        <tr>
	<div class="row">
            <td><?php echo $form->labelEx($model,'status'); ?></td>
            <td><?php echo $form->dropDownList($model,'status', constantes::getOpcionStatus(), constantes::getOpcionCombo()); ?>
            <?php echo $form->error($model,'status'); ?></td>
	</div>

	<div class="row">
            <td><?php echo $form->labelEx($model,'fk_cat_master'); ?></td>
		<td><?php echo $form->dropDownList($model,'fk_cat_master', CatMaster::model()->getCatMaster(), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_cat_master'); ?></td>
	</div>
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