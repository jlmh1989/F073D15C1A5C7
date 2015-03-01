<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
            <div id="logo">
                <img class="imgLogo" src="images/logo-web1.png" width="120" alt="e24">
                <span class="txtLogo"><?php echo CHtml::encode(Yii::app()->name); ?></span>
            </div>
	</div><!-- header -->

	<div id="cssmenu">

            <?php 
                    if (Yii::app()->user->isGuest) {
                        $this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                            	array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login')),
                            ),
                        )); 
                    } elseif (Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA) {
                        $this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                            	array('label'=>'Home', 'url'=>array('/site/index')),
                                array('label'=>'Empleados','url'=>array('/employees/employee')),
                                array('label'=>'Clientes','url'=>array('/clients/clients')),
                                array(
                                'label'=>'Cursos',
                                'url'=>array('/courses/courses'),
                                'items'=>array(
                                    array('label'=>'Grupos', 'url'=>array('/students/groups')),
                                    ),
                                ),
                                array('label'=>'Alumnos','url'=>array('/students/students')),
                                array(
                                'label'=>'Maestros',
                                'url'=>array('/teachers/teachers'),
                                'items'=>array(
                                    array('label'=>'Materiales Prestados', 'url'=>array('/teachers/loanMaterial')),
                                    ),
                                ),
                                array(
                                'label'=>'Catálogos',
                                'url'=>array('#'),
                                'items'=>array(
                                    array('label'=>'Dias Labores', 'url'=>array('/catalogs/catBssDay')),
                                    array('label'=>'Horas Labores', 'url'=>array('/catalogs/catBssHours')),
                                    array('label'=>'Catalogo General', 'url'=>array('/catalogs/catMaster')),
                                    array('label'=>'Catalogo Detalle', 'url'=>array('/catalogs/catDetail')),
                                    array('label'=>'Documentos Maestro', 'url'=>array('/catalogs/catDocuments')),
                                    array('label'=>'Niveles', 'url'=>array('/catalogs/catLevels')),
                                    //array('label'=>'Detalle de Niveles', 'url'=>array('/catalogs/catLevelDetail')),
                                    array('label'=>'Materiales', 'url'=>array('/catalogs/catMaterial')),
                                    //array('label'=>'Material por Nivel', 'url'=>array('/catalogs/materialLevel')),
                                    array('label'=>'Tarifas', 'url'=>array('/catalogs/catRates')),
                                    array('label'=>'Estatus de Clase', 'url'=>array('/catalogs/catStatusClass')),
                                    ),
                                ),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'))
                            ),
                        ));   
                    } elseif (Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR) {
                        $this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                            	array('label'=>'Home', 'url'=>array('/site/index')),
                                array('label'=>'Empleados','url'=>array('/employees/employee')),
                                array('label'=>'Clientes','url'=>array('/clients/clients')),
                                array('label'=>'Cursos','url'=>array('/courses/courses')),
                                array('label'=>'Grupos','url'=>array('/students/groups')),
                                array('label'=>'Alumnos','url'=>array('/students/students')),
                                array(
                                'label'=>'Maestros',
                                'url'=>array('/teachers/teachers'),
                                'items'=>array(
                                    array('label'=>'Materiales Prestados', 'url'=>array('/teachers/loanMaterial')),
                                    ),
                                ),                                  
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'))
                            ),
                        ));                     
                    }elseif(Yii::app()->user->getState("rol") === constantes::ROL_ESTUDIANTE){
                        $this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                                array('label'=>'Home', 'url'=>array('/site/index')),
                                array('label'=>'Cursos','url'=>array('/courses/courses')),
                                array('label'=>'Perfil', 'url'=>array('/students/students/perfil')),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),
                                ),
                            ));
                    }elseif(Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO){
                        $this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                                array('label'=>'Home', 'url'=>array('/site/index')),
                                array('label'=>'Cursos','url'=>array('teachers/teachers/cursos')),
                                array('label'=>'Alumnos','url'=>array('/teachers/teachers/alumnos')),
                                array('label'=>'Materiales', 'url'=>array('/teachers/loanMaterial')),
                                array('label'=>'Perfil', 'url'=>array('/teachers/teachers/perfil')),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),
                                ),
                            ));
                    }elseif(Yii::app()->user->getState("rol") === constantes::ROL_CLIENTE){
                        $this->widget('zii.widgets.CMenu',array(
                            'activeCssClass' => 'active',
                            'activateParents' => true,
                            'items'=>array(
                                array('label'=>'Home', 'url'=>array('/site/index')),
                                array('label'=>'Cursos','url'=>array('/courses/courses')),
                                array('label'=>'Alumnos','url'=>array('/clients/clients/alumnos')),
                                array('label'=>'Perfil', 'url'=>array('/clients/clients/perfil')),
                                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),
                                ),
                            ));
                    }
            ?>            
            
            
            
            
            
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by <?php echo CHtml::encode(Yii::app()->name); ?>.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
