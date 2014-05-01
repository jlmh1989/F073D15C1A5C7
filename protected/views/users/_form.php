<?php
/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">
<table width="100%" border="0">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <tr>
	<div class="row">
            <td><?php echo $form->labelEx($model,'username'); ?></td>
		<td><?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'username'); ?></td>
	</div>

	<div class="row">
            <td><?php echo $form->labelEx($model,'password'); ?></td>
		<td><?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?></td>
	</div>
        </tr>
        
        <tr>
            <div class="row">
            <td><?php echo $form->labelEx($model,'fk_role'); ?></td>
		<td><?php echo $form->dropDownList($model,'fk_role',  CatDetail::model()->getCatDetailsOptions(constantesCatalogos::ROL_USUARIO,  constantes::LANG), constantes::getOpcionCombo()); ?>
		<?php echo $form->error($model,'fk_role'); ?></td>
	</div>
            
	<div class="row">
            <td><?php echo $form->labelEx($model,'status'); ?></td>
		<td><?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?></td>  
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