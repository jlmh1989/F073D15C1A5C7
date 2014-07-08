<?php
Yii::app()->clientScript->registerCoreScript('jquery');
$this->breadcrumbs = array(
    'Cursos' => array('teachers/teachers/cursos'),
    'Curso[' . $_SESSION['crearAlumno']['descCurso'] . ']',
    'Agregar Alumno'
);
$this->menu = array(
    array('label' => 'Cursos', 'url' => Yii::app()->createUrl("teachers/teachers/cursos")),
    array('label' => 'Nuevo Alumno', 'url' => Yii::app()->createUrl("students/students/create")),
);
?>
<script>
    function agregarAlumno(){
        if($('#CheckBoxGroupEst:checked').length > 0){
            $('#CheckBoxGroupEst:checked').each(function (){
                $.ajax({
                    type: "POST",
                    async:false,    
                    cache:false,
                    url : "<?= Yii::app()->createUrl('teachers/teachers/agregarAlumnoCurso')?>",
                    data : {pkEstudiante : this.value}
                });
            });
            window.location = "<?= Yii::app()->createUrl('teachers/teachers/cursos')?>";
        }else{
            alert("Seleccione al menos un estudiante.");
        }
    }
    
    function nuevoAlumno(){
        window.location = "<?= Yii::app()->createUrl('students/students/create')?>";
    }
</script>
<div class="form">
    <table class="zebra">
        <tr>
            <th class="zebra_th" id="direccion_th" colspan="4" style="text-align: center; font-weight: bold">
                SELECCIONAR ALUMNO
            </th>
        </tr>
    </table>
    <table class="zebra" id="tablaAlumnos">
        <tbody>
            <?= TeachersController::actionGetAlumnosHtml() ?>
        </tbody>
    </table>
    <hr>
    <table class="zebra">
        <tr>
            <td width="240px"><div class="boton" id="agregar" onclick="agregarAlumno()">Agregar</div></td>
            <td width="240px"></td>
            <td width="240px"></td>
            <td><div class="boton" id="nuevo" onclick="nuevoAlumno()">Nuevo</div></td>
        </tr>
    </table>
</div><!-- form -->
