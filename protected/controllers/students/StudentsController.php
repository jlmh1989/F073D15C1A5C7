<?php

class StudentsController extends Controller
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
				'actions'=>array('index','inactivos','view','create','update','admin','delete','crearPdf'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ADMINISTRADOR'
                                             .'|| Yii::app()->user->getState("rol") === constantes::ROL_ADMIN_SISTEMA',
			),
                        array('allow', // allow authenticated user to perform
				'actions'=>array('perfil','updateProfile'),
                                'expression'=>'Yii::app()->user->getState("rol") === constantes::ROL_ESTUDIANTE',
			),
                        array('allow', // allow authenticated user to perform
				'actions'=>array('create','view','update'),
                                'expression'=>'(Yii::app()->user->getState("rol") === constantes::ROL_CLIENTE) '
                                                .'|| (Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO)',
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
            if(Yii::app()->user->getState("rol") === constantes::ROL_CLIENTE){
                $pk_usuario = Yii::app()->user->getState("pk_user");
                $modelC = Clients::model()->find('fk_user='.$pk_usuario);
                $criteria=new CDbCriteria;
                $criteria->select='pk_student';
                $criteria->addCondition('pk_student='.$id);
                $criteria->addCondition('fk_client='.$modelC->pk_client);
                $modelS = Students::model()->find($criteria);
                if($modelS){
                    $this->render('view',array(
			'model'=>$this->loadModel($id),
                    ));
                }else{
                    throw new CHttpException(403, 'No tiene permisos para ejecutar la operacion solicitada.');
                }
            }else if(Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO){
                $pk_usuario = Yii::app()->user->getState("pk_user");
                $modelT = Teachers::model()->find('fk_user='.$pk_usuario);
                $criteria = new CDbCriteria;
                $criteria->distinct=true;
                $criteria->select = 't.*';
                $criteria->join ='INNER JOIN TBL_E24_CLIENTS ON t.FK_CLIENT = TBL_E24_CLIENTS.PK_CLIENT '
                                .'INNER JOIN TBL_E24_COURSES ON TBL_E24_CLIENTS.PK_CLIENT = TBL_E24_COURSES.FK_CLIENT';
                $criteria->condition = 'TBL_E24_COURSES.FK_TEACHER = :pkTeacher AND t.pk_student = :pkStudents';
                $criteria->params = array(":pkTeacher" => $modelT->pk_teacher,":pkStudents" => $id);
                $modelS =  Students::model()->find($criteria);
                if($modelS){
                    $this->render('view',array(
			'model'=>$this->loadModel($id),
                    ));
                }else{
                    throw new CHttpException(403, 'No tiene permisos para ejecutar la operacion solicitada.');
                }
            }else{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
            }
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Students;
                $modelUser = new Users();
                
                if(isset($_SESSION['crearAlumno'])){
                    $model->fk_client = $_SESSION['crearAlumno']['pkCliente'];
                }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Students']))
		{
                    $model->attributes=$_POST['Students'];
                    $modelUser->attributes=$_POST['Users'];
                    $validUser = $modelUser->validate();
                    $validate = $model->validate() && $validUser;
                    
                    if($validate){
                        $modelUser->status=  constantes::ACTIVO;
                        $modelUser->fk_role=(int)constantes::ROL_ESTUDIANTE;
                        $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                        if($modelUser->save()){
                            $model->fk_user=$modelUser->pk_user;
                            if($model->save()){
                                if(isset($_SESSION['crearAlumno'])){
                                    $group = new StudentsGroup();
                                    $group->fk_client = $_SESSION['crearAlumno']['pkCliente'];
                                    $group->fk_group = $_SESSION['crearAlumno']['pkGrupo'];
                                    $group->fk_student = $model->pk_student;
                                    $group->status = constantes::ACTIVO;
                                    $group->save();
                                    unset($_SESSION['crearAlumno']);
                                    $this->redirect(array('teachers/teachers/cursos'));
                                }else {
                                    $this->redirect(array('view','id'=>$model->pk_student));
                                }
                            }
                                
                        }
                    }
		}

		$this->render('create',array(
			'model'=>$model,
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
            $opcionUsuario = 0; //0 = admin,admin_sist, 1 = perfil, 2 = cliente, 3 = maestro
            if(Yii::app()->user->getState("rol") === constantes::ROL_CLIENTE){
                $pk_usuario = Yii::app()->user->getState("pk_user");
                $modelC = Clients::model()->find('fk_user='.$pk_usuario);
                $criteria=new CDbCriteria;
                $criteria->select='pk_student';
                $criteria->addCondition('pk_student='.$id);
                $criteria->addCondition('fk_client='.$modelC->pk_client);
                $modelS = Students::model()->find($criteria);
                if($modelS){
                    $opcionUsuario = 2;
                }else{
                    throw new CHttpException(403, 'No tiene permisos para ejecutar la operacion solicitada.');
                }
            }else if(Yii::app()->user->getState("rol") === constantes::ROL_MAESTRO){
                $pk_usuario = Yii::app()->user->getState("pk_user");
                $modelT = Teachers::model()->find('fk_user='.$pk_usuario);
                $criteria = new CDbCriteria;
                $criteria->distinct=true;
                $criteria->select = 't.*';
                $criteria->join ='INNER JOIN TBL_E24_CLIENTS ON t.FK_CLIENT = TBL_E24_CLIENTS.PK_CLIENT '
                                .'INNER JOIN TBL_E24_COURSES ON TBL_E24_CLIENTS.PK_CLIENT = TBL_E24_COURSES.FK_CLIENT';
                $criteria->condition = 'TBL_E24_COURSES.FK_TEACHER = :pkTeacher AND t.pk_student = :pkStudents';
                $criteria->params = array(":pkTeacher" => $modelT->pk_teacher,":pkStudents" => $id);
                $modelS =  Students::model()->find($criteria);
                if($modelS){
                    $opcionUsuario = 3;
                }else{
                    throw new CHttpException(403, 'No tiene permisos para ejecutar la operacion solicitada.');
                }
            }
            if(isset($_SESSION['updateProfile'])){
                $opcionUsuario = 1;
            }
            $model=$this->loadModel($id);
            $modelUser = $this->loadModelUser($model->fk_user);

            if(isset($_POST['Students']))
            {
                $model->attributes=$_POST['Students'];
                if($opcionUsuario === 0){
                    $modelUser->attributes=$_POST['Users'];
                    $validUser = $modelUser->validate();
                    $validate = $model->validate() && $validUser;
                }else{
                    $validate = $model->validate();
                }

                if($validate)
                {
                    if($opcionUsuario === 0){ //update admin, admin_sist
                        if(Users::cambiarPassword($modelUser->pk_user, $modelUser->password) === TRUE){
                            $modelUser->password = crypt($modelUser->password, constantes::PATRON_PASS);
                        }
                        if($modelUser->save())
                        {
                            $model->save();
                            $this->redirect(array('view','id'=>$model->pk_student));
                        }
                    }else if($opcionUsuario === 1){//update desde perfil
                        $model->save();
                        unset($_SESSION['updateProfile']);
                        $this->redirect(array('perfil'));
                    }else if($opcionUsuario === 2 || $opcionUsuario === 3){//update desde cliente, maestro
                        $model->save();
                        if($_SESSION['adminAlumno']['source'] === 'curso'){
                            $this->redirect(array('teachers/teachers/adminAlumnos'));
                        }elseif($_SESSION['adminAlumno']['source'] === 'alumnos'){
                            $this->redirect(array('teachers/teachers/alumnos'));
                        }elseif ($_SESSION['adminAlumno']['source'] === 'editarAlumno') {
                            $this->redirect(array('teachers/teachers/cursos'));
                        }else{
                            $this->redirect(array('view','id'=>$model->pk_student));
                        }
                    }

                }
            }

            $this->render('update',array(
                    'model'=>$model,
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
		$this->loadModel($id)->delete();
                
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
            /*
            $model=new Students('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Students']))
                    $model->attributes=$_GET['Students'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
            */
            $modelGrp = new Students('searchByActiveGroup');
            $modelGrp->unsetAttributes();
            $modelInd = new Students('searchByActiveIndiv');
            $modelInd->unsetAttributes();
            if(isset($_GET['Students'])){
                $modelGrp->attributes=$_GET['Students'];
                $modelInd->attributes=$_GET['Students'];
            }
            $dataGrp = $modelGrp->searchByActiveGroup()->getData();
            $dataInd = $modelInd->searchByActiveIndiv()->getData();
            $data = array_merge($dataGrp, $dataInd);            
            $dataProvider = new CActiveDataProvider('Students', array(
                'data'=>$data,
                'totalItemCount' => count($data)
            ));
            $this->render('admin',array(
                    'data'=>$dataProvider,
                    'model'=>$modelGrp
            ));
	}
        
        public function actionInactivos()
	{
            $modelGrpA = new Students('searchByActiveGroup');
            $modelGrpA->unsetAttributes();
            $modelIndA = new Students('searchByActiveIndiv');
            $modelIndA->unsetAttributes();
            $model = new Students('search');
            $model->unsetAttributes();
            if(isset($_GET['Students'])){
                $modelGrpA->attributes=$_GET['Students'];
                $modelIndA->attributes=$_GET['Students'];
                $model->attributes=$_GET['Students'];
            }
            $dataGrpA = $modelGrpA->searchByActiveGroup()->getData();
            $dataIndA = $modelIndA->searchByActiveIndiv()->getData();
            
            $dataI = $model->search()->getData();            
            $dataA = array_merge($dataGrpA, $dataIndA);
            
            foreach ($dataI as $key => $value) {
                foreach ($dataA as $valueA) {
                    if($value->pk_student == $valueA->pk_student){
                        unset($dataI[$key]);
                        break;
                    }
                }
            }
            
            $data = array_values($dataI);
            
            $dataProvider = new CActiveDataProvider('Students', array(
                'data'=>$data,
                'totalItemCount' => count($data)
            ));
            $this->render('inactivos',array(
                    'data'=>$dataProvider,
                    'model'=>$model
            ));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Students('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Students']))
			$model->attributes=$_GET['Students'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionPerfil(){
            $pk_usuario = Yii::app()->user->getState("pk_user");
            $model = Students::model()->find('fk_user='.$pk_usuario);
            
            $this->render('perfil',array(
			'model'=>$model,
            ));
        }
        
        public function actionUpdateProfile(){
            $pk_usuario = Yii::app()->user->getState("pk_user");
            $model = Students::model()->find('fk_user='.$pk_usuario);
            $_SESSION['updateProfile'] = TRUE;
            $this->actionUpdate($model->pk_student);
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Students the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Students::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function loadModelUser($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Students $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='students-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
