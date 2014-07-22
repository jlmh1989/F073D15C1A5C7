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
            $("#fechaFin").text("26 Feb 2014 ");
            $("#fechaInicio").text(" 24 Feb 2014");
        '
        ,CClientScript::POS_READY);
?>
<script>
    function atrasFecha(){
        alert("Atras");
    }
    
    function siguienteFecha(){
        alert("Siguiente");
    }
</script>
<table class="zebra" id="tablaAsistencias">
    <thead>
        <tr>
            <th class="zebra_th" colspan="3" style="text-align: center; cursor: default">Asistencias - <?= $_SESSION['asistencia']['descCurso'] ?></th>
        </tr>
        <tr>
            <th style="text-align: center; cursor: default">Alumnos</th>
            <th style="text-align: center; cursor: default" width="160px"><img src="images/previous.png" width="11px" height="11px" class="imgAsistencia" onclick="atrasFecha()" /> <span id="fechaInicio"></span></th>
            <th style="text-align: center; cursor: default" width="160px"><span id="fechaFin"></span> <img src="images/next.png" width="11px" height="11px" class="imgAsistencia" onclick="siguienteFecha()" /> </th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>
