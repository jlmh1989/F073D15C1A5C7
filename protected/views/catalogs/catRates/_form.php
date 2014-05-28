<?php
/* @var $this CatRatesController */
/* @var $model CatRates */
/* @var $form CActiveForm */
?>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cat-rates-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        <tr>
            <td><?php echo $form->labelEx($model,'desc_tarifa'); ?></td>
            <td><?php echo $form->textField($model,'desc_tarifa',array('size'=>50,'maxlength'=>50)); ?>
            <?php echo $form->error($model,'desc_tarifa'); ?></td>

            <td><?php echo $form->labelEx($model,'rate'); ?></td>
            <td><?php echo $form->textField($model,'rate'); ?>
            <?php echo $form->error($model,'rate'); ?></td>
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