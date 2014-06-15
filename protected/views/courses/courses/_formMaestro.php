<?php
/* @var $this CoursesController */
/* @var $model CursoMaestro */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScript('script',
        '
        $("#irAtras").click(function(){
            $(location).attr("href","'.Yii::app()->createUrl('courses/courses/createHorario').'");
        });
        
        $(function() {
            if($("#CursoMaestro_fk_teacher").val() !== ""){
                $("#CursoMaestro_fk_teacher").change();
            }
        });
        '); 
?>
<script>
    
    function cargarDatosCurso(idCurso){
        $(".datosCurso").css("visibility", "hidden");
        $(".meter").animate({
            height: "45px"
        }, 300);
        if($("#div_curso_"+idCurso).height() <= 45){
            $("#datos_curso_"+idCurso).css("visibility", "");
            $("#div_curso_"+idCurso).animate({
            height: "130px"
            }, 300);
        }
    }
    
    function cargarCursosMaestro(id){
        $.ajax({
            url: "<?= Yii::app()->createUrl('courses/courses/getCursosHtml');?>",
            data: {pkMaestro: id},
            dataType: "text"
         }).done(function( msg ) {
             $( "#tablaCursos" ).html(msg);
             $(".meter > span").each(function() {
                $(this)
                    .data("origWidth", $(this).width())
                    .width(0)
                    .animate({
                            width: $(this).data("origWidth")
                    }, 800);
            });
         });
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
        'action' => Yii::app()->createUrl('courses/courses/asignarMaestro'),
)); ?>

        <tr>
            <th id="direccion_th" colspan="4" style="text-align: center; ">
                ASIGNAR MAESTRO
            </th>
        </tr>
        
        <tr>
            <td class="datos_td" width="240px"></td>
		<td class="datos_td" width="150px" style="text-align: center"><?php echo $form->labelEx($model,'fk_teacher'); ?></td>
                <td width="240px"><?php echo $form->dropDownList($model,'fk_teacher', Teachers::model()->getTeachers(), 
                        array(
                        "tabindex" => "0",
                        "empty" => constantes::OPCION_COMBO,
                        'onChange' => 'cargarCursosMaestro(this.value)')
                        ); ?>
		<?php echo $form->error($model,'fk_teacher'); ?></td>
                <td width="240px"></td>
        </tr>
        </table>
        <table class="zebra" align="center" width="60%" id="tablaCursos">
            
        </table> 
    <table>
        <tr>
            <td width="240px"><div class="boton" id="irAtras"><< Atr&aacute;s</div></td>
            <td width="240px"></td>
            <td width="240px"></td>
            <div class="row buttons">
            <td><?php echo CHtml::submitButton('Siguiente >>'); ?></td>
        </div>
        </tr>
<?php $this->endWidget(); ?>
</table>
</div><!-- form -->