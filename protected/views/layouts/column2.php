<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
    <div id="sidebar">
    <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                    'title'=>'Operaciones',
            ));
            $this->widget('zii.widgets.CMenu', array(
                    'items'=>$this->menu,
                    'htmlOptions'=>array('class'=>'operations'),
            ));
            $this->endWidget();
    ?>
    </div><!-- sidebar -->
    <!-- Perfil -->
    <?php
    if((Yii::app()->user->getState("rol") === constantes::ROL_CLIENTE)
        || (Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO)
        || (Yii::app()->user->getState("rol") === constantes::ROL_ESTUDIANTE)){
    ?>
    <div id="perfil">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
                    'title'=>'Perfil',
            ));
            if(Yii::app()->user->getState("foto") === ''){
                echo CHtml::image('images/user.png', 'Foto', array());
            }else{
                $crop = new CircleCrop(realpath(Yii::app()->basePath.'/../'.Yii::app()->user->getState("foto")), 64, 64);
                $dataImg = $crop->getImagenBase64();
                echo '<img src="data:image/png;base64,'.$dataImg.'"/>';
            }
            echo '<br>';
            echo Yii::app()->user->getState("nombre");
        $this->endWidget();
        ?>
    </div>
    <?php
    }
    ?>
    <div id="broadcast">
        <?php
        $this->beginWidget('zii.widgets.CPortlet', array(
                    'title'=>'Noticias',
            ));
            echo 'Hola :)';
        $this->endWidget();
        ?>
    </div>
</div>
<?php $this->endContent(); ?>