<?php

class TeachersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
       
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform
				'actions'=>array('index','view','create','update','admin','delete','crearPdf','activos','inactivos','addInactivoUS','delInactivoUS'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR'
                                             .'|| Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA',
				//'users'=>array('@'),
			),
                        array('allow', // allow authenticated user to perform
				'actions'=>array('perfil','updateProfile','alumnos','cursos','crearAlumno','adminAlumnos',
                                                'adminRedirectAlumnos','deleteStudent','verAlumno','editarAlumno'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO',
				//'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
        
        public function actionPerfil(){
            $pk_usuario = Yii::app()->user->getState("pk_user");
            $model = Teachers::model()->find('fk_user='.$pk_usuario);
            
            $this->render('perfil',array(
			'model'=>$model,
            ));
        }
        
        public function actionUpdateProfile(){
            $pk_usuario = Yii::app()->user->getState("pk_user");
            $model = Teachers::model()->find('fk_user='.$pk_usuario);
            $_SESSION['updateProfile'] = TRUE;
            $this->actionUpdate($model->pk_teacher);
        }
        
        public function actionAlumnos(){
            $_SESSION['adminAlumno']['source'] = 'alumnos';
            $model=new Students('searchByTeacher');
            $model->unsetAttributes();
            if(isset($_GET['Students']))
                    $model->attributes=$_GET['Students'];

            $this->render('alumnos',array(
                    'model'=>$model,
            ));
        }
        
        public function actionCrearAlumno(){
            $pkCurso = Yii::app()->getRequest()->getParam("pkCurso");
            $pkCliente = Yii::app()->getRequest()->getParam("pkCliente");
            $pkGrupo = Yii::app()->getRequest()->getParam("pkGrupo");
            $descCurso = Yii::app()->getRequest()->getParam("descCurso");
            $_SESSION['crearAlumno']['pkCurso'] = $pkCurso;
            $_SESSION['crearAlumno']['pkCliente'] = $pkCliente;
            $_SESSION['crearAlumno']['pkGrupo'] = $pkGrupo;
            $_SESSION['crearAlumno']['descCurso'] = $descCurso;
        }
        
        public function actionAdminRedirectAlumnos(){
            $_SESSION['adminAlumno']['pkCurso'] = Yii::app()->getRequest()->getParam("pkCurso");
            $_SESSION['adminAlumno']['descCurso'] = Yii::app()->getRequest()->getParam("descCurso");
            $_SESSION['adminAlumno']['source'] = 'curso';
        }
        
        public function actionAdminAlumnos(){
            $model=new Students('searchByCourse');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Students']))
                    $model->attributes=$_GET['Students'];

            $this->render('adminAlumnos',array(
                    'model'=>$model,
            ));
        }
        
        public function actionVerAlumno(){
            $_SESSION['adminAlumno']['descCurso'] = Yii::app()->getRequest()->getParam("descCurso");
            $_SESSION['adminAlumno']['source'] = 'verAlumno';
        }
        
        public function actionEditarAlumno(){
            $_SESSION['adminAlumno']['descCurso'] = Yii::app()->getRequest()->getParam("descCurso");
            $_SESSION['adminAlumno']['source'] = 'editarAlumno';
        }
        
        /**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteStudent($id)
	{
		$model = Students::model()->findByPk($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('adminAlumnos'));
	}

        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Teachers;
                $modelCD = new CatDocuments();
                $modelUser = new Users();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Teachers']))
		{
                    $model->attributes=$_POST['Teachers'];
                    $modelCD->attributes=$_POST['CatDocuments'];
                    $modelUser->attributes=$_POST['Users'];
                    $validUser = $modelUser->validate();
                    $validate = $model->validate() && $validUser;
                    
                    if($validate){
                        $modelUser->status=  constantes::ACTIVO;
                        $modelUser->fk_role=(int)constantes::ROL_MAESTRO;
                        $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                        if($modelUser->save()){
                            $model->status=  constantes::ACTIVO;
                            $model->fk_user=$modelUser->pk_user;
                            if($model->save()){
                                //Recorrer el checkboxlist
                                foreach ($modelCD->desc_document as $id){
                                    $modelDT = new DocumentsTeachers();
                                    $modelDT->status=  constantes::ACTIVO;
                                    $modelDT->fk_teacher=$model->pk_teacher;
                                    $modelDT->fk_document=(int)$id;
                                    $modelDT->save();
                                }
                                //Guardar los nuevos horarios no disponibles
                                $this->guardarRangoHoraInactivoUS($model->pk_teacher);
                                
                                $this->redirect(array('view','id'=>$model->pk_teacher));
                            }
                        }
                    }
		}

		$this->render('create',array(
			'model'=>$model,
                        'modelCD'=>$modelCD,
                        'modelUser'=>$modelUser,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $profile = FALSE;
                if(isset($_SESSION['updateProfile'])){
                    $profile = $_SESSION['updateProfile'];
                }
		$model=$this->loadModel($id);
                $modelCD = new CatDocuments();
                $arrayDocuments = $this->loadArrayDocumentsTeachers($id);
                $modelCD->desc_document = $arrayDocuments;
                $modelUser = $this->loadModelUser($model->fk_user);
                if(!isset($_POST['Teachers']))
		{
                    $this->getRangoHoraInactivoUSBD($id);
                }
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Teachers']))
		{
                    $model->attributes=$_POST['Teachers'];
                    $modelCD->attributes=$_POST['CatDocuments'];
                    $validate = $model->validate();
                    if($profile === FALSE){
                        $modelUser->attributes=$_POST['Users'];
                        $validUser = $modelUser->validate();
                        $validate = $model->validate() && $validUser;
                    }
                    
                    if($validate){
                        
			if($model->save()){
                            if($profile === FALSE){
                                if(Users::cambiarPassword($modelUser->pk_user, $modelUser->password) === TRUE){
                                    $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                                }
                                $modelUser->save();
                            }
                            //array para nuevos registros
                            $insert = array_diff($modelCD->desc_document, $arrayDocuments);
                            //array para borrar registros
                            $delete = array_diff($arrayDocuments, $modelCD->desc_document);
                            //Recorrer el checkboxlist para eliminar
                            foreach ($delete as $idD){
                                $this->deleteModelDocument($id, (int)$idD);
                            }
                            //Recorrer el checkboxlist para unevos registros
                            foreach ($insert as $idD){
                                $modelDT = new DocumentsTeachers();
                                $modelDT->status=  constantes::ACTIVO;
                                $modelDT->fk_teacher=$model->pk_teacher;
                                $modelDT->fk_document=(int)$idD;
                                $modelDT->save();
                            }
                            
                            //Borrrar las horas no disponibles para generar las actualizadas
                            $this->deleteUnavailableSchedules($id);
                            //Guardar los nuevos horarios no disponibles
                            $this->guardarRangoHoraInactivoUS($id);
                            if($profile === FALSE){
                                $this->redirect(array('view','id'=>$model->pk_teacher));
                            }else{
                                unset($_SESSION['updateProfile']);
                                $this->redirect(array('perfil'));
                            }
                        }
                    }
		}

		$this->render('update',array(
			'model'=>$model,
                        'modelCD'=>$modelCD,
                        'modelUser'=>$modelUser,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
                $model->status = constantes::INACTIVO;
                $model->save();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('activos'));
	}
        
        public function actionCursos(){
            $this->render('cursos');
        }


        public function actionAddInactivoUS(){
            $_SESSION['inactivoUS'][Yii::app()->getRequest()->getParam("pkDay")][Yii::app()->getRequest()->getParam("idHour")]['inicio'] = Yii::app()->getRequest()->getParam("inicio");
            $_SESSION['inactivoUS'][Yii::app()->getRequest()->getParam("pkDay")][Yii::app()->getRequest()->getParam("idHour")]['fin'] = Yii::app()->getRequest()->getParam("fin");
        }
        
        public function actionDelInactivoUS(){
            unset($_SESSION['inactivoUS'][Yii::app()->getRequest()->getParam("pkDay")][Yii::app()->getRequest()->getParam("idHour")]);
        }
        
        private function guardarRangoHoraInactivoUS($pk_teacher){
            foreach ($_SESSION['inactivoUS'] as $key => $value) {
                $arrayRango = $this->getRangoHoraInactivoUS($value);
                foreach ($arrayRango as $rango) {
                    $modelUS = new UnavailableSchedule();
                    $modelUS->status = constantes::ACTIVO;
                    $modelUS->fk_teacher = $pk_teacher;
                    $modelUS->fk_bss_day = (int)$key;
                    $modelUS->initial_hour = $rango['inicio'];
                    $modelUS->final_hour = $rango['fin'];
                    $modelUS->save();
                }
            }
        }
        
        private function getRangoHoraInactivoUS($array){
            ksort($array);
            $arrayHr = array();
            $keyHour = -1;
            $hrFinTmp = "";
            $i = 0;
            $keyArrHr = 0;
            foreach ($array as $key => $val) {
                if($i == 0){
                    $arrayHr[$keyArrHr]['inicio'] = $val['inicio'];
                    $arrayHr[$keyArrHr]['fin'] = $val['fin'];
                }else{
                    if(((int)$key - $keyHour) == 1){
                        $hrFinTmp = $val['fin'];
                        $arrayHr[$keyArrHr]['fin'] = $hrFinTmp;
                    }else{
                        $arrayHr[$keyArrHr]['fin'] = $hrFinTmp;
                        $keyArrHr++;
                        $arrayHr[$keyArrHr]['inicio'] = $val['inicio'];
                        $arrayHr[$keyArrHr]['fin'] = $val['fin'];
                    }
                }
                $i++;
                $keyHour = $key;
            }
            return $arrayHr;
        }
        
        private function getRangoHoraInactivoUSBD($id = 0){
            $modelUS = UnavailableSchedule::model()->getUnavailableSchedule(constantes::ACTIVO, $id);
            $modelCatBssHours = CatBssHours::model()->getCatBssHours(constantes::ACTIVO);
            $_SESSION['inactivoUSTam'] = count($modelUS);
            $_SESSION['inactivoUS'] = array();
            //unset($_SESSION['inactivoUS']);
            foreach ($modelUS as $arrayDay) {
                $i = 0;
                $buscarInicio = true;
                foreach ($modelCatBssHours as $bssHour) {
                    if($buscarInicio){
                        if(($arrayDay->initial_hour == $bssHour->initial_hour) && ($arrayDay->final_hour == $bssHour->final_hour)){
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['inicio'] = $arrayDay->initial_hour;
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['fin'] = $arrayDay->final_hour;
                            break 1;
                        }else if($arrayDay->initial_hour == $bssHour->initial_hour){
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['inicio'] = $arrayDay->initial_hour;
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['fin'] = $arrayDay->final_hour;
                            $buscarInicio = false;
                        }
                    }else{
                        if($arrayDay->final_hour == $bssHour->final_hour){
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['inicio'] = $arrayDay->initial_hour;
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['fin'] = $arrayDay->final_hour;                            
                            break 1;
                        }else{
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['inicio'] = $arrayDay->initial_hour;
                            $_SESSION['inactivoUS'][$arrayDay->fk_bss_day][$i]['fin'] = $arrayDay->final_hour;
                        }
                    }
                    $i++;
                }
            }
        }
       
        /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
            $model=new Teachers('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Teachers']))
                    $model->attributes=$_GET['Teachers'];

            $this->render('activos',array(
                    'model'=>$model,
            ));
	}
        
        public function actionInactivos(){
            $model=new Teachers('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Teachers']))
                    $model->attributes=$_GET['Teachers'];

            $this->render('inactivos',array(
                    'model'=>$model,
            ));
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Teachers('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Teachers']))
			$model->attributes=$_GET['Teachers'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionCrearPdf(){
            $dataProvider = $_SESSION['reporte_teachers'];
            $data = $dataProvider->getData();
            $mPDF = Yii::app()->ePdf->mpdf();
            $filas = $dataProvider->getTotalItemCount();
            $tabla = '<link rel="stylesheet" type="text/css" href="'.Yii::app()->request->baseUrl.'/css/form.css" />
                    <table align="center" class="zebra">
                    <tr>
                    <th colspan="5" align="center" class="zebra_th">LISTADO DE MAESTROS '.Yii::app()->getRequest()->getParam("status").'</th>
                    </tr>
                    <tr>
                    <th>Nombre</th>
                    <th>Direcci&oacute;n</th>
                    <th>Telef&eacute;no</th>
                    <th>Correo</th>
                    <th>Fecha Nacimiento</th>
                    </tr>';
            for ($i = 0; $i < $filas; $i++) {
                $css = 'class="even_"';
                if(($i % 2) === 0){
                    $css = 'class="odd_"';
                }
                $tabla.='<tr '.$css.'>
                        <td>'.$data[$i]["name"].'</td>
                        <td>'.$data[$i]["street"].' '.$data[$i]["street_numer"].' '.$data[$i]["street_number_int"].', '.$data[$i]["county"].', '.$data[$i]["fkStateDir"]["desc_cat_detail_es"].'</td>
                        <td>'.$data[$i]["phone"].'</td>
                        <td>'.$data[$i]["email"].'</td>
                        <td>'.$data[$i]["birthdate"].'</td>
                        </tr>';
            }
            $tabla.='</table>';
            $mPDF->writeHTML($tabla);
            $mPDF->Output('Reporte Maestros '.Yii::app()->getRequest()->getParam("status").'.pdf','I'); //I: Abre en el navegador, D:Forza la descarga
            exit;
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Teachers the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Teachers::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function loadArrayDocumentsTeachers($fk_teacher){
            $criteria=new CDbCriteria;
            $criteria->select='fk_document';
            $criteria->addCondition('fk_teacher='.$fk_teacher);
            $criteria->addCondition('status='.constantes::ACTIVO);
            return CHtml::listData(DocumentsTeachers::model()->findAll($criteria),'fk_document','fk_document');
        }
        
        public function loadModelUser($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        private function deleteModelDocument($fk_teacher, $fk_document){
            $criteria=new CDbCriteria;
            $criteria->select='fk_document';
            $criteria->addCondition('fk_teacher='.$fk_teacher);
            $criteria->addCondition('fk_document='.$fk_document);
            $criteria->addCondition('status='.constantes::ACTIVO);
            DocumentsTeachers::model()->deleteAll($criteria);
        }
        
        private function deleteUnavailableSchedules($fk_teacher){
            $criteria = new CDbCriteria;
            $criteria->addCondition('fk_teacher='.$fk_teacher);
            $criteria->addCondition('status='.constantes::ACTIVO);
            UnavailableSchedule::model()->deleteAll($criteria);
        }

        /**
	 * Performs the AJAX validation.
	 * @param Teachers $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='teachers-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
