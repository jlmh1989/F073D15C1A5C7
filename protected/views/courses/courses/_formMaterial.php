<?php
/* @var $this CoursesController */
/* @var $model LoanMaterial */
/* @var $form CActiveForm */
$tieneMaterial = 0;
if(isset($_SESSION['curso']['LoanMaterial']['tieneMaterial']) && ($_SESSION['curso']['LoanMaterial']['tieneMaterial'] == 1)){
    $tieneMaterial = true;
}
Yii::app()->clientScript->registerScript('script',
        '
        $("#irAtras").click(function(){
            $(location).attr("href","'.Yii::app()->createUrl('courses/courses/asignarMaestro').'");
        });
        $(function () {
            if('.$tieneMaterial.' == true){
                $("#LoanMaterial_tieneMaterial").prop("checked", true);
                $("#LoanMaterial_tieneMaterial").change();
            }
        });
        ',CClientScript::POS_READY); 
?>

<script>
    function validarPrestamoExistente(){
        var pkMaestro = '';
        var fkMaterialDetalle = '<?= $model->fk_material_detail != NULL ? $model->fk_material_detail : '-1' ?>';
        var opcion = '';
        $("#LoanMaterial_fk_material_detail").empty();
        $("#LoanMaterial_pick_date").prop('readonly', false);
        if($("#LoanMaterial_tieneMaterial").is(':checked')) {  
            pkMaestro = '<?= $_SESSION['curso']['maestro']['fk_teacher'] ?>';
            $("#LoanMaterial_pick_date").prop('readonly', true);
            $.ajax({
                type: "POST",
                url: "<?= Yii::app()->createUrl('courses/courses/getFechaPrestamoMaterial');?>",
                data: { pkMaestro: pkMaestro, pkMaterialDetail: fkMaterialDetalle},
                dataType: "text"
            }).done(function( msg ) {
                $("#LoanMaterial_pick_date").val(msg);
            });
        }
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('courses/courses/getCatMaterialDetail');?>",
            data: { pkMaestro: pkMaestro, pkMaterialDetail: fkMaterialDetalle},
            dataType: "text"
        }).done(function( msg ) {
            var json = $.parseJSON(msg);
            $("#LoanMaterial_fk_material_detail").append("<option value=''>Seleccione una opción</option>");
            $.each(json, function(key, value){
                opcion = "<option value='"+key+"'>"+value+"</option>";
                if(fkMaterialDetalle == key){
                    opcion = "<option value='"+key+"' selected='selected'>"+value+"</option>";
                }
                $("#LoanMaterial_fk_material_detail").append(opcion);
            });
        });
    }
    
    function cargarFechaPrestamo(){
        if($("#LoanMaterial_tieneMaterial").is(':checked')) {  
            pkMaestro = '<?= $_SESSION['curso']['maestro']['fk_teacher'] ?>';
            fkMaterialDetalle = $("#LoanMaterial_fk_material_detail").val();
            $.ajax({
                type: "POST",
                url: "<?= Yii::app()->createUrl('courses/courses/getFechaPrestamoMaterial');?>",
                data: { pkMaestro: pkMaestro, pkMaterialDetail: fkMaterialDetalle},
                dataType: "text"
            }).done(function( msg ) {
                $("#LoanMaterial_pick_date").val(msg);
            });
        }
    }
</script>

<div class="form">
    <table class="zebra">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'courses-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
        'action' => Yii::app()->createUrl('courses/courses/asignarMaterial'),
)); ?>
        
        <tr>
            <th id="material_th" colspan="4" style="text-align: center; ">
                ASIGNAR MATERIAL
            </th>
        </tr>
        
        <tr>
            <td colspan="4">
                <table>
                    <tr>
                        <td width="25x"><input type="checkbox" name="LoanMaterial[tieneMaterial]" id="LoanMaterial_tieneMaterial" value="1" onchange="validarPrestamoExistente()"></td>
                        <td><label for="tieneMaterial">El maestro ya tiene material prestado.</label></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td><?php echo $form->labelEx($model, 'fk_material_detail'); ?></td>
            <td><?php echo $form->dropDownList($model,'fk_material_detail', CatMaterialDetail::model()->getListMaterialDetail((isset($_SESSION['curso']['datos']['fk_level'])) ? $_SESSION['curso']['datos']['fk_level'] : '', $model->fk_material_detail), 
                        array(
                        "tabindex" => "0",
                        "onChange"=>"javascript:cargarFechaPrestamo();",
                        "empty" => constantes::OPCION_COMBO)
                    );?>
            <?php echo $form->error($model,'fk_material_detail'); ?></td>
            <td><?php echo $form->labelEx($model, 'pick_date'); ?></td>
            <td><?php
                    $this->widget('zii.widgets.jui.CJuiDatePicker',
                            array('attribute'=>'pick_date',
                                  'name'=>'LoanMaterial[pick_date]',
                                  'model'=>$model,
                                  'options' => array(
                                        'mode'=>'focus',
                                        'dateFormat'=> constantes::FORMATO_FECHA,
                                        'showAnim' => 'slideDown',
                                        'minDate'=>0,
                                  ),
                                  'htmlOptions'=>array('size'=>20,'class'=>'date', //'value'=>date("d F, Y")
                                  ),
                            )); 
                ?>
		<?php echo $form->error($model,'pick_date'); ?></td>
        </tr>
        <tr>
            <td><?php //echo CHtml::label('Comentario Material','',array('id'=>'comentario')); ?></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $form->labelEx($model, 'comment'); ?></td>
        </tr>
        <tr>
            <td colspan="4"><?php echo $form->textArea($model, 'comment', array('rows'=>3, 'maxlength' => 300, 'style' => 'resize: none; width : 100%')); ?>
        <?php echo $form->error($model, 'comment'); ?></td>
        </tr>
        </table>
    <table>
        <tr>
            <td width="240px"><div class="boton" id="irAtras"><< Atr&aacute;s</div></td>
            <td width="240px"><?php echo $form->hiddenField($model,'fk_teacher');
                                    echo $form->hiddenField($model,'pk_loan_material');?></td>
            <td width="240px"></td>
            <div class="row buttons">
            <td><?php echo CHtml::submitButton('Siguiente >>'); ?></td>
        </div>
        </tr>

<?php $this->endWidget(); ?>
</table>
</div><!-- form -->
        
