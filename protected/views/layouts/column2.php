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