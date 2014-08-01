<?php

$this->breadcrumbs = array(
    'Cursos' => array('teachers/teachers/cursos'),
    'Curso[' . $_SESSION['asistencia']['descCurso'] . ']',
    'Asistencia'
);
$this->menu = array(
    array('label' => 'Cursos', 'url' => Yii::app()->createUrl("teachers/teachers/cursos")),
);

Yii::app()->clientScript->registerScript('script',
        '
        $.ajax({
            url: "'.Yii::app()->createUrl("teachers/teachers/getCursoCalendario").'", 
            dataType: "text",
            data: { diffMes: 0},
         }).done(function( msg ) {
            if(msg !== ""){
                var arrayMsg = msg.split("@");
                $("#tablaCursoMes tbody").html(arrayMsg[0]);
                $("#tituloTabla").html("ASISTENCIA - "+arrayMsg[1]);
            }
         });
        '
        ,CClientScript::POS_READY);
?>
<script>
    var diffMes = 0;
    function atrasFecha(){
        diffMes--;
        $.ajax({
            url: "<?= Yii::app()->createUrl('teachers/teachers/getCursoCalendario'); ?>", 
            dataType: "text",
            data: { diffMes: diffMes},
         }).done(function( msg ) {
            if(msg !== ""){
                var arrayMsg = msg.split("@");
                $("#tablaCursoMes tbody").html(arrayMsg[0]);
                $("#tituloTabla").html("ASISTENCIA - "+arrayMsg[1]);
            }
         });
    }
    
    function siguienteFecha(){
        diffMes++;
        $.ajax({
            url: "<?= Yii::app()->createUrl('teachers/teachers/getCursoCalendario'); ?>", 
            dataType: "text",
            data: { diffMes: diffMes},
         }).done(function( msg ) {
            if(msg !== ""){
                var arrayMsg = msg.split("@");
                $("#tablaCursoMes tbody").html(arrayMsg[0]);
                $("#tituloTabla").html("ASISTENCIA - "+arrayMsg[1]);
            }
         });
    }
</script>
<table class="calendarioMes">
    <thead id="CalendarHead">
        <tr>
            <td style="text-align: left; "><span style="cursor: pointer" onclick="atrasFecha()">< ANTERIOR</span></td>
            <td style="text-align: center; font-weight: bold"><span id="tituloTabla"></span></td>
            <td style="text-align: right;"><span style=" cursor: pointer" onclick="siguienteFecha()">SIGUIENTE ></span></td>
        </tr>
    </thead>
</table>
<table class="MonthlyCalendar" id="tablaCursoMes">
    <thead class="CalendarHead">
        <tr>
            <th class="DateHeader first">LUN</th>
            <th class="DateHeader">MAR</th>
            <th class="DateHeader">MI&Eacute;</th>
            <th class="DateHeader">JUE</th>
            <th class="DateHeader">VIE</th>
            <th class="DateHeader">S&Aacute;B</th>
            <th class="DateHeader last">DOM</th>
        </tr>
    </thead>
    <tbody class="CalendarBody">
    </tbody>
</table>
