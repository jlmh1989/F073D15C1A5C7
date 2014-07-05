<?php
/* @var $this TeachersController */

Yii::app()->clientScript->registerScript('script',
        '
        $(function() {
            $(".meter > span").each(function() {
                $(this)
                    .data("origWidth", $(this).width())
                    .width(0)
                    .animate({
                            width: $(this).data("origWidth")
                    }, 800);
            });
        });
        '); 

$pk_usuario = Yii::app()->user->getState("pk_user");
$model = Teachers::model()->find('fk_user=' . $pk_usuario);

$this->breadcrumbs = array(
    'Cursos'
);

$this->menu = array(
    array('label' => 'Horario', 'url' => array('horario')),
);
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
            height: "200px"
            }, 300);
        }
    }
    
    function agregarAlumno(pkCurso, pkCliente, pkGrupo, descCurso){
        $.ajax({
            type: "POST",
            url : "<?= Yii::app()->createUrl('teachers/teachers/crearAlumno')?>",
            data : {pkCurso : pkCurso, pkCliente : pkCliente, pkGrupo : pkGrupo, descCurso: descCurso}
        })
        .done(function (msg){
            $(location).attr("href","<?= Yii::app()->createUrl('students/students/create')?>");
        });
    }
    
    function adminAlumnos(pkCurso, pkCliente ,pkGrupo, descCurso){
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('teachers/teachers/adminRedirectAlumnos')?>",
            data: {pkCurso : pkCurso, pkCliente : pkCliente, pkGrupo : pkGrupo, descCurso : descCurso}
        }).done(function (msg){
            $(location).attr("href","<?= Yii::app()->createUrl('teachers/teachers/adminAlumnos')?>");
        });
    }
    
    function verAlumno(pkStudent, descCurso){
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('teachers/teachers/verAlumno')?>",
            data: {descCurso : descCurso}
        }).done(function (msg){
            $(location).attr("href","<?= Yii::app()->createUrl('students/students/view')?>&id="+pkStudent);
        });
    }
    
    function editarAlumno(pkStudent, descCurso){
        $.ajax({
            type: "POST",
            url: "<?= Yii::app()->createUrl('teachers/teachers/editarAlumno')?>",
            data: {descCurso : descCurso}
        }).done(function (msg){
            $(location).attr("href","<?= Yii::app()->createUrl('students/students/update')?>&id="+pkStudent);
        });
    }
</script>

<table class="zebra" align="center" width="60%" id="tablaCursos">
    <thead>
        <tr>
            <td align="center" colspan="2" style="font-weight: bold; font-size: 14px">Cursos Activos</td>
        </tr>
    </thead>
    <tbody>
        <?= Teachers::model()->getCursosHtml($model->pk_teacher, false);?>
    </tbody>
</table> 

