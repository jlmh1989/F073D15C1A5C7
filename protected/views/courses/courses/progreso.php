<?php
/* @var $this CoursesController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(
        Yii::app()->clientScript->getCoreScriptUrl().
        '/jui/css/base/jquery-ui.css'
);
Yii::app()->clientScript->registerScript('script',
        '
        $(function() {
            $(".meter > div > span").each(function() {
                $(this)
                    .data("origWidth", $(this).width())
                    .width(0)
                    .animate({
                            width: $(this).data("origWidth")
                    }, 800);
            });
        });
        '); 

$model->status = constantes::ACTIVO;
$this->breadcrumbs=array(
	'Courses',
);

$this->menu=array(
	array('label'=>'Dar de Alta Curso', 'url'=>array('create')),
	array('label'=>'Cursos Activos', 'url'=>array('index')),
        array('label'=>'Cursos Inactivos', 'url'=>array('inactivos')),
        array('label'=>'Ver Progreso', 'url'=>array('progreso')),
);
?>
<script>
    function cargarDatosCurso(idCurso){
        $(".datosCurso").css("visibility", "hidden");
        $(".meter").animate({
            height: "50px"
        }, 300);
        if($("#div_curso_"+idCurso).height() <= 50){
            $("#datos_curso_"+idCurso).css("visibility", "");
            $("#div_curso_"+idCurso).animate({
            height: "210px"
            }, 300);
        }
    }
    
    function editarCurso(pkCurso){
        $(location).attr("href","<?= Yii::app()->createUrl('courses/courses/update')?>&id="+pkCurso);
    }
    
    function eliminarCurso(pkCurso){
        $( "#dialog-confirm" ).html('<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Seguro que quiere dar de baja el curso?</p>');
        $( "#dialog-confirm" ).dialog({
            resizable: false,
            height:160,
            modal: true,
            buttons: {
              "Dar de baja": function() {
                $( "#dialog-confirm" ).html('');
                $( this ).dialog( "close" );
                $(location).attr("href","<?= Yii::app()->createUrl('courses/courses/delete')?>&id="+pkCurso);
              },
              Cancelar: function() {
                $( "#dialog-confirm" ).html('');
                $( this ).dialog( "close" );
              }
            }
          });
    }
</script>

<div id="dialog-confirm" title="¿Dar de baja curso?">
</div>

<table class="zebra" align="center" width="60%" id="tablaCursos">
    <thead>
        <tr>
            <td align="center" colspan="2" style="font-weight: bold; font-size: 14px">Cursos Activos</td>
        </tr>
    </thead>
    <tbody>
        <?= Teachers::model()->getCursosHtml('', true, true);?>
    </tbody>
</table>
